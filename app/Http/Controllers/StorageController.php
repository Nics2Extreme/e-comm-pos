<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $storages = Storage::filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('storages.index', [
            'storages' => $storages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('storages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:storages,name',
            'slug' => 'required|unique:storages,slug|alpha_dash',
        ];

        $validatedData = $request->validate($rules);

        Storage::create($validatedData);

        return Redirect::route('storages.index')->with('success', 'Storage has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Storage $storage)
    {
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Storage $storage)
    {
        return view('storages.edit', [
            'storage' => $storage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Storage $storage)
    {
        $rules = [
            'name' => 'required|unique:storages,name,'.$storage->id,
            'slug' => 'required|alpha_dash|unique:storages,slug,'.$storage->id,
        ];

        $validatedData = $request->validate($rules);

        Storage::where('slug', $storage->slug)->update($validatedData);

        return Redirect::route('storages.index')->with('success', 'Storage has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Storage $storage)
    {
        Storage::destroy($storage->id);

        return Redirect::route('storages.index')->with('success', 'Storage has been deleted!');
    }
}
