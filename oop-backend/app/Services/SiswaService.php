<?php

namespace App\Services;

use App\Handlers\SiswaHandler;

class SiswaService
{
    public function __construct(
        private SiswaHandler $handler
    ) {}

    public function tambahSiswa(array $data)
    {
        return $this->handler->tambahSiswa($data);
    }

    public function tentukanStatus(int $nilai): string
    {
        return $nilai >= 80
            ? 'Kompeten'
            : 'Belum Kompeten';
    }

    public function updateSiswa(int $id, array $data)
    {
        return $this->handler->updateSiswa($id, $data);
    }
}
