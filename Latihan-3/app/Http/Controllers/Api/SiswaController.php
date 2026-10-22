<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SiswaRepository;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    
    public function __construct(private SiswaService $service,private SiswaRepository $repository)
    {}

    public function index()
    {
        return response()->json(
            $this->repository->getAll()
        );
    }

    public function show(int $id)
    {
        $siswa = $this->repository->findById($id);

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
                $siswa->nilai
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
        $this->repository->delete($id);

        return response()->json([
            'message' => 'Data siswa berhasil dihapus',
        ]);
    }
}
