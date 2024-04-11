<?php

namespace App\Providers;

use App\Repositories\TelegramMessage\TelegramMessageRepository;
use App\Repositories\TelegramMessage\TelegramMessageRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TelegramMessageRepositoryInterface::class,
            TelegramMessageRepository::class
        );
    }
}