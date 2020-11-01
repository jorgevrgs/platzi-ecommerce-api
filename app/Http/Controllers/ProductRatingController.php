<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductRatingController extends Controller
{
    public function rate(Product $product, Request $request)
    {
        $this->validate($request, [
            'score' => 'required'
        ]);

        /** @var User $user */
        $user = $request->user();
        $user->rate($product, $request->get('score'));

        return new ProductResource($product);
    }

    public function unrate(Product $product, Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $user->unrate($product);

        return new ProductResource($product);
    }
}
