<?php

namespace App\Http\Controllers;

use App\Constants\StatusPeminjaman;
use App\Http\Requests\BorrowItemRequest;
use App\Http\Requests\StoreSubItemRequest;
use App\Http\Requests\UpdateSubItemRequest;
use App\Models\Borrow;
use App\Models\History;
use App\Models\Item;
use App\Models\SubItem;
use Illuminate\Support\Facades\DB;

class SubItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create($itemUuid)
    {
        $item = Item::where('uuid', $itemUuid)->first();

        return view('pages.master.subitem.create', compact('item'));
    }

    public function store(StoreSubItemRequest $request)
    {
        try {
            $item = Item::findOrFail($request->item_id);
            $subitem = SubItem::where('item_id', $item->id)->latest()->first();

            for ($i = 0; $i < $request->quantity; $i++) {
                $createdSubitem = SubItem::create([
                    'number' => $i + 1 + $subitem->number,
                    'entry_date' => $request->entry_date,
                    'item_id' => $item->id
                ]);
                foreach ($item->components as $component) {
                    DB::table('component_sub_item')->insert([
                        'sub_item_id' => $createdSubitem->id,
                        'component_id' => $component->id
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(SubItem $subitem)
    {
        return view('pages.master.subitem.show', compact('subitem'));
    }

    public function edit(SubItem $subitem)
    {
        return view('pages.master.subitem.edit', compact('subitem'));
    }

    public function update(UpdateSubItemRequest $request, SubItem $subitem)
    {
        try {
            $subitem->entry_date = $request->entry_date;
            $subitem->is_pinjamable = $request->is_pinjamable;
            $subitem->update();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(SubItem $subitem)
    {
        try {
            $subitem->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function detail($uuid)
    {
        $subitem = SubItem::where('uuid', $uuid)->first();

        return view('pages.public.subitem', compact('subitem'));
    }

    public function borrow(BorrowItemRequest $request, $uuid)
    {
        try {
            $subitem = SubItem::where('uuid', $uuid)->first();

            if ($subitem->is_pinjamable === 0) {
                return redirect()
                    ->back()
                    ->withErrors('<b>' . $subitem->item->name . '</b> dengan kode <b>' . $subitem->item->code . ' ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT) . '</b> tidak dapat dipinjam.')
                    ->withInput();
            }

            if ($subitem->borrows()->latest()->first() && $subitem->borrows()->latest()->first()->histories()->latest()->first()->status === StatusPeminjaman::APPROVED) {
                return redirect()
                    ->back()
                    ->withErrors('<b>' . $subitem->item->name . '</b> dengan kode <b>' . $subitem->item->code . ' ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT) . '</b> sedang dipinjam.')
                    ->withInput();
            }

            $borrow = Borrow::create([
                'desc' => $request->desc,
                'user_id' => auth()->user()->id,
                'sub_item_id' => $subitem->id
            ]);

            History::create([
                'borrow_id' => $borrow->id
            ]);

            return redirect()->route('dashboard.borrow.show', $borrow->uuid)->with('success', 'Peminjaman telah diajukan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
