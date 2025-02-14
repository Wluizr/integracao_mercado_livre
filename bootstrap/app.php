<?php

use App\Jobs\RefreshUserTokenJob;
use App\Jobs\UpdateUserJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function(){
            Log::info('Iremos atualizar os dados do usuário no BANCO');
            //$schedule->call(new DeleteRecentUsers)->daily(); Exemplo de como ficará essa chamada
        })->daily();

        $schedule->job( new UpdateUserJob)->everyTenSeconds(); // schedule:list e depois  para rodar os jobs queue:work | Depois procurar para executar ou ajustar para sempre rodar esse queue:work 
        $schedule->job( new RefreshUserTokenJob)->everyMinute();
        // $schedule->job( new RefreshUserTokenJob)->everyFiveHours();
    })
    ->create();
