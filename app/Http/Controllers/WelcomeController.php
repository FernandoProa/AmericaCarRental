<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    var $cars;
    var $quantity = 0;

    function __construct()
    {
        $this->cars = collect([
            collect([
                'model' => 'CHEVROLET ONIX 123',
                'image' => '/img/onix.png',
                'description' => 'Auto Económico',
                'luggage' => 'X2',
                'transmission' => 'Manual',
                'AC' => true,
                'passagers' => 'X2',
                'price' => '$32.00 USD',
                'quantity' => 1,
                'cart' => 15

            ]),
            collect([
                'model' => 'CHEVROLET AVEO 123',
                'image' => '/img/pngegg.png',
                'description' => 'Auto Económico',
                'luggage' => 'X2',
                'transmission' => 'Manual',
                'AC' => true,
                'passagers' => 'X2',
                'price' => '$32.00 USD',
                'quantity' => 1,
                'cart' => 10

            ]),
            collect([
                'model' => 'CHEVROLET ONIX 123',
                'image' => '/img/onix.png',
                'description' => 'Auto Económico',
                'luggage' => 'X2',
                'transmission' => 'Manual',
                'AC' => true,
                'passagers' => 'X2',
                'price' => '$32.00 USD',
                'quantity' => 1,
                'cart' => 5

            ]),

        ]);
    }

    public function index()
    {
        $cars = $this->cars;
        $quantity = $this->quantity;
        return view('welcome')->with('cars', $this->cars);
    }
    public function cart(){
        return view('shoppingcart.cart');
    }
    public function shoppingcart(){
        return [
            'cars'=>$this->cars
        ];
    }
}
