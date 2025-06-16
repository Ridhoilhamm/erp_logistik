<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class TallStackUiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        TallStackUi::personalize()
            ->sideBar()
            ->block('desktop.wrapper.second')
            ->replace('dark:bg-dark-700', 'dark:bg-[#1e293b]')
            ->replace('dark:border-dark-600', 'dark:border-[#1e293b]');

        TallStackUi::personalize()
            ->layout('header')
            ->block('wrapper')
            ->replace('dark:bg-dark-700', 'dark:bg-transparent backdrop-blur-[20px]')
            ->replace('dark:border-dark-600', 'dark:border-[#ffffff1a]');

        TallStackUi::personalize()
            ->layout()
            ->block('main')
            ->replace('p-10', 'py-[25px] px-[31px]');
    }
}
