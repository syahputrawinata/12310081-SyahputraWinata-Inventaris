<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Lending;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lendings = Lending::with(['item', 'user'])->get();
        return view('lendings.index', compact('lendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $items = Item::all();
        return view('lendings.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'borrower_name' => 'required|string|max:255',
            'amount_borrowed' => 'required|integer|min:1', 
            'borrow_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $item = Item::findOrFail($request->item_id); //mencari barang yang ingin dipinjam

        $stokAvailable = $item->total - $item->lending - $item->repair; //menghitung stok yang tersedia

        if($request->amount_borrowed > $stokAvailable) {
                return back()->withErrors(['amount_borrowed' => 'Gagal! Jumlah pinjam (' . $request->amount_borrowed . ') melebihi stok yang tersedia (' . $stokAvailable . ').'
            ])->withInput();
        }

        Lending::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'borrower_name' => $request->borrower_name,
            'amount_borrowed' => $request->amount_borrowed,
            'notes' =>$request->notes,
            'status' => 'borrowed',
            'borrow_date' => $request->borrow_date,
        ]);

        $item->increment('lending', $request->amount_borrowed);

        return redirect()->route('lendings.index')->with('success', 'Transaksi peminjaman berhasil dicatat!');
    }

    public function returnItem(Lending $lending) {
        if($lending->status == 'returned') {
            return back()->withErrors(['error' => 'Gagal! Transaksi ini sudah dikembalikan sebelumnya!']);
        }

        $lending->item->decrement('lending', $lending->amount_borrowed);

        $lending->update([
            'returned_by_user_id' => Auth::id(),
            'status' => 'returned',
            'return_date' =>now(),
            // 'returned_by_user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Item berhasil dikembalikan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
