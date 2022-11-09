<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Order_State;

use Illuminate\Support\Facades\View;

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
        $category=Category::all();
        View::share('category',$category);

        $supplier=Supplier::all();
        View::share('supplier',$supplier);

        $unit=Unit::all();
        View::share('unit',$unit);

        $ostate=Order_State::all();
        View::share('ostate',$ostate);

        Paginator::useBootstrap();
    }
}
