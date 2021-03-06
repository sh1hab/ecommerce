<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Database\Schema\Builder;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);

        try {
            $categories = Category::select(['name', 'slug'])->where('category_id', null)->get();

            view()->share('categories', $categories);

            Category::observe(CategoryObserver::class);
        } catch (Exception $e) {

        }


    }
}
