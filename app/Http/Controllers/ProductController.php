<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        return Product::paginate();
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->input('name')
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:products|productQuality'
        ]);
        return Product::create([
            'name' => $request->input('name')
        ]);
    }
}
