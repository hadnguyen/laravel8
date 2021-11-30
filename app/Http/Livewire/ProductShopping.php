<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use Livewire\WithPagination;
use Cart;

class ProductShopping extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price);
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }

    public function render()
    {
        $products=Sanpham::paginate(6);
        return view('livewire.product-shopping', ['products'=>$products]);
    }
}
