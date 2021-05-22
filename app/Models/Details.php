<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $guarded = [];
    protected $attributes = [
        'qty' => 1,
        'transaction_id' => 0,
     ];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function transaction(){
        return $this->belongsTo(transaction::class);
    }
}
