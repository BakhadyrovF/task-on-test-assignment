<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\WarehouseCreateFormRequest;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $warehouses = Warehouse::orderByDesc('id')->get();

        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WarehouseCreateFormRequest $request
     * @return RedirectResponse
     */
    public function store(WarehouseCreateFormRequest $request)
    {
        $warehouses = Warehouse::orderByDesc('id')->get();

        $newWarehouse = Warehouse::create($request->validated());
        $warehouses->add($newWarehouse);


        return redirect()->route('warehouses.index', compact('warehouses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        $warehouses = Warehouse::orderByDesc('id')->get();

        return redirect()->route('warehouses.index', compact('warehouses'));
    }
}
