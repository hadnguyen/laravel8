<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $fillable = ['ten','mota','gia','giaban','anh','danhsachanh','trangthai','uutien','nhomsanphamid'];

    // join 1-1
    public function nhomsanphams(){
        return $this->hasOne(Nhomsanpham::class, 'id', 'nhomsanphamid');
    }
    //join 1 - many
    public function details(){
        return $this->hasMany(OrderDetail::class, 'sanpham_id','id');
    }

    // use in saleoff-product.blade
    public function nhomsanpham(){
        return Nhomsanpham::find($this->nhomsanphamid);
    }
}


