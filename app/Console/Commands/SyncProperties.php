<?php

namespace App\Console\Commands;

use App\Jobs\ProcessProperties;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:properties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'synchronize the properties to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $params = [
            'api_key' => config('properties.api_key'),
            'page[size]' => config('properties.size'),
            'page[number]' => 1,
        ];

        $this->info('Start properties to synchronize!');

        do {
            $response = Http::get(config('properties.api_url'), $params);
            $properties = $response->json()['data'] ?? [];
            $next_page_url = $response->json()['next_page_url'] ?? null;

            ProcessProperties::dispatch($properties);
            $this->info("For 100 properties job has been dispatched #page no: {$params['page[number]']}!");
            $params['page[number]'] += 1; 

        } while ($properties && $next_page_url);

        $this->info('The properties has been synchronized successful!');
        $this->info('Run the queue to reflect in database php artisan queue:work');
    }
}
