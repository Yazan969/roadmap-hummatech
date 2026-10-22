<?php

namespace App\Services;

use App\Handlers\SiswaHandler;

class SiswaService
{
    public function __construct(private SiswaHandler $handler) {}

    public function tambahSiswa(array $data)
    {
        $this->validasiNilai( $data['nilai']);
        return $this->handler->tambahSiswa($data);
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
            $this->validasiNilai($data['nilai']);
        }
        return $this->handler->updateSiswa($id, $data);
    }

    public function hapusSiswa(int $id): bool
    {
        return $this->handler->hapusSiswa($id);
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

