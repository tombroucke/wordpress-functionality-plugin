<?php

namespace FunctionalityPlugin\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Roots\Acorn\Console\Commands\GeneratorCommand;

class ShortcodeCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Shortcode';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'functionality-plugin:shortcode {name : The shortcode name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new shortcode in your mu-plugin.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return dirname(__FILE__) . '/stubs/shortcode.stub';
    }

    protected function getViewStub()
    {
        return dirname(__FILE__) . '/stubs/views/shortcode.stub';
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
            ->replace('{{shortcode}}', $this->getShortcodeName())
            ->__toString();
    }

    public function handle()
    {
        $this->info(sprintf('Generating shortcode [%s]', $this->getShortcodeName()));
        $viewPath = view()->getFinder()->getHints()['FunctionalityPlugin'][0] . '/shortcodes';
        $destination = $viewPath . $this->getShortcodeName() . '.blade.php';
        $this->files->put($destination, $this->files->get($this->getViewStub()));
        parent::handle();
    }

    /**
     * Get the shortcode name
     *
     * @return void
     */
    private function getShortcodeName() {
        return Str::of($this->getNameInput())->snake()->replace('_', '-');
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
        return app('functionality_plugin.base_path') . '/Shortcodes/' . $fileName;
    }
}
