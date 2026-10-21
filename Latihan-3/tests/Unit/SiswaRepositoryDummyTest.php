<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\SiswaRepositoryDummy;

class SiswaRepositoryDummyTest extends TestCase
{
    public function test_dummy_dapat_mengambil_semua_siswa(): void
    {
        $repository = new SiswaRepositoryDummy();

        $hasil = $repository->getAll();

        $this->assertCount(2, $hasil);
        $this->assertSame('Andi', $hasil->first()->nama);
    }

    public function test_dummy_dapat_menambahkan_siswa(): void
    {
        $repository = new SiswaRepositoryDummy();

        $siswa = $repository->create([
            'nama' => 'Citra',
            'nilai' => 95,
        ]);

        $this->assertSame('Citra', $siswa->nama);
        $this->assertSame(95, $siswa->nilai);
    }


    public function test_dummy_dapat_memperbarui_siswa(): void
    {
        $repository = new SiswaRepositoryDummy();

        $siswa = $repository->update(1, [
            'nama' => 'Andi Update',
            'nilai' => 95,
        ]);

        $this->assertSame('Andi Update', $siswa->nama);
        $this->assertSame(95, $siswa->nilai);
    }

    public function test_dummy_dapat_menghapus_siswa(): void
    {
        $repository = new SiswaRepositoryDummy();

        $berhasil = $repository->delete(1);

        $this->assertTrue($berhasil);
        $this->assertNull($repository->findById(1));
    }
}
