<?php

namespace App\Console\Commands;

use App\Models\BatchStudent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'app:cache-students';

    /**
     * The console command description.
     *
     */
    protected $description = 'Menyimpan daftar siswa ke Redis cache';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $students = Cache::store('redis')->remember(
            'students:all',
            300,
            function () {
                $this->info('Cache miss: membaca database.');
                return BatchStudent::query()
                    ->select('id', 'nama', 'nilai')
                    ->orderBy('id')
                    ->get()
                    ->toArray();
                }
        );
        $this->info('Jumlah siswa: ' . count($students));
        return self::SUCCESS;
    }
}
