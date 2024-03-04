<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendRelancesPotentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:RelancesPotencials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        require_once app_path('functions.php');
        sendRelancePotencialEmail();
        return Command::SUCCESS;
    }
}
