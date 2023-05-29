<?php
namespace Anwar\ShoppingCart;

use Illuminate\Support\ServiceProvider;
use Anwar\ShoppingCart\Cart;

class ShoppingCartServiceProvider extends ServiceProvider{
    public function register()
    {
        app()->bind('cart', function($app){
            return new Cart();
        });
    }

    public function boot()
    {

    }
}