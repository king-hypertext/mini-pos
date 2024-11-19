<?php

namespace App\Http\Controllers;

use App\Models\ReturnSale;
use App\Http\Requests\StoreReturnSaleRequest;
use App\Http\Requests\UpdateReturnSaleRequest;
use App\Models\ReturnSaleItem;

class ReturnSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'Returns';
        $returnSaleItems = ReturnSaleItem::all();
        return view('returns.index', compact('page_title', 'returnSaleItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Create Return';
        // return view('returns.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturnSaleRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(ReturnSale $returnSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnSale $returnSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReturnSaleRequest $request, ReturnSale $returnSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnSale $returnSale)
    {
        //
    }
}
