<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\models\Item;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Item::with('category')->get();
    }

    public function headings():array {
        return [
            'ID',
            'Kategori',
            'Nama Barang',
            'Total',
            'Dipinjam',
            'Rusak',
        ];
    }

    public function map($item): array {
        return [
            $item->id,
            $item->category->name ?? 'tidak ada',
            $item->name,
            $item->total,
            $item->lending,
            $item->repair,
        ];
    }
}
