## What is this package?
This is a laravel simple shopping cart package. You can use this package very easily. Please follow these instructions for use this package.

## Installation

```sh
composer require anwar7736/shoppingcart
```
---
## Configuration
1. Open <b>config/app.php</b> and add this line to your Service Providers Array. 
```php
Anwar\ShoppingCart\ShoppingCartServiceProvider::class
```

2. Open <b>config/app.php</b> and add this line to your Aliases
 
```php
'Cart' => Anwar\ShoppingCart\Facades\Cart::class
```
3. <b>Optional configuration</b> file (useful if you plan to have full control)

```php
php artisan vendor:publish --provider="Anwar\ShoppingCart\ShoppingCartServiceProvider"
```
---
## How to use
```php 

use Anwar\ShoppingCart\Facades\Cart;

//Add single item to cart
Cart::add(id, name, quantity, price, discount(optional), variation(optional), image(optional));


//Get single item from cart
Cart::get(id);


//Update single item from cart(you can update quantity or variation or both)
Cart::update(id, quantity(optional), variation(optional));


//Remove single item from cart
Cart::remove(id);


//Get how many items in your cart
Cart::count();


//Get all cart items
Cart::content();


//Get total discount amount in your cart
Cart::discount();


//Get subtotal in your cart
Cart::subtotal();


//Remove all items from your cart
Cart::destroy();

```
---

## <center> Thank You </center>