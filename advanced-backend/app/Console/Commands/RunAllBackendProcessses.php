<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunAllBackendProcessses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan rangkaian proses Advanced Backend';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
         // 1. Jalankan Scheduler untuk tugas yang sudah jatuh tempo.
        if ($this->runStep('Scheduler', 'schedule:run') !== self::SUCCESS) {
            return self::FAILURE;
        }

        // 2. Proses data siswa secara bertahap.
        if ($this->runStep(
            'Batch Processing',
            'app:process-students-batch'
        ) !== self::SUCCESS) {
            return self::FAILURE;
        }

        // 3. Simpan atau ambil data siswa melalui Redis Cache.
        if ($this->runStep(
            'Redis Caching',
            'app:cache-students'
        ) !== self::SUCCESS) {
            return self::FAILURE;
        }

        // 4. Kirim Job ke antrean.
        if ($this->runStep(
            'Dispatch Message Queue',
            'app:dispatch-students'
        ) !== self::SUCCESS) {
            return self::FAILURE;
        }

        // 5. Proses Job yang mengantre, lalu berhenti ketika antrean kosong.
        if ($this->runStep(
            'Queue Worker',
            'queue:work',
            ['--stop-when-empty' => true]
        ) !== self::SUCCESS) {
            return self::FAILURE;
        }

        // 6. Periksa kondisi backend setelah proses selesai.
        if ($this->runStep(
            'Monitoring',
            'app:monitor-backend'
        ) !== self::SUCCESS) {
            return self::FAILURE;
        }

        $this->info('=== SEMUA PROSES SELESAI ===');

        return self::SUCCESS;
    }

    private function runStep(
        string $label,
        string $command,
        array $parameters = []
    ): int {
        $this->newLine();
        $this->info("--- {$label} ---");

        $exitCode = $this->call($command, $parameters);

        if ($exitCode !== self::SUCCESS) {
            $this->error("Proses {$label} gagal.");

            return self::FAILURE;
        }

        $this->info("Proses {$label} selesai.");

        return self::SUCCESS;
    }
}
