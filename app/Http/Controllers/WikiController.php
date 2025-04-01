<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWikiPage;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    /**
     * Get show display form upload.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showForm()
    {
        return view('upload');
    }

    /**
     * Get title from wikipedia.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fetchPage(Request $request)
    {
        $request->validate([
            'title_file' => 'required|file|mimes:txt',
        ]);
        $file = $request->file('title_file');

        if (!$file || !$file->isValid()) {
            return redirect()->route('titles.upload.form')->with('error', 'Invalid file');
        }

        $fileContent = file_get_contents($file->getRealPath());
        $titles = explode(';', $fileContent);
        $titles = array_map('trim', $titles);

        foreach ($titles as $title) {
            ProcessWikiPage::dispatch($title);
        }

        return redirect()->route('titles.upload.form')->with('success', 'Article titles successfully added to the processing queue');
    }
}
