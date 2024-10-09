<?php

namespace App\Http\Controllers;

use App\Models\ProductStatus;
use App\Http\Requests\StoreProductStatusRequest;
use App\Http\Requests\UpdateProductStatusRequest;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductStatus $productStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductStatus $productStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductStatusRequest $request, ProductStatus $productStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductStatus $productStatus)
    {
        //
    }
}
