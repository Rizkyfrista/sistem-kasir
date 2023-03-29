<?php

namespace App\Http\Controllers;

use App\Models\DetailBelanja;
use App\Models\HeaderBelanja;
use App\Models\Item;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'tanggal_belanja' => date('Y-m-d H:i:s'),
            'id_karyawan' => $request->id_karyawan,
            'total_belanja' => $request->total_belanja,
        ];

        // $dataDetail = [
        //     'id_belanja' => $request->id,
        //     'id_item' => $request->id_item,
        //     'quantity' => $request->quantity,
        //     'jumlah' => $request->jumlah
        // ];

        $transaction = HeaderBelanja::create($data);

        if ($transaction) {
            $details = $request->detail;

            if (count($details) > 0) {
                foreach ($details as $detail) {
                    $dataDetail = [
                        'id_belanja' => $transaction->id,
                        'id_item' => $detail['item'],
                        'quantity' => $detail['quantity'],
                        'jumlah' => $detail['jumlah'],
                    ];

                    DetailBelanja::create($dataDetail);
                }
            }
            return Redirect::route('transactions.index')->with('message', 'Data Berhasil Disimpan!');

            // return redirect('transaction')->with('message', 'Transaksi Berhasil Disimpan!');
        }
    }

    public function show(HeaderBelanja $transaction)
    {
        $jumlahTotal = 0;
        foreach ($transaction->items as $item) {
            $jumlahTotal += $item->pivot->jumlah;
        }
        return Inertia::render('Transaksi/Detail', [
            'details' => $transaction->items,
            'jumlahTotal' => $jumlahTotal,
        ]);
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

        $deleteTx = DetailBelanja::where('id_belanja', $transaction->id)->delete();
        if ($deleteTx) {
            $transaction->delete();
        }

        return redirect('transactions')->with('message', 'Transaksi Berhasil Di Hapus!');
    }
}
