<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::paginate($request->get('pageSize', 10));

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $product = Product::create($request->all());

        $product->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photos');
            });

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = Product::find($id);

        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        if($request->hasFile('photos')) {
            $product->media()->delete();
            $product->addMultipleMediaFromRequest(['photos'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('photos');
                });
        }

        return new ProductResource($product);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id): void
    {
        Product::destroy($id);
    }
}
