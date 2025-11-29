<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
     protected $table = 'vendor';
     protected $fillable = ['ten_dongxe', 'mota_dongxe'];
     public function vendor()
    {
        return $this->hasMany(Product::class);
    }
}
