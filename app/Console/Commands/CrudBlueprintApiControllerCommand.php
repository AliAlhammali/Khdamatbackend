<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CrudBlueprintApiControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'crud:api-c
                            {name : The name of the model.}
                            {--namespace_group=  : the namespace of crud.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    private $curentTemplateName = 'api-controllers';


    private $configs = [];
    private $mainPath = '';
    private $requestsMainPath = '';


    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $this->configs = config('crudgenerator');
        $this->mainPath = app_path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR;
        $this->mainPath .= 'API' . DIRECTORY_SEPARATOR . $this->configs['api_version'] . DIRECTORY_SEPARATOR;
        $this->requestsMainPath = app_path() . DIRECTORY_SEPARATOR . $this->configs['dirs']['main-container-dir-name'] . DIRECTORY_SEPARATOR;

    }


    protected function getStub(): string
    {
        $templatesArray = config('crudgenerator.template-names');
        $path = empty(config('crudgenerator.custom_template'))
            ? config('crudgenerator.default_template_path') : config('crudgenerator.custom_template');

        return $path . DIRECTORY_SEPARATOR . $templatesArray[$this->curentTemplateName];
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {

//        $containerDirName = 'App\\' . $this->configs['dirs']['main-container-dir-name'];
//        if ($namespace_group) {
//            $containerDirName .= '\\' . $namespace_group;
//        }
//        $modelNamespace = $containerDirName . '\\' . $name . '\\' . 'Controllers\\'. $this->configs['api_version'] . '\\';


        $name = $this->argument('name');
        $mainNamespace = 'App\\' . $this->configs['dirs']['main-container-dir-name'].'\\';
//        $containerDirName = 'App\Http\Controllers\API\\' . $this->configs['api_version'] . '\\';
        $namespace_group = $this->option('namespace_group');
        $mainPath = app_path(). DIRECTORY_SEPARATOR. $this->configs['dirs']['main-container-dir-name']. DIRECTORY_SEPARATOR;

        if ($namespace_group) {
            $mainNamespace .=   $namespace_group.'\\';
            $mainPath .= $namespace_group . DIRECTORY_SEPARATOR;
            $this->requestsMainPath.= $namespace_group . DIRECTORY_SEPARATOR;
            $this->createDir($this->mainPath);
        }

        $mainPath.= $mainNamespace.= $name. DIRECTORY_SEPARATOR. 'Controllers';
        $this->mainPath = $mainPath;
        $modelName = Str::singular($name);
        $PlaceHolders = [
            'DummyNamespace' => $mainNamespace,
            'ModelName' => $modelName,
            'lModelName' => Str::lcfirst($modelName),
            'pluralName' => $name,
            'class_name_plural_name_space' => $namespace_group?$namespace_group.'\\'.$name:$name,
            'serviceName' => $name . 'Service',
            'lowerSName' => Str::lcfirst($name) . 'Service',
            'ClassNamePlural' => $name . 'Controller',
            'ClassNamePluralAsVar' => Str::lcfirst($name)
        ];

        $stub = $this->files->get($this->getStub());
        foreach ($PlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $dirPath = app_path(). DIRECTORY_SEPARATOR. $this->configs['dirs']['main-container-dir-name']. DIRECTORY_SEPARATOR;
        if ($namespace_group) {
            $dirPath .= $namespace_group . DIRECTORY_SEPARATOR;
        }
        $dirPath = $dirPath . $name. DIRECTORY_SEPARATOR. 'Controllers';


        $this->createDir($dirPath);
        $filePath = $dirPath . DIRECTORY_SEPARATOR . $name . 'Controller' . '.php';
        $this->createFile($filePath, $stub,$namespace_group);

        $this->createRequests($PlaceHolders, $name, $modelName,$namespace_group);
    }


    public function createRequests($PlaceHolders, $name, $modelName,$namespace_group = null)
    {
        $PlaceHolders['DummyNamespace'] = 'App\\' .$this->configs['dirs']['main-container-dir-name'] . '\\' ;
        if($namespace_group){
            $PlaceHolders['DummyNamespace'] .= $namespace_group . '\\';
        }
        $PlaceHolders['DummyNamespace'] .= $name . '\\' . 'Requests';;
        $this->curentTemplateName = 'request';
        $stub = $this->files->get($this->getStub());
        foreach ($PlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }

        $requstsList = [
            "Create" => 'Create' . $modelName . 'Request',
            "Delete" => 'Delete' . $modelName . 'Request',
            "List" => 'List' . $modelName . 'Request',
            "Update" => 'Update' . $modelName . 'Request',
            "View" => 'View' . $modelName . 'Request',

        ];
        foreach ($requstsList as $fun => $requestName) {
            $nStub =$stub;
            $nStub = $this->findAndReplace($nStub, "DummyRequestName", $requestName);
            $filePath = $this->requestsMainPath . $name . DIRECTORY_SEPARATOR . 'Requests' . DIRECTORY_SEPARATOR . $requestName . '.php';

            $this->createFile($filePath, $nStub);
        }


    }


    protected function findAndReplace($stub, $key, $value)
    {
        return str_replace($key, $value, $stub);
    }

    protected function createFile($filePath, $content)
    {


        if (file_exists($filePath)) {
            File::delete([$filePath]);
        }


        File::put($filePath, $content);
    }

    protected function createDir($path)
    {
        if (!file_exists($path)) {
            $this->info('Creating Path '.$path);
            mkdir($path);
        }


    }


}
