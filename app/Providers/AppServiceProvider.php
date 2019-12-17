<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TheLoai;
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
        $theloai = TheLoai::all();
        view()->share('theloai', $theloai); 
    }
}
