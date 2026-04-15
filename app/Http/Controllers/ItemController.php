<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Category;
use App\Models\Lending;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\ItemExport;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => 0,
            'lending' => 0,
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
        // 1. Hitung dulu stok yang benar-benar tersedia (nganggur)
        // Logika: Total Aset - Yang Rusak - Yang Sedang Dipinjam
        $stokTersedia = $item->total - $item->repair - $item->lending;
        
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
            'new_broke_item' => 'nullable|integer|min:0|max:' . $stokTersedia,
        ], [
            'new_broke_item.max' => 'Damaged items must not exceed available stock (' . $stokTersedia . ' items) '
        ]);

        $newRepairTotal = $item->repair; // Ambil data rusak yang lama

        if ($request->filled('new_broke_item')) {
            $newRepairTotal += $request->new_broke_item; //ditambah yang baru
        }

        $item->update([
            'category_id' => $request->category_id,
            'name' =>$request->name,
            'total' => $request->total,
            'repair' => $newRepairTotal, //update ke database
        ]);

        return redirect()->route('items.index')->with('success', 'Successfully updated item!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Succesfully deleted item!');
    }

    public function exportExcel(Request $request) {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ItemExport, 'Data_Barang.xlsx');
    }

    public function showLending($id) {
        $items = Item::findOrFail($id);
        $lendings = Lending::with('user')->where('item_id', $id)->get();
        return view('items.lending', compact('items', 'lendings'));
    }
}
