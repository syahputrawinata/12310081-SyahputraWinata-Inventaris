<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = Item::with('category_id');
        return view('items.index')->compact('items');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $items = Item::with('category_id');
        return view('items.create')->compact('items');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'total' => 'required',
            'repair' => 'nullable',
            'lending' => 'nullable',
        ]);

        Item::create([
            'category_id' => 'request->category_id',
            'name' => 'request->name',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
