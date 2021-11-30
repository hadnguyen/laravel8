<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;

class SaleoffProduct extends Component
{
    public function render()
    {
        $products=Sanpham::whereNotNull('giaban')->orderByRaw("giaban/gia ASC")->take(5)->get();
        return view('livewire.saleoff-product', compact('products'));
    }
}
