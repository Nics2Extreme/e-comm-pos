<?php

namespace App\Livewire;

use App\Models\CartUser;
use Filament\Facades\Filament;
use Livewire\Component;

class Order extends Component
{
    public function delete($id) {
        CartUser::where('id', $id)->delete();
    }   

    public function render()
    {
        $auth = Filament::auth();
        $user = $auth->user();
        return view('livewire.order', [
            'carts' => CartUser::with('product')->where('customer_id', $user->id)->get(),
            'user' => $user
        ]);
    }
}
