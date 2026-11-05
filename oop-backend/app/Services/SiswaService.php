<?php

namespace App\Services;

use App\Handlers\SiswaHandler;

class SiswaService
{

    public function tentukanStatus(int $nilai): string
    {
        return $nilai >= 80
            ? 'Kompeten'
            : 'Belum Kompeten';
    }

}
