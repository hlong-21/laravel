<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\ResponseFactory;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data) {
            return Response::json([
                'success' => 1,
                'data' => $data
            ]);
        });

        Response::macro('error', function ($messages, $code) {
            return Response::json([
                'success' => 0,
                'messages' => $messages,
                'code' => $code
            ]);
        });
    }
}