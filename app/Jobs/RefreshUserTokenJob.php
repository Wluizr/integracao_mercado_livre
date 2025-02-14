<?php

namespace App\Jobs;

use App\Http\Controllers\UserMLController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class RefreshUserTokenJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Fazendo o refreshToken");
        $controller = new UserMLController();
        $controller->getLastTokenValid();

        Log::info("Concluido o refreshToken");
    }
}
