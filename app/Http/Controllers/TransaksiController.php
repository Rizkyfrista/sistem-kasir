<?php

namespace App\Http\Controllers;

use App\Models\HeaderBelanja;
use App\Models\Item;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaction = HeaderBelanja::latest()->get();

        return Inertia::render('Transaksi/Index', ['transactions' => $transaction]);
    }

    public function create()
    {
        $karyawans = Karyawan::get();
        $items = Item::get();
        $transaction = new HeaderBelanja();

        return Inertia::render('Transaksi/Create', ['karyawans' => $karyawans, 'items' => $items, 'transaction' => $transaction]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = [
            'tanggal_belanja' => $request->tanggal_belanja,
            'id_karyawan' => $request->id_karyawan,
            'total_belanja' => $request->total_belanja
        ];

        $transaction = HeaderBelanja::create($data);

        if ($transaction) {
            return redirect('transaction')->with('message', 'Transaksi Berhasil Disimpan!');
        }
    }

    public function edit(Request $request, HeaderBelanja $transaction)
    {
        return Inertia::render('Transaksi/Create', ['transaction' => $transaction]);
    }

    public function update(Request $request, HeaderBelanja $transaction)
    {
        $data = [
            'tanggal_belanja' => $request->tanggal_belanja,
            'id_karyawan' => $request->id_karyawan,
            'total_belanja' => $request->total_belanja
        ];
        $update = $transaction->update($data);

        if ($update) {
            return redirect('transactions')->with('message', 'Transaksi Berhasil Di Update!');
        }
    }

    public function destroy(Request $request, HeaderBelanja $transaction)
    {
        $transaction->delete();
        return redirect('transactions')->with('message', 'Transaksi Berhasil Di Hapus!');
    }
}
