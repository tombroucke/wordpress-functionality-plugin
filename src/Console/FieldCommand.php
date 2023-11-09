<?php

namespace FunctionalityPlugin\Console;

use Illuminate\Support\Str;
use Roots\Acorn\Console\Commands\GeneratorCommand;

class FieldCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Field';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'functionality-plugin:field {name : The field name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new ACF field in your mu-plugin.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return dirname(__FILE__) . '/stubs/field.stub';
    }
    
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $nameInput = $this->getNameInput();
        return Str::of($stub)
            ->replace('{{class_name}}', Str::studly($nameInput))
            ->replace('{{slug}}', Str::of($nameInput)->slug('-'))
            ->replace('{{name}}', Str::of($nameInput)->snake()->replace('_', ' ')->ucFirst())
            ->__toString();
    }
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $fileName = Str::studly($this->argument('name')) . '.php';
        return app('functionality_plugin.base_path') . '/Fields/' . $fileName;
    }
}
