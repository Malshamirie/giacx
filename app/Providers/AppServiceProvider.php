<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\IconsaxBulSetting5;
use App\View\Components\IconsaxBulCalculator;
use App\View\Components\IconsaxBulBucket;
use App\View\Components\IconsaxBulNotification;
use App\View\Components\IconsaxBulGlobalSearch;
use App\View\Components\IconsaxBulMobile;
use App\View\Components\IconsaxBulRefresh2;

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
        Paginator::defaultView('pagination::default');
        
        // Register icon components
        Blade::component('iconsax-bul-setting-5', IconsaxBulSetting5::class);
        Blade::component('iconsax-bul-calculator', IconsaxBulCalculator::class);
        Blade::component('iconsax-bul-bucket', IconsaxBulBucket::class);
        Blade::component('iconsax-bul-notification', IconsaxBulNotification::class);
        Blade::component('iconsax-bul-global-search', IconsaxBulGlobalSearch::class);
        Blade::component('iconsax-bul-mobile', IconsaxBulMobile::class);
        Blade::component('iconsax-bul-refresh-2', IconsaxBulRefresh2::class);
    }
}
