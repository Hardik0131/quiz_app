<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer('front.layout.nav_item', function ($view) {
        //     $categories = Category::whereHas('posts', function ($q) {
        //         $q->has('questions', '>=', 2)
        //             ->has('results', '>=', 3);
        //     })
        //         ->limit(3)
        //         ->orderBy('name')
        //         ->get();

        //     $view->with('categories', $categories);
        // });

        View::composer('front.layout.nav_item', function ($view) {
            $categories = Category::whereHas('posts', function ($q) {
                $q->has('questions', '>=', 2)->has('results', '>=', 3);
            })->limit(3)->orderBy('name')->get();

            $view->with('categories', $categories);
        });
    }
}
