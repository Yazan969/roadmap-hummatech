<?php

namespace App\Http\Controllers\Api;

use App\Handlers\SiswaHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Repositories\SiswaRepository;
use App\Services\SiswaService;

class SiswaController extends Controller
{
    public function __construct(
        private SiswaService $service,
        private SiswaRepository $repository,
        private SiswaHandler $handler
    ) {}

    // Mengambil semua data siswa
    public function index()
    {
        return response()->json(
            $this->repository->getAll()
        );
    }

    // Mengambil satu siswa berdasarkan ID
    public function show(int $id)
    {
        $siswa = $this->handler->getSiswaById($id);

        return response()->json([
            'data' => $siswa,
        ]);
    }

    // Menambahkan siswa
    public function store(SiswaRequest $request)
    {
        $data = $request->validated();

        $siswa = $this->service->tambahSiswa($data);

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan.',
            'data' => $siswa,
            'status' => $this->service->tentukanStatus(
                (int) $siswa->nilai
            ),
        ], 201);
    }

    // Memperbarui siswa
    public function update(SiswaRequest $request, int $id)
    {
        $data = $request->validated();

        $siswa = $this->service->updateSiswa($id, $data);

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui.',
            'data' => $siswa,
            'status' => $this->service->tentukanStatus(
                (int) $siswa->nilai
            ),
        ]);
    }

    // Menghapus siswa
    public function destroy(int $id)
    {
        $this->handler->hapusSiswa($id);

        return response()->json([
            'message' => 'Data siswa berhasil dihapus.',
        ]);
    }
}
