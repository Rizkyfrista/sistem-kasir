<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();

        return Inertia::render('Item/Index', ['items' => $items]);
    }

    public function create()
    {
        $item = new Item();
        return Inertia::render('Item/Create', ['item' => $item]);
    }

    public function store(Request $request)
    {
        $data = [
            'nama_item' => $request->nama_item,
            'harga_item' => $request->harga_item,
            'satuan' => $request->satuan
        ];

        $item = Item::create($data);

        if ($item) {
            return redirect('items')->with('message', 'Item Berhasil Disimpan!');
        }
    }

    public function edit(Request $request, Item $item)
    {
        return Inertia::render('Item/Create', ['item' => $item]);
    }

    public function update(Request $request, Item $item)
    {
        $data = [
            'nama_item' => $request->nama_item,
            'harga_item' => $request->harga_item,
            'satuan' => $request->satuan
        ];
        $update = $item->update($data);

        if ($update) {
            return redirect('items')->with('message', 'Item Berhasil Di Update!');
        }
    }

    public function destroy(Request $request, Item $item)
    {
        $item->delete();
        return redirect('items')->with('message', 'Item Berhasil Di Hapus!');
    }
}
