<?php

namespace App\Http\Controllers;

use App\Constants\StatusPeminjaman;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Borrow;
use App\Models\History;

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
        //
    }

    public function store(StoreBorrowRequest $request)
    {
        //
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
