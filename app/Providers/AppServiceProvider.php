<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TheLoai;
use App\Slide;
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
        $slide = Slide::all();
        view()->share('slide', $slide); 
        view()->share('theloai', $theloai); 
    }
}
