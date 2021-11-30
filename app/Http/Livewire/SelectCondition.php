<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nhomsanpham;

class SelectCondition extends Component
{
    public function render()
    {
        $categories = Nhomsanpham::all();

        return view('livewire.select-condition', compact('categories'));
    }
}
