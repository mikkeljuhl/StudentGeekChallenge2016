<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Basket extends TestCase
{

    public function setUp(){
        if(!Auth::attempt(['email' => "", 'password' => $password])){
            return false;
        }

        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddOneProduct()
    {
        \App\Http\Controllers\BasketController::add(Product::where('id',1)->first());
        $basket = \App\Http\Controllers\BasketController::getCartItems();

        assertThat(sizeof($basket), is(1));
    }

    public function testAddThreeProducts()
    {
        $this->assertTrue(true);
    }
}
