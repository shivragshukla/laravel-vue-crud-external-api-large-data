<?php

namespace App\Jobs;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessProperties implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $properties;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->properties as $data) {

            $store = $data['property_type'] ?? null;
            $data = collect($data)->reject(function ($value, $key) {
                return $key === 'property_type';
            })->toArray();

            try {
                if ($store) {
                    PropertyType::updateOrCreate(['id' => $store['id']], $store);
                    Property::updateOrCreate(['uuid' => $data['uuid']], $data);
                }
            } catch (Exception $e) {
              return $e->getMessage();

            }
        }
    }
}
