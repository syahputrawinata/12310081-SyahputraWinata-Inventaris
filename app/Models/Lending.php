<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'borrower_name',
        'amount_borrowed',
        'notes',
        'status',
        'borrow_date',
        'return_date',
    ];

    public function item() {

    }

    public function user() {
        
    }
}
