<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-users:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Users from a CSV file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = [
            0 => ['email' => 'hetal@gmail.com', 'name' => 'hetal'],
            1 => ['email' => 'nisha@gmail.com', 'name' => 'nisha'],
        ];

        foreach ($users as $user) {
            $this->info('Saved user'.$user['name']);
        }
        $this->info('Done!');
    }
}
