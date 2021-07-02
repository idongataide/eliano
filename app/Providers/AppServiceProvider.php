<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\company;
use Carbon\Carbon;
use App\Models\plan;

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
        //
        $data['basic'] =  Company::first();
        $data['time'] = Carbon::now();
        $data['user'] = Auth::user();
        $data['plan'] = plan::get();
        View::share($data);

    }
}