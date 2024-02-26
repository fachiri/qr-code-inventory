<?php

namespace App\Http\Controllers;

use App\Constants\StatusPeminjaman;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Borrow;
use App\Models\History;
use App\Models\SubItem;

class BorrowController extends Controller
{
    public function index()
    {
        $query = Borrow::query();

        if (auth()->user()->student || auth()->user()->lecturer) {
            $query->where('user_id', auth()->user()->id);
        }

        $borrows = $query->with('histories', 'subitem')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.borrow.index', compact('borrows'));
    }

    public function create()
    {
        $subitems = SubItem::with('item')->get();

        return view('pages.borrow.create', compact('subitems'));
    }

    public function store(StoreBorrowRequest $request)
    {
        try {
            $subitem = SubItem::where('uuid', $request->subitem_uuid)->first();

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

    public function show(Borrow $borrow)
    {
        return view('pages.borrow.show', compact('borrow'));
    }

    public function reject(Borrow $borrow)
    {
        try {
            $currentStatus = $borrow->histories()->latest()->first()->status;

            if ($currentStatus === StatusPeminjaman::REJECTED) {
                throw new \Error('Permintaan telah ditolak.');
            }

            if ($currentStatus !== StatusPeminjaman::PENDING) {
                throw new \Error('Permintaan gagal.');
            }

            History::create([
                'borrow_id' => $borrow->id,
                'admin_id' => auth()->user()->admin->id,
                'status' => StatusPeminjaman::REJECTED
            ]);

            return redirect()->back()->with('success', 'Peminjaman telah ditolak.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function cancel(Borrow $borrow)
    {
        try {
            $currentStatus = $borrow->histories()->latest()->first()->status;

            if ($currentStatus === StatusPeminjaman::CANCELED) {
                throw new \Error('Permintaan telah dibatalkan.');
            }

            if ($currentStatus !== StatusPeminjaman::PENDING) {
                throw new \Error('Permintaan gagal.');
            }

            History::create([
                'borrow_id' => $borrow->id,
                'status' => StatusPeminjaman::CANCELED
            ]);

            return redirect()->back()->with('success', 'Peminjaman telah dibatalkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function approve(Borrow $borrow)
    {
        try {
            $currentStatus = $borrow->histories()->latest()->first()->status;

            if ($currentStatus === StatusPeminjaman::APPROVED) {
                throw new \Error('Permintaan telah disetujui.');
            }

            if ($currentStatus !== StatusPeminjaman::PENDING) {
                throw new \Error('Permintaan gagal.');
            }

            History::create([
                'borrow_id' => $borrow->id,
                'admin_id' => auth()->user()->admin->id,
                'status' => StatusPeminjaman::APPROVED
            ]);

            return redirect()->back()->with('success', 'Peminjaman telah disetujui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function return(Borrow $borrow)
    {
        try {
            $currentStatus = $borrow->histories()->latest()->first()->status;

            if ($currentStatus === StatusPeminjaman::RETURNED) {
                throw new \Error('Barang telah dikembalikan.');
            }

            if ($currentStatus !== StatusPeminjaman::APPROVED) {
                throw new \Error('Barang belum dipinjam.');
            }

            History::create([
                'borrow_id' => $borrow->id,
                'admin_id' => auth()->user()->admin->id,
                'status' => StatusPeminjaman::RETURNED
            ]);

            return redirect()->back()->with('success', 'Barang telah dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
