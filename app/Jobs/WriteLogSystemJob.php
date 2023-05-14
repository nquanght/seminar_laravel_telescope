<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class WriteLogSystemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Write Log to system
        $context = !is_null($this->data) ? Arr::wrap($this->data) : [];

        Log::critical($this->customMessage('Info'), $context);
        Log::alert($this->customMessage('Alert'), $context);
        Log::info($this->customMessage('Info'), $context);
        Log::debug($this->customMessage('Debug'), $context);
        Log::emergency($this->customMessage('Emergency'), $context);
        Log::error($this->customMessage('Error'), $context);
        Log::notice($this->customMessage('Notice'), $context);
        Log::warning($this->customMessage('Warning'), $context);

        // test failed jobs
//        Log::extend($this->customMessage('Warning'), $context);

    }

    private function customMessage($type){
        return "Write Log with level: $type";
    }
}
