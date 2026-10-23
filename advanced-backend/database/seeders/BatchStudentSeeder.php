<?php

namespace Database\Seeders;

use App\Models\BatchStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (BatchStudent::exists()) {
            $this->command->warn(
                'Tabel sudah berisi data. Seeder dilewati.'
            ); 
            return;
        }

        for ($i=1; $i <= 1000; $i++) { 
            BatchStudent::create([
                'nama' => "Siswa {$i}",
                'nilai' => rand(50, 100),
            ]);

            $this->command->info(
                'Berhasil membuat 1000 data siswa.'
            );
        }
    }
}
