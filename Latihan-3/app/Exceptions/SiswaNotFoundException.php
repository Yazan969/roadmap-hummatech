<?php

namespace App\Exceptions;

use RuntimeException;

class SiswaNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Siswa tidak ditemukan');
    }
}
