<?php

namespace App\Jobs;

use App\Models\WikiPage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ProcessWikiPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $response = $client->get('https://en.wikipedia.org/api/rest_v1/page/summary/' . urlencode($this->title));

        Log::info('Received response from Wikipedia API', ['response' => $response->getBody()]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['title']) && isset($data['extract'])) {
            WikiPage::create([
                'title' => $data['title'],
                'body' => $data['extract']
            ]);
            Log::info('Successfully created page in the database for: ' . $this->title);
        } else {
            Log::warning('Incorrect response from Wikipedia API for: ' . $this->title);
        }
    }
}
