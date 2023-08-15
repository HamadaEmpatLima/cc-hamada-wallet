<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class WalletApiRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $state;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($state, $name)
    {
        $this->state = $state;
        $this->name  = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $headers = [
            'Authorization' => 'Bearer ' . base64_encode($this->name),
            'Accept'        => 'application/json'
        ];

        $url = env('APP_URL') . '/api/wallet';

        $res = Http::withHeaders($headers)->post($url, $this->state);

        if (!$res->successful()) {
            $this->failed(new \Exception('API request failed with status: ' . $res->status()));
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
    }
}
