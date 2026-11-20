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
        $siswa = Siswa::all();

        return response()->json([
            'data' => $siswa,
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data' => $siswa,
        ], 200);
    }

    public function store(SiswaRequest $request): JsonResponse
    {
        $siswa = Siswa::create($request->validated());

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan.',
            'data' => $siswa,
        ], 201);
    }

    public function update(SiswaRequest $request,int $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan.',
            ], 404);
        }

        $siswa->update($request->validated());

        return response()->json([
            'message' => 'Data siswa berhasil diubah.',
            'data' => $siswa->fresh(),
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan.',
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'message' => 'Data siswa berhasil dihapus.',
        ], 200);
    }
}
