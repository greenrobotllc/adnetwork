<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;
use \Auth;
use App\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //
        $user_id =  Auth::user();
        //echo("user id:");
        //print_r($user_id);
        //dd($user_id);
        if($user_id) {

                    $user = User::findOrFail($user_id);
            $publisher_balance = $user->publisher_balance;
            $advertiser_balance = $user->advertiser_balance;


        
            // view()->share('advertiser_balance', $advertiser_balance);
            // view()->share('publisher_balance', $publisher_balance);
        }
        else {
            //echo("nao");
    view()->share('advertiser_balance', "");
            view()->share('publisher_balance', "");
    
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
              //  $user_id =  Auth::user();

                //echo($user_id);
        if ($this->app->environment() == 'local') {
           $this->app->register('Remoblaser\Resourceful\ResourcefulServiceProvider');
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');

        }
    }
}
