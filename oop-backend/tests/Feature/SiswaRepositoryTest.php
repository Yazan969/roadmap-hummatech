<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Siswa;
use App\Repositories\SiswaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiswaRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_repository_dapat_menyimpan_siswa(): void
    {
        $repository = new SiswaRepository();

        $siswa = $repository->create([
            'nama' => 'Andi',
            'nilai' => 90,
        ]);

        $this->assertDatabaseHas('siswas', [
            'id' => $siswa->id,
            'nama' => 'Andi',
            'nilai' => 90,
        ]);
    }

    public function test_repository_dapat_mengambil_semua_siswa(): void
    {
        Siswa::create([
            'nama' => 'Budi',
            'nilai' => 85,
        ]);

        $repository = new SiswaRepository();

        $hasil = $repository->getAll();

        $this->assertCount(1, $hasil);
        $this->assertSame('Budi', $hasil->first()->nama);
    }
}
