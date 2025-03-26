<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = $this->argument('name');
        $repositoryPath = app_path("Repositories/{$name}.php");

        if (file_exists($repositoryPath)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        // Ensure the directory exists
        (new Filesystem)->ensureDirectoryExists(app_path('Repositories'));

        // Define the repository template
        $template = <<<PHP
<?php

namespace App\Repositories;

use App\Models\YourModel; 

class {$name}
{
    protected \$model;

    public function __construct(YourModel \$model)
    {
        \$this->model = \$model;
    }

    public function all()
    {
        return \$this->model->all();
    }

    public function find(\$id)
    {
        return \$this->model->find(\$id);
    }

    public function create(array \$data)
    {
        return \$this->model->create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$record = \$this->model->find(\$id);
        return \$record ? \$record->update(\$data) : false;
    }

    public function delete(\$id)
    {
        return \$this->model->destroy(\$id);
    }
}
PHP;

        file_put_contents($repositoryPath, $template);
        $this->info("Repository {$name} created successfully.");
    }
}
