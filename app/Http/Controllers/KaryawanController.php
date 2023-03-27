<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::latest()->get();

        return Inertia::render('Karyawan/Index', ['karyawans' => $karyawans]);
    }

    public function create()
    {
        $karyawan = new Karyawan();
        return Inertia::render('Karyawan/Create', ['karyawan' => $karyawan]);
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $data = [
            'nama_karyawan' => $req->nama_karyawan,
            'alamat' => $req->alamat
        ];
        // dd($data);

        $karyawan = Karyawan::create($data);

        if ($karyawan) {
            return redirect('karyawans')->with('message', 'Data Karyawan Berhasil Disimpan!');
        }
    }

    public function edit(Request $request, Karyawan $karyawan)
    {
        return Inertia::render('Karyawan/Create', ['karyawan' => $karyawan]);
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $data = [
            'nama_karyawan' => $request->nama_karyawan,
            'alamat' => $request->alamat
        ];
        $update = $karyawan->update($data);

        if ($update) {
            return redirect('karyawans')->with('message', 'Data Karyawan Berhasil Di Update!');
        }
    }

    public function destroy(Request $request, Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect('karyawans')->with('message', 'Data Karyawan Berhasil Di Hapus!');
    }
}
