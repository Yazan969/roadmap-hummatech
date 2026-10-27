<?php
namespace App\Repositories;

use App\Models\Siswa;
use App\Interfaces\SiswaRepositoryInterface;

class SiswaRepository implements SiswaRepositoryInterface
{
    public function getAll()
    {
        return Siswa::all();
    }
    public function findById(int $id)
    {
        return Siswa::find($id);
    }
    public function create(array $data)
    {
        return Siswa::create($data);
    }
    public function update(int $id, array $data)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return null;
        }
        $siswa->update($data);
        return $siswa;
    }

    public function delete(int $id):bool
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return false;
        }
        return $siswa->delete();
    }
}

