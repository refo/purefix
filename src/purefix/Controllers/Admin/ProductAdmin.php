<?php

namespace Purefix\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Redirect;

use Purefix\Models\Product;
use Purefix\Models\ProductVariant;

class ProductAdmin extends BaseController
{
    /**
     * GET /{resource}
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * GET /{resource}/create
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * POST /{resource}
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET /{resource}/{id}
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::with('variants');
        if ($id > 0) {
            return $product->findOrFail($id);
        } else {
            $product = $product->where('slug', 'like', '%'.$id.'%')->firstOrFail();
            if ($product->slug != $id) {
                return Redirect::route('admin.product.show', ['id' => $product->slug]);
            } else {
                return $product;
            }
        }
    }

    /**
     * GET /{resource}/{id}/edit
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * PUT|PATCH /{resource}/{id}
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->input());
        return $product;
    }

    /**
     * DELETE /{resource}/{id}
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function debug()
    {
        //
    }

    private function debug_remove_nonexistent_images()
    {
        $products = Product::all();

        $products->each(function($p){

            $images = $p->images;
            $path = 'images/';

            foreach($images as $idx => $image) {
                if ( !file_exists($path.$image) ) {
                    $images[$idx] = 'xx XX xx';
                    unset($images[$idx]);
                }                
            }

            // Reset array keys
            $images = array_values($images);

            $p->images = $images;
            $p->save();
        });

        return $products;
    }
}
