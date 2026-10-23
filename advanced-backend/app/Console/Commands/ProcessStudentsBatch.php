<?php

namespace App\Console\Commands;

use App\Models\BatchStudent;
use Illuminate\Console\Command;

class ProcessStudentsBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'app:process-students-batch';

    /**
     * The console command description.
     *
     */
    protected $description = 'Memporoses data siswa  per kelompok';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $total = 0;
        $kompeten = 0;
        $belumKompeten = 0;
        $nomorBatch = 0;
        $this->info('Memulai Batch Processing...');

        BatchStudent::query()
            ->chunkById(100, function($students) use(
            &$total,
            &$kompeten,
            &$belumKompeten,
            &$nomorBatch
            ){
                $nomorBatch++;

                foreach($students as $student){
                    $total++;

                    if ($student->nilai >= 80) {
                        $kompeten++;
                    } else {
                        $belumKompeten++;
                    }
                }
                
                $this->info(
                    "Batch {$nomorBatch} selesai: "
                    . count($students)
                    . ' siswa diproses.'
                );
            });

            $this->newLine();
            $this->info('=== HASIL BATCH PROCESSING ===');
            $this->info("Total siswa        : {$total}");
            $this->info("Kompeten           : {$kompeten}");
            $this->info("Belum Kompeten     : {$belumKompeten}");

            return self::SUCCESS;
    }
}
