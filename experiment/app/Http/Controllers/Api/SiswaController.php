<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
        $siswa = Siswa::all();
        return response()->json($siswa);
    }

    public function show($id) {
        $siswa = Siswa::find($id);
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
            'massage'=> 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
        }

}
