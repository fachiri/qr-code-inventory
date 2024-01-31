<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();

        return view('pages.master.unit.index', compact('units'));
    }

    public function create()
    {
        return view('pages.master.unit.create');
    }

    public function store(StoreUnitRequest $request)
    {
        try {
            Unit::create($request->all());

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        //
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
    }

    public function destroy(Unit $unit)
    {
        //
    }
}
