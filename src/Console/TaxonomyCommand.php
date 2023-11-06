<?php

namespace FunctionalityPlugin\Console;

use Illuminate\Support\Str;
use Roots\Acorn\Console\Commands\GeneratorCommand;

class TaxonomyCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Taxonomy';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'functionality-plugin:taxonomy {name : taxonomy} {post_type : the post type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new taxonomy in your mu-plugin.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return dirname(__FILE__) . '/stubs/taxonomy.stub';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $postTypeSlug = Str::snake($this->argument('post_type'));
        if (get_post_type_object($postTypeSlug) === null) {
            $this->error(sprintf(
                'Post type does not exist. Please add the post type "%s" first: wp acorn functionality_plugin:post-type %s',
                $postTypeSlug,
                $this->argument('post_type')
            ));
            return false;
        }
        parent::handle();
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
        $postType = $this->argument('post_type');
        return Str::of($stub)
            ->replace('{{post_type_class}}', Str::studly($postType))
            ->replace('{{class_name}}', Str::studly($nameInput))
            ->replace('{{post_type}}', Str::snake($postType))
            ->replace('{{taxonomy}}', Str::snake($nameInput))
            ->replace('{{slug}}', Str::of($nameInput)->slug('-'))
            ->replace('{{singular_label}}', Str::of($nameInput)->snake()->replace('_', ' ')->ucFirst())
            ->replace('{{plural_label}}', Str::of($nameInput)->plural()->snake()->replace('_', ' ')->ucFirst())
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
        $postType = Str::studly($this->argument('post_type'));
        $fileName = Str::studly($this->argument('name')) . '.php';
        return app('functionality_plugin.base_path') . '/Taxonomies/' . $postType . '/' . $fileName;
    }
}
