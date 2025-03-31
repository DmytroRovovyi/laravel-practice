<?php

namespace App\Jobs;

use App\Models\WikiPage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        $data = json_decode($response->getBody(), true);

        // Запис у базу даних
        if (isset($data['title']) && isset($data['extract'])) {
            WikiPage::create([
                'title' => $data['title'],
                'body' => $data['extract']
            ]);
        }
    }
}
