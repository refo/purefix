<?php

namespace Purefix\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Purefix\Models\Product;
use Purefix\Models\ProductVariant;

class ProductVariantsAdmin extends BaseController
{
    /**
     * GET /{resource}
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($product_id)
    {
        return ProductVariant::where('product_id', $product_id)->get();
        //return Product::with('variants')->findOrFail($product_id)->variants;
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
    public function show($product_id, $id)
    {
        return ProductVariant::where('product_id', $product_id)->findOrFail($id);
        //return Product::with('variants')->findOrFail($product_id)->variants->where('id', $id)->first();
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
        //
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
}
