<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use \App\Models\Category;

class CategoryExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Category::with('user')->get();
    }

    public function headings():array {
        return [
            'ID',
            'Nama',
            'Penangung Jawab',
        ];
    }

    public function map($category):array {
        return [
            $category->id,
            $category->name,
            $category->user->name,
        ];
    }
}
