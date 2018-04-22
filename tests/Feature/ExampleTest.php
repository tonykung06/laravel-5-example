<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testProductsList()
    {
        $products = factory(\App\Product::class, 3)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        // $response->assertJson($products->all());
    }

    public function testProductDescriptionsList()
    {
        $product = factory(\App\Product::class)->create();
        $product->descriptions()->saveMany(factory(\App\Description::class, 3)->make());

        $response = $this->get(route('products.descriptions.index', [
            'products' => $product->id
        ]));

        $response->assertStatus(200);
    }

    public function testProductCreation()
    {
        $product = factory(\App\Product::class)->make([
            'name' => 'beets'
        ]);
        $response = $this->post(route('products.store'), $product->jsonSerialize());
        $response->assertStatus(201);
    }

    public function testProductDescriptionCreation()
    {
        $product = factory(\App\Product::class)->create([
            'name' => 'beets'
        ]);
        $description = factory(\App\Description::class)->make();
        $response = $this->post(route('products.descriptions.store', [
            'products' => $product->id
        ]), $description->jsonSerialize());
        $response->assertStatus(201);
    }

    public function testProductUpdate()
    {
        $product = factory(\App\Product::class)->create([
            'name' => 'beets'
        ]);
        $product->name = 'feets';
        $response = $this->put(route('products.update', [
            'products' => $product->id
        ]), $product->jsonSerialize());
        $response->assertStatus(200);
    }

    // public function testProductCreationFailsWhenNameNotProvided()
    // {
    //     $product = factory(\App\Product::class)->make([
    //         'name' => ''
    //     ]);
    //     $response = $this->post(route('products.store'), $product->jsonSerialize());
    //     $response->assertStatus(422);
    // }

    // public function testProductCreationFailsWhenNameAlreadyExists()
    // {
    //     $name = 'feets';
    //     $product1 = factory(\App\Product::class)->create([
    //         'name' => $name
    //     ]);
    //     $product2 = factory(\App\Product::class)->make([
    //         'name' => $name
    //     ]);
    //     $response = $this->post(route('products.store'), $product2->jsonSerialize());
    //     $response->assertStatus(422);
    // }

    // public function testProductDescriptionCreationFailsWhenNameNotProvided()
    // {
    //     $product = factory(\App\Product::class)->create([
    //         'name' => '123'
    //     ]);
    //     $description = factory(\App\Description::class)->make([
    //         'body' => ''
    //     ]);
        
    //     $response = $this->post(route('products.descriptions.store', [
    //         'products' => $product->id
    //     ]), $description->jsonSerialize());
    //     $response->assertStatus(422);
    //     $response->assertJson([
    //         'body' => 'The body field is required.'
    //     ]);
    // }

    // public function testProductCreationFailsWhenNameNoUpToQuality()
    // {
    //     $product = factory(\App\Product::class)->make([
    //         'name' => 'notquality'
    //     ]);
    //     $response = $this->post(route('products.store'), $product->jsonSerialize());
    //     $response->assertStatus(422);
    // }
}
