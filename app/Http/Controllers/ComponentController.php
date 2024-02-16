<?php

namespace App\Http\Controllers;

use App\Constants\SubItemCondition;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\Component;
use App\Models\Item;
use App\Models\SubItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function store(StoreComponentRequest $request)
    {
        try {
            $item = Item::findOrFail($request->item_id);

            $component = Component::create([
                'name' => $request->name,
                'item_id' => $item->id,
            ]);

            foreach ($item->subitems as $subitem) {
                $component->subitems()->attach($subitem, ['condition' => SubItemCondition::GOOD]);
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update(UpdateComponentRequest $request, Component $component)
    {
        try {
            $component->name = $request->name;
            $component->update();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Component $component)
    {
        try {
            $component->delete();

            return redirect()->route('dashboard.master.item.show', $component->item->uuid)->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update_component_subitem(Request $request, $pivotId)
    {
        try {
            $componentSubItem = DB::table('component_sub_item')->where('id', $pivotId)->first();

            if (!$componentSubItem) {
                throw new \Error('Data tidak ditemukan.');
            }

            DB::table('component_sub_item')->where('id', $pivotId)->update(['condition' => $request->condition]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
