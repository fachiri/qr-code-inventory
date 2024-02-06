<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Imports\KodefikasiImport;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('pages.master.item.index', compact('items'));
    }

    public function create()
    {
        $units = Unit::all();
        $categories = Category::all();

        $rows = Excel::toCollection(new KodefikasiImport, public_path('assets/pmk_no_29_2010_penggolongan_dan_kodefikasi_bmn.xlsx'));

        $codefications = $rows[0]->map(function ($row) {
            return collect($row)->take(7);
        });

        return view('pages.master.item.create', compact('units', 'categories', 'codefications'));
    }

    public function store(StoreItemRequest $request)
    {
        try {
            Item::create($request->all());

            return redirect()->route('dashboard.master.item.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Item $item)
    {
        return view('pages.master.item.show', compact('item'));
    }

    public function edit(Item $item)
    {
        //
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    public function destroy(Item $item)
    {
        try {
            $item->delete();

            return redirect()->route('dashboard.master.item.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function print($uuid)
    {
        try {
            $item = Item::where('uuid', $uuid)->first();
            $path = public_path('assets/logo_ung.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $Pdf = Pdf::loadView('export.items', compact('item', 'base64'));

            return $Pdf->stream();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function detail($uuid, $no)
    {
        $item = Item::where('uuid', $uuid)->first();

        return view('pages.public.item', compact('item'));
    }
}
