<?php

namespace App\Handlers;

use App\Exceptions\SiswaNotFoundException;
use App\Interfaces\SiswaRepositoryInterface;

class SiswaHandler
{
    public function __construct(private SiswaRepositoryInterface $repository)
    {}

    public function tambahSiswa(array $data)
    {
        if (!isset($data['nilai'])) {
            throw new \InvalidArgumentException(
                'Nilai wajib diisi.'
            );
        }
        return $this->repository->create($data);
    }
    public function updateSiswa(int $id, array $data)
    {
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

}