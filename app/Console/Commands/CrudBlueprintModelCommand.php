<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CrudBlueprintModelCommand extends GeneratorCommand
{
    private $curentTemplateName = 'models';
    private $configs = [];
    private $mainPath = '';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $this->configs = config('crudgenerator');
        $this->mainPath
            = $rootPathOfModule = app_path() . DIRECTORY_SEPARATOR
            . $this->configs['dirs']['main-container-dir-name']
            . DIRECTORY_SEPARATOR;
    }

    protected function getStub(): string
    {
        $templatesArray = config('crudgenerator.template-names');
        $path = empty(config('crudgenerator.custom_template'))
            ? config('crudgenerator.default_template_path')
            : config(
                'crudgenerator.custom_template'
            );

        return $path . DIRECTORY_SEPARATOR
            . $templatesArray[$this->curentTemplateName];
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'crud:model
                            {name : The name of the model.}
                            {--table-name= : DB table name if different from module name.}
                            {--namespace_group=  : the namespace of crud.}
                            {--fillable= : The names of the fillable columns.}
                            {--relationships= : The relationships for the model}
                            {--pk=id : The name of the primary key.}
                            {--soft-deletes=no : Include soft deletes fields.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $primaryKey = $this->option('pk');
        $relationships = trim($this->option('relationships')) != '' ? explode(
            ';',
            trim($this->option('relationships'))
        ) : [];
        $softDeletes = $this->option('soft-deletes');

        if (!empty($primaryKey)) {
            $primaryKey = $this->generatePKCode($primaryKey);
        }
        $namespace_group = $this->option('namespace_group');
        if ($namespace_group) {
            $this->mainPath .= $namespace_group . DIRECTORY_SEPARATOR;
        }
        $this->generateModel($namespace_group);
        $this->generateDtoAndDtoMapper($namespace_group);
        $this->generateRepository($namespace_group);
        $this->generateService($namespace_group);
    }


    protected function generateModel($namespace_group = null)
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        $containerDirName = 'App\\' . $this->configs['dirs']['main-container-dir-name'];
        if ($namespace_group) {
            $containerDirName .= '\\' . $namespace_group;
        }
        $modelNamespace = $containerDirName . '\\' . $name . '\\' . 'Models';
        $table = $this->option('table-name') ?: $this->argument('name');
        $primaryKey = $this->option('pk');
        if (!empty($primaryKey)) {
            $primaryKey = $this->generatePKCode($primaryKey);
        }

        $fieldList = $this->parseFieldsFile(Str::snake($name));
        $fillable = "";
        if (!empty($fieldList)) {
            $fillable = $this->generateFillable($fieldList);
        }

//

        $placeHolders = [
            'DummyNamespace' => $modelNamespace,
            'DummyClass' => $modelName,
            '{{table}}' => $table,
            '{{fillable}}' => ($fillable) ? $fillable : '',
            '{{primaryKey}}' => $primaryKey,
        ];

        $stub = $this->files->get($this->getStub());

        foreach ($placeHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $mainPath = $this->mainPath;


        $modelPath = $mainPath . $name . DIRECTORY_SEPARATOR . 'Models'
            . DIRECTORY_SEPARATOR . $modelName . '.php';
        $this->createFile($modelPath, $stub);
//        dd($modelPath);

    }

    protected function generateDtoAndDtoMapper($namespace_group = null)
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        $fieldList = $this->parseFieldsFile(Str::snake($name));
        $settersAndGetters = $serializedData = $constructData = $all_setters_data = "";
        if (!empty($fieldList)) {
            $settersAndGetters = $this->generateSettersAndGetters($fieldList);
            $constructData = $this->generateConstructData($fieldList);
            $serializedData = $this->generateSerializedData($fieldList);
            $all_setters_data = $this->generateSettersData($fieldList);
        }
        $containerDirName = 'App\\' . $this->configs['dirs']['main-container-dir-name'];
        if ($namespace_group) {
            $containerDirName .= '\\' . $namespace_group;
        }
        $mainNamespace = $containerDirName . '\\' . $name . '\\';
        $dtoPlaceHolders = [
            'DummyNamespace' => $mainNamespace . 'DTOs',
            'ClassName' => $modelName,
            "ModelName" => $modelName,
            'ClassNamePlural' => $name,
            'class_name_plural_name_space' => $namespace_group?$namespace_group.'\\'.$name:$name,
            'ClassNamePluralAsVar' => Str::lcfirst($name),
            'ConstructData' => $constructData,
            'SerializedData' => $serializedData,
            'all_setters_data' => $all_setters_data,
            'SettersAndGetters' => $settersAndGetters,

        ];
        $this->curentTemplateName = 'dto';
        $stub = $this->files->get($this->getStub());
        foreach ($dtoPlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $mainPath = $this->mainPath;


        $Path = $mainPath . $name . DIRECTORY_SEPARATOR . 'DTOs'
            . DIRECTORY_SEPARATOR . $modelName . 'DTO' . '.php';
        $this->createFile($Path, $stub);

        $this->curentTemplateName = 'list-dto';
        $stub = $this->files->get($this->getStub());
        foreach ($dtoPlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $Path = $mainPath . $name . DIRECTORY_SEPARATOR . 'DTOs'
            . DIRECTORY_SEPARATOR . $modelName . 'ListDTO' . '.php';
        $this->createFile($Path, $stub);

// DTO Mapper
        $dtoPlaceHolders = [
            'DummyNamespace' => $mainNamespace . 'Mappers',
            'ModelName' => $modelName,
            'ClassNamePlural' => $name,
            'all_setters_data' => $all_setters_data,
            'class_name_plural_name_space' => $namespace_group?$namespace_group.'\\'.$name:$name,
            'ClassNamePluralAsVar' => Str::lcfirst($name),
        ];
        $this->curentTemplateName = 'dto-mapper';
        $stub = $this->files->get($this->getStub());
        foreach ($dtoPlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $Path = $mainPath . $name . DIRECTORY_SEPARATOR . 'Mappers'
            . DIRECTORY_SEPARATOR . $modelName . 'DTOMapper' . '.php';

        $this->createFile($Path, $stub);
    }

    protected function generateRepository($namespace_group)
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        $mainNamespace = 'App\\' .$this->configs['dirs']['main-container-dir-name'] . '\\'
            . $name . '\\';
        $containerDirName = 'App\\' . $this->configs['dirs']['main-container-dir-name'];
        if ($namespace_group) {
            $containerDirName .= '\\' . $namespace_group;
        }
        $mainNamespace = $containerDirName . '\\' . $name . '\\';

        $dtoPlaceHolders = [
            'DummyNamespace' => $mainNamespace . 'Repositories',
            'ModelName' => $modelName,
            'ClassNamePlural' => $name,
            'class_name_plural_name_space' => $namespace_group?$namespace_group.'\\'.$name:$name,
            'ClassNamePluralAsVar' => Str::lcfirst($name),
        ];
        $this->curentTemplateName = 'repositories';
        $stub = $this->files->get($this->getStub());
        foreach ($dtoPlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $Path = $this->mainPath . $name . DIRECTORY_SEPARATOR . 'Repositories'
            . DIRECTORY_SEPARATOR . $name . 'Repository' . '.php';
        $this->createFile($Path, $stub);
    }

    protected function generateService($namespace_group = null)
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        $mainNamespace = 'App\\' .$this->configs['dirs']['main-container-dir-name'] . '\\'
            . $name . '\\';

        $containerDirName = 'App\\' . $this->configs['dirs']['main-container-dir-name'];
        if ($namespace_group) {
            $containerDirName .= '\\' . $namespace_group;
        }
        $mainNamespace = $containerDirName . '\\' . $name . '\\';

        $dtoPlaceHolders = [
            'DummyNamespace' => $mainNamespace . 'Services',
            'ModelName' => $modelName,
            'ClassNamePlural' => $name,
            'class_name_plural_name_space' => $namespace_group?$namespace_group.'\\'.$name:$name,
            'varName' => Str::lcfirst($name),
        ];
        $this->curentTemplateName = 'services';
        $stub = $this->files->get($this->getStub());
        foreach ($dtoPlaceHolders as $key => $vale) {
            $stub = $this->findAndReplace($stub, $key, $vale);
        }
        $mainPath = $this->mainPath;
        $Path = $mainPath . $name . DIRECTORY_SEPARATOR . 'Services'
            . DIRECTORY_SEPARATOR . $name . 'Service' . '.php';
        $this->createFile($Path, $stub);
    }


    protected
    function createFile(
        $modelPath,
        $content,
        $force = true
    )
    {
        if (file_exists($modelPath)) {
            File::delete([$modelPath]);
        }

        File::put($modelPath, $content);
    }

    protected
    function generatePKCode(
        $primaryKey
    ): string
    {
        return <<<EOD
/**
    * The database primary key value.
    *
    * @var string
    */
    protected \$primaryKey = '$primaryKey';
EOD;
    }

    /**
     * remove the relationships placeholder when it's no longer needed
     *
     * @param $stub
     *
     */
    protected
    function findAndReplace(
        $stub,
        $key,
        $value
    )
    {
        return str_replace($key, $value, $stub);
    }

    protected function parseFieldsFile($fileName): array
    {
        $filePath = $this->configs['fields_files_path'] . $fileName . '.json';
        $fields = [];
        if (file_exists($filePath)) {
            $fields = json_decode(file_get_contents($filePath), true);
        }

        return $fields;
    }

    protected function generateSettersAndGetters($fields): string
    {
        $content = "";
        foreach ($fields as $k => $fieldData) {
            if (!$fieldData['setterAndGetter']) {
                continue;
            }
            $camelFieldGet = Str::camel('get_' . $k);
            $camelFieldSet = Str::camel('set_' . $k);
            $type = $fieldData['type'];
            $nullable = ($fieldData['nullable']) ? "?" : '';
            $temp = <<<EOD
/**
     * @return {$type}|null
     */
    public function {$camelFieldGet}(): {$nullable}{$type}
    {
        return \$this->{$k};
    }

/**
     * @param {$type}|null \${$k}
     */
    public function {$camelFieldSet}({$nullable}{$type} \${$k}): void
    {
        \$this->{$k} = \${$k};
    }
EOD;
            $content .= $temp;
        }

        return preg_replace('/{nbr}[\r\n]+/', '', $content);
    }

    protected function generateConstructData($fieldList)
    {
        $content = "";
        foreach ($fieldList as $k => $fieldData) {
            $type = $fieldData['type'];
            $nullable = ($fieldData['nullable']) ? "?" : '';
            $equalNull = ($fieldData['nullable']) ? "= null" : '';
            $temp = <<<EOD
            private {$nullable}{$type} \${$k}{$equalNull};

EOD;
            $content .= $temp;
        }
        return $content;
    }

    protected function generateSerializedData($fieldList)
    {
        $content = "";
        foreach ($fieldList as $k => $fieldData) {
            $camelFieldGet = Str::camel('get_' . $k);
            $temp = <<<EOD
            '{$k}'=>\$this->{$camelFieldGet}(),

EOD;
            $content .= $temp;

        }

        return $content;
    }
    protected function generateSettersData($fieldList)
    {
        $content = "";
        foreach ($fieldList as $k => $fieldData) {
            $camelFieldGet = Str::camel('set_' . $k);
            $temp = <<<EOD
            \$dto->{$camelFieldGet}(\$data->$k);

EOD;
            $content .= $temp;

        }

        return $content;
    }

    protected function generateFillable($fieldList)
    {
        $fillableArray = [];
        foreach ($fieldList as $k => $fieldData) {
            if ($fieldData['fillable']) {
                $fillableArray[] = $k;
            }
        }

        $fillableArray = "'" . implode(',', $fillableArray) . "'";

        return str_replace(',', "','", $fillableArray);
    }
}
