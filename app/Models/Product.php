<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];
    protected $attributes = [
        'stock' => 0,
        'price' => 1,
        'capital_price' => 1,
     ];
    use HasFactory;

    public function details(){
        return $this->hasMany(details::class);
    }
}
