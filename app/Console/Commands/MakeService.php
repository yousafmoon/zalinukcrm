<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $file = app_path("Services/{$name}.php");

        if (file_exists($file)) {
            $this->error('Service already exists!');
            return;
        }

        $stub = <<<PHP
        <?php

        namespace App\Services;

        class {$name}
        {
            //
        }
        PHP;

        (new Filesystem)->ensureDirectoryExists(app_path('Services'));
        file_put_contents($file, $stub);

        $this->info("Service {$name} created successfully.");
    }
}
