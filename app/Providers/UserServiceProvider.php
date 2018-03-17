<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Auth;
use App\User;
class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
            //compose all the views....
        view()->composer('*', function ($view) 
        {
            $user =  Auth::user();
            //echo("user id:");
            //print_r($user_id);
            //dd($user

            //$user = User::findOrFail($user->id);
            if($user) {
                //money_format("%i", (float)($campaign['budget_amount']/100));
                $publisher_balance = money_format("%i", $user->publisher_balance/100);
                $advertiser_balance = money_format("%i", $user->advertiser_balance/100);
                //print_r("hello");
                //print_r($advertiser_balance);
                //$cart = Cart::where('user_id', Auth::user()->id);

                //...with this variable
                $view->with('advertiser_balance', $advertiser_balance ); 
                $view->with('publisher_balance', $publisher_balance ); 
            }   
        });  

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
