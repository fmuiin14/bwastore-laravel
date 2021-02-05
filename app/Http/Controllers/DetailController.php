<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DetailController extends Controller
{
    public function index(Request $request, $id) {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        // var_dump($product);
        // die();
        return view('pages.detail', [
            'product' => $product
        ]);
    }
}
