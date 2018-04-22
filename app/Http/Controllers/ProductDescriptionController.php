<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;
use App\Product;

class ProductDescriptionController extends Controller
{
    public function index($productId) {
        return Description::ofProduct($productId)->paginate();
    }

    public function update(Request $request, $id) {

    }

    public function store($productId, Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $product = Product::findOrFail($productId);
        return $product->descriptions()->save(new Description([
            'body' => $request->input('body')
        ]));
    }
}
