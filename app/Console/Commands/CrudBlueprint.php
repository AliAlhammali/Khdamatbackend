<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudBlueprint extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    protected $signature = 'crud:go
                            {name : The name of the Crud.}
                            {--with-api-c=true : Generate api controller.}
                            {--namespace_group=  : the namespace of crud.}
                            {--with-web-c=true : Generate web controller.}
                            {--migration= : With migration.}
                            {--table-name= : DB table name if different from module name.}
                            {--fields= : Field names for the form & migration.}
                            {--fields_from_file= : Fields from a json file.}
                            {--validations= : Validation rules for the fields.}
                            {--pk=id : The name of the primary key.}
                            {--indexes= : The fields to add an index to.}
                            {--foreign-keys= : The foreign keys for the table.}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will create all required basic files and folders for modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        $migrationName = Str::plural(Str::snake($name));
        $tableName = $migrationName;

        $namespace_group = $this->option('namespace_group') ?: null;
        $withMigration = $this->option('migration') ?: null;
        $table = $this->option('table-name') ?: $tableName;
        $fields = rtrim($this->option('fields'), ';');


//        if ($this->confirm('{'.$name.'} module exists do you wish to continue?', true)) {

        $this->call('crud:dirs', ['name' => Str::ucfirst($name), '--namespace_group' => $namespace_group ?: null]);
        $this->info('Dirs created successful!');
        $primaryKey = $this->option('pk');


        $fieldsArray = explode(';', $fields);
        $fillableArray = [];
        $migrationFields = '';

        foreach ($fieldsArray as $item) {
            $spareParts = explode('#', trim($item));
            $fillableArray[] = $spareParts[0];
            $modifier = !empty($spareParts[2]) ? $spareParts[2] : 'nullable';
        }
        $commaSeparetedString = implode("', '", $fillableArray);
        $fillable = "['" . $commaSeparetedString . "']";
        $this->call('crud:api-c', ['name' => Str::ucfirst($name), '--namespace_group' => $namespace_group ?: null]);
        $this->info('API Controller created successful!');
        $this->info('Start Model and related stuff creating');
        $this->call('crud:model', ['name' => $name, '--fillable' => $fillable, '--table-name' => $table, '--pk' => $primaryKey, '--namespace_group' => $namespace_group ?: null]);
        $this->info('Model and related stuff created successful!');
        if ($withMigration){
            $this->call('make:migration', ['name' => 'Create' . Str::ucfirst($name), '--table' => $table]);
            $this->info('Migration Created');
        }

        $this->info('All Done');;
//        }


    }

    protected function processJSONFields($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        $fieldsString = '';
        foreach ($fields->fields as $field) {
            if ($field->type === 'select' || $field->type === 'enum') {
                $fieldsString .= $field->name . '#' . $field->type . '#options=' . json_encode($field->options) . ';';
            } else {
                $fieldsString .= $field->name . '#' . $field->type . ';';
            }
        }

        $fieldsString = rtrim($fieldsString, ';');

        return $fieldsString;
    }


}
