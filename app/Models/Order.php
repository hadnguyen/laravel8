<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    //join 1 - many
    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
}
