<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CategoryModel;
use App\Models\CartModel;
use Illuminate\Pagination\Paginator;

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
        view()->composer('*', function($view){
            $view->with([
                'category' => CategoryModel::whereNull('patent_id')->get(),
                'cate_con' => CategoryModel::whereNotNull('patent_id')->get(),
                'cate' => CategoryModel::get(),
                'cart' => CartModel::getAll(),
                'total' => CartModel::total(),
            ]);
        });

        Paginator::useBootstrap();
    }
}
