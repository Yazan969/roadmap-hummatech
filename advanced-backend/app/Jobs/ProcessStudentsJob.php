<?php

namespace App\Jobs;

use App\Models\BatchStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessStudentsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = 0;
        $kompeten = 0;

        BatchStudent::query()
            ->select('id','nilai')
            ->chunkById(100, function ($students) use (&$total, &$kompeten) {
                foreach($students as $student) {
                    $total++;

                    if ($student->nilai >= 80) {
                        $kompeten++;
                    }
                }
            });
        Log::info('Job pemrosesan siswa selesai', [
            'total_siswa' => $total,
            'kompeten' => $kompeten,
            'belum_kompeten' => $total - $kompeten,
        ]);
    }
}
