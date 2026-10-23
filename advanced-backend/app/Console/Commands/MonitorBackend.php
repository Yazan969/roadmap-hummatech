<?php

namespace App\Console\Commands;

use App\Models\BatchStudent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class MonitorBackend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monitor-backend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memantau kondisi sederhana backend';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $totalSiswa = BatchStudent::count();

        $totalJobGagal = Schema::hasTable('failed_jobs')
            ? DB::table('failed_jobs')->count()
            : 0;

        Log::info('Monitoring backend', [
            'total_siswa' => $totalSiswa,
            'total_job_gagal' => $totalJobGagal,
            'waktu_pemeriksaan' => now()->toDateTimeString(),
        ]);

        $this->info("Total siswa: {$totalSiswa}");
        $this->info("Total Job gagal: {$totalJobGagal}");

        return self::SUCCESS;
    }
}
