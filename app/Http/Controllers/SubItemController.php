<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubItemRequest;
use App\Http\Requests\UpdateSubItemRequest;
use App\Models\Item;
use App\Models\SubItem;

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

    public function store(StoreSubItemRequest $request, $itemUuid)
    {
        try {
            $item = Item::where('uuid', $itemUuid)->first();

            SubItem::create([
                'name' => $request->name,
                'condition' => $request->condition,
                'item_id' => $item->id,
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(SubItem $subItem)
    {
        //
    }

    public function edit($subItemUuid)
    {
        $subItem = SubItem::where('uuid', $subItemUuid)->first();;
        $item = $subItem->item;
        
        return view('pages.master.subitem.edit', compact('item', 'subItem'));
    }

    public function update(UpdateSubItemRequest $request, $subItemUuid)
    {
        try {
            $subItem = SubItem::where('uuid', $subItemUuid)->first();

            $subItem->name = $request->name;
            $subItem->condition = $request->condition;
            $subItem->save();

            return redirect()->back()->with('success', 'Data berhasil diedit.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(SubItem $subItem)
    {
        //
    }
}
