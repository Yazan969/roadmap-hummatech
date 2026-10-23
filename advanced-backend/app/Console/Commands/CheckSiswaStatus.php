<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckSiswaStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'app:check-siswa';

    /**
     * The console command description.
     *
     */
    protected $description = 'Memeriksa status siswa secara terjadwal';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $waktu = now('Asia/Jakarta')
            ->format('Y-m-d H:i:s');
        

        $pesan = "Pengecekan status siswa berjalan pada {$waktu}";

        $this->info($pesan);

        Log::info($pesan);
        
        return self::SUCCESS;
    }
}
