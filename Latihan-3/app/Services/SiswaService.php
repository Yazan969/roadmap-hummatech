<?php

namespace App\Services;

use App\Exceptions\SiswaNotFoundException;
use App\Interfaces\SiswaRepositoryInterface;

class SiswaService
{
    public function __construct(private SiswaRepositoryInterface $repository) {}

    public function getAllSiswa()
    {
        return $this->repository->getAll();
    }

    public function getSiswaById(int $id)
    {
        $siswa = $this->repository->findById($id);
        if (!$siswa) {
            throw new SiswaNotFoundException();
        }
        return $siswa;
    }

    public function tambahSiswa(array $data)
    {
        if (!isset($data['nilai'])) {
            throw new \InvalidArgumentException(
                'Nilai wajib diisi.'
            );
        }
        $this->validasiNilai((int) $data['nilai']);
        return $this->repository->create($data);
    }

    public function tentukanStatus(int $nilai): string
    {
        $this->validasiNilai($nilai);
        return $nilai >= 80
            ? 'Kompeten'
            : 'Belum Kompeten';
    }

    public function updateSiswa(int $id, array $data)
    {
        if (isset($data['nilai'])) {
            $this->validasiNilai((int) $data['nilai']);
        }
        $siswa = $this->repository->update($id, $data);
        if (!$siswa) {
            throw new SiswaNotFoundException();
        }
        return $siswa;
    }

    public function hapusSiswa(int $id): bool
    {
        $siswa = $this->repository->delete($id);
        if (!$siswa) {
            throw new SiswaNotFoundException();
        }
        return $siswa;
    }

    private function validasiNilai(int $nilai): void
    {
        if ($nilai < 0 || $nilai > 100) {
            throw new \InvalidArgumentException(
                'Nilai harus antara 0 sampai 100.'
            );
        }
    }
}

