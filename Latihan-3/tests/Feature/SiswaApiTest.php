<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;


class SiswaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_dapat_menampilkan_detail_siswa(): void
    {
        $siswa = Siswa::create([
            'nama' => 'Budi',
            'nilai' => 85,
        ]);

        $response = $this->getJson('/api/siswa/' . $siswa->id);

        $response->assertOk()
            ->assertJsonFragment([
                'nama' => 'Budi',
                'nilai' => 85,
            ]);
    }


    public function test_api_dapat_menambahkan_siswa(): void
    {
        $response = $this->postJson('/api/siswa', [
            'nama' => 'Citra',
            'nilai' => 95,
        ]);

        $response->assertCreated()
            ->assertJsonFragment([
                'nama' => 'Citra',
                'nilai' => 95,
            ]);

        $this->assertDatabaseHas('siswas', [
            'nama' => 'Citra',
            'nilai' => 95,
        ]);
    }


    public function test_api_dapat_memperbarui_siswa(): void
    {
        $siswa = Siswa::create([
            'nama' => 'Dina',
            'nilai' => 70,
        ]);

        $response = $this->putJson('/api/siswa/' . $siswa->id, [
            'nama' => 'Dina Putri',
            'nilai' => 90,
        ]);

        $response->assertOk()
            ->assertJsonFragment([
                'nama' => 'Dina Putri',
                'nilai' => 90,
            ]);

        $this->assertDatabaseHas('siswas', [
            'id' => $siswa->id,
            'nama' => 'Dina Putri',
            'nilai' => 90,
        ]);
    }


    public function test_api_dapat_menghapus_siswa(): void
    {
        $siswa = Siswa::create([
            'nama' => 'Eko',
            'nilai' => 80,
        ]);

        $response = $this->deleteJson('/api/siswa/' . $siswa->id);

        $response->assertOk();

        $this->assertDatabaseMissing('siswas', [
            'id' => $siswa->id,
        ]);
    }


    public function test_api_mengembalikan_404_jika_siswa_tidak_ditemukan(): void
    {
        $response = $this->getJson('/api/siswa/999999');

        $response->assertNotFound();
    }
}
