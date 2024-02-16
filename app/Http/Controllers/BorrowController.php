<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Borrow;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with('histories', 'subitem')
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

    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowRequest $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}
