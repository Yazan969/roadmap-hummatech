<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();

        return response()->json($siswa);
    }

    public function show($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json($siswa);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string',
            'nilai' => 'required|integer|min:0|max:100'
        ]);

        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nilai' => $request->nilai
        ]);

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string',
            'nilai' => 'required|integer|min:0|max:100'
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'nilai' => $request->nilai
        ]);

        return response()->json([
            'message' => 'Data siswa berhasil di ubah',
            'data' => $siswa
        ], 200);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak di temukan'
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'message' => 'Data siswa berhasil di hapus'
        ], 200);
    }
}
