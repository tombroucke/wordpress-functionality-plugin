<?php

namespace FunctionalityPlugin\Abstracts;

use FunctionalityPlugin\Concerns\HasHooks;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class Block
{
    use HasHooks;

    public function register(): void
    {
        if (! function_exists('acf_add_local_field_group')) {
            throw new \Exception('ACF is not installed');
        }

        register_block_type(app('functionality_plugin.base_path').'/../resources/blocks/'.$this->slug(), [
            'render_callback' => function ($attributes, $content) {
                $data = $this->data();
                echo view('FunctionalityPlugin::blocks.'.$this->slug(), $data)->render();
            },
        ]);

        $fieldsBuilder = new FieldsBuilder('functionality_plugin_'.$this->slug());
        $fieldsBuilder
            ->setLocation('block', '==', 'acf/'.$this->slug());

        $fields = $this->fields($fieldsBuilder);
        acf_add_local_field_group($fields->build());
    }

    abstract protected function data(): array;

    abstract protected function slug(): string;

    abstract protected function fields(FieldsBuilder $fields): FieldsBuilder;
}
