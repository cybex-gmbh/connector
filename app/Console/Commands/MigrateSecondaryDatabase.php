<?php

namespace App\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateCommand;

class MigrateSecondaryDatabase extends MigrateCommand
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command overwrites the "php artisan migrate" command to ensure no migrations are run on the main database.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        $migrator = app("migrator");
        $dispatcher = app("events");

        parent::__construct($migrator, $dispatcher);
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->input->setOption('database', config('connector.secondary_database.connection'));

        parent::handle();
    }
}
