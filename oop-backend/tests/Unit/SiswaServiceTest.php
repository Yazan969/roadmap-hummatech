<?php

namespace Tests\Unit;

use App\Repositories\SiswaRepositoryDummy;
use App\Repositories\SiswaRepositoryInterface;
use App\Services\SiswaService;
use PHPUnit\Framework\TestCase;

class SiswaServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_nilai_80_dinyatakan_kompeten(): void
    {
        $repository = $this->createMock(
            SiswaRepositoryInterface::class
        );

        $service = new SiswaService($repository);

        $hasil = $service->tentukanStatus(80);

        $this->assertSame('Kompeten', $hasil);
    }

    public function test_nilai_di_bawah_80_dinyatakan_belum_kompeten(): void
    {
        $repository = $this->createMock(
            SiswaRepositoryInterface::class
        );

        $service = new SiswaService($repository);

        $hasil = $service->tentukanStatus(79);

        $this->assertSame('Belum Kompeten', $hasil);
    }


    public function test_service_dapat_menggunakan_repository_dummy(): void
    {
        $repository = new SiswaRepositoryDummy();

        $service = new SiswaService($repository);

        $siswa = $service->getSiswaById(1);

        $this->assertSame('Andi', $siswa->nama);
        $this->assertSame('Kompeten', $service->tentukanStatus(
            (int) $siswa->nilai
        ));
    }
}
