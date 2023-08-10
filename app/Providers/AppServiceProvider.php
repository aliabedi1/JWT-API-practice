<?php

namespace App\Providers;

use App\Enums\SystemMessage;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', fn ($code = SystemMessage::SUCCESS, $message = null, $data = [], $http_status = HttpFoundation::HTTP_OK) => Response::make([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $http_status));

        Response::macro('store', fn ($message = null, $data = []) => Response::success(SystemMessage::SUCCESS, $message ?? __("It was created successfully."), $data, HttpFoundation::HTTP_CREATED));

        Response::macro('update', fn ($message = null, $data = []) => Response::success(SystemMessage::SUCCESS, $message ?? __("Successfully updated."), $data, HttpFoundation::HTTP_ACCEPTED));

        Response::macro('destroy', fn ($message = null) => Response::success(SystemMessage::SUCCESS, $message ?? __('Removed successfully.'), [], HttpFoundation::HTTP_ACCEPTED));

        Response::macro('error', fn ($code, $message, $errors = [], $http_status = HttpFoundation::HTTP_BAD_REQUEST) => Response::make([
            'code' => $code,
            'message' => $message,
            'errors' => (object)$errors
        ], $http_status));

        Response::macro('dataNotFound', fn ($errors = []) => Response::error(SystemMessage::DATA_NOT_FOUND, $message = __('Not found.'), $errors, HttpFoundation::HTTP_NOT_FOUND));

        Response::macro('forbidden', fn ($code, $message, $errors = []) => Response::error($code, $message, $errors, HttpFoundation::HTTP_FORBIDDEN));

    }
}
