<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
      protected $table = 'products';
      protected $fillable = ['ten_sp', 'id_dongxe', 'mota', 'hinhanh', 'hienthi','chitiet', 'thongso', 'slug'];
      protected $casts = [
          'hinhanh' => 'array',
      ];
        public function products()
      {
          return $this->belongsTo(Vendor::class);
      }
}
