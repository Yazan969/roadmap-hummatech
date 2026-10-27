<?php

namespace App\Handlers;

use App\Exceptions\SiswaNotFoundException;
use App\Interfaces\SiswaRepositoryInterface;

class SiswaHandler
{
    public function __construct(
        private SiswaRepositoryInterface $repository
    ) {}

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
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new SiswaNotFoundException();
        }

        return true;
    }
}
