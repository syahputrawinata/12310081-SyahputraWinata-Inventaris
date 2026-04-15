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
        'returned_by_user_id'
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staffPenerima() {
        return $this->belongsTo(User::class, 'returned_by_user_id');
    }
}
