<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct(private SiswaService $service)
    {}

    public function index ()
    {
        return response()->json(
            $this->service->getAllSiswa()
        );
    }

    public function show (int $id)
    {
        $siswa = $this->service->getSiswaById($id);

        return response()->json($siswa);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:225',
            'nilai' => 'required|integer|min:0|max:100',
        ]);
        $siswa = $this->service->tambahSiswa($data);
        return response()->json([
            'message' => 'Data siswa berhasil di tambahkan',
            'data' => $siswa,
            'status' => $this->service->tentukanStatus(
                (int) $siswa->nilai
            ),
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nama' => 'sometimes|required|string|max:225',
            'nilai' => 'sometimes|required|integer|min:0|max:100'
        ]);
        
        $siswa = $this->service->updateSiswa($id, $data);

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui',
            'data' => $siswa,
        ]);
    }

    public function destroy(int $id)
    {
        $this->service->hapusSiswa($id);

        return response()->json([
            'mesasge' => 'Data siswa berhasil dihapus',
        ]);
    }
}
