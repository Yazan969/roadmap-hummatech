<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SiswaRequest;
use App\Models\Siswa;
use Illuminate\Http\JsonResponse;

class SiswaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Data siswa berhasil diambil',
            'data' => Siswa::all(),
        ]);
    }

    public function store(SiswaRequest $request): JsonResponse
    {
        $siswa = Siswa::create($request->validated());

        return response()->json([
            'message' => 'Siswa berhasil ditambahkan',
            'data' => $siswa,
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Siswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswa,
        ]);
    }

    public function update(SiswaRequest $request, string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Siswa tidak ditemukan',
            ], 404);
        }

        $siswa->update($request->validated());

        return response()->json([
            'message' => 'Siswa berhasil diperbarui',
            'data' => $siswa->fresh(),
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Siswa tidak ditemukan',
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'message' => 'Siswa berhasil dihapus',
        ]);
    }
}
