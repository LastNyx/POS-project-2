<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction';
    protected $guarded = [];
    use HasFactory;

    public function details(){
        return $this->hasMany(details::class);
    }
}
