<?php

namespace App\Http\Controllers;

use App\Models\Product;


class LandingController extends Controller
{
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $products = Product::with(['category', 'unit', 'storage'])
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('welcome', [
            'products' => $products,
        ]);
    }
}
