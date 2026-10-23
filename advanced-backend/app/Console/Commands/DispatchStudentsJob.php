<?php

namespace App\Console\Commands;

use App\Jobs\ProcessStudentsJob;
use Illuminate\Console\Command;

class DispatchStudentsJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'app:dispatch-students';

    /**
     * The console command description.
     *
     */
    protected $description = 'Memasukkan Job pemrosesan siswa ke Queue';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        ProcessStudentsJob::dispatch();

        $this->info('Job pemrosesan siswa berhasil dimasukan ke antrean.');

        return self::SUCCESS;
    }
}
