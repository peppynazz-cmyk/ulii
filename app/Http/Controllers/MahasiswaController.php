<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index()
    {
        $mahasiswa = \App\Models\Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'program_studi' => 'required',
            'email' => 'required|email|unique:mahasiswas',
            'angkatan' => 'required|numeric',
        ]);

        \App\Models\Mahasiswa::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,'.$id,
            'nama' => 'required',
            'program_studi' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,'.$id,
            'angkatan' => 'required|numeric',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
