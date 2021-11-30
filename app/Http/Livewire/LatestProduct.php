<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use \Illuminate\Support\Str;

class LatestProduct extends Component
{
    public function render()
    {
        $products=Sanpham::orderBy("updated_at", "DESC")->take(6)->get()->toArray();
        // dd($products);
        return view('livewire.latest-product', compact('products'));
    }
}
