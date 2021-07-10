<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'codeitem';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];
    protected $attributes = [
        'price' => 1,
        'capital_price' => 1,
     ];
    use HasFactory;

    public function details(){
        return $this->hasMany(details::class);
    }
}
