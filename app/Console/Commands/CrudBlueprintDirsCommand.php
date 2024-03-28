<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudBlueprintDirsCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:dirs
                            {name : The name of the Crud.}
                            {--namespace_group=  : the namespace of crud.}';

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
        $name = $this->argument('name');

        $listOfDirs = $this->getDirsList()['dir_names'];
        $namespace_group = $this->option('namespace_group') ?: null;

        $_basePath = app_path() . DIRECTORY_SEPARATOR . $this->getDirsList()['main-container-dir-name'] . DIRECTORY_SEPARATOR;
        if($namespace_group){
            $_basePath.= $namespace_group. DIRECTORY_SEPARATOR;
            $this->createDir($_basePath);
        }
        $rootPathOfModule = $_basePath . Str::ucfirst($name) . DIRECTORY_SEPARATOR;

        $this->createDir($rootPathOfModule);

        foreach ($listOfDirs as $oneDir) {
            $this->createDir($rootPathOfModule . $oneDir);
        }

    }

    protected function createDir($path)
    {
        if(!file_exists($path)){
            mkdir($path);
        }

    }

    protected function getTemplatePath($name): string
    {

        $path = empty(config('crudgenerator.custom_template'))
            ? config('crudgenerator.default_template_path') : config('crudgenerator.custom_template');

        return $path . $name;

    }

    protected function getDirsList(): array
    {

        return empty(config('crudgenerator.dirs')) ? [] : config('crudgenerator.dirs');


    }
}
