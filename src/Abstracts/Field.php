<?php

namespace FunctionalityPlugin\Abstracts;

use FunctionalityPlugin\Concerns\HasHooks;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class Field
{
    use HasHooks;

    public function register() : void
    {
        if (!function_exists('acf_add_local_field_group')) {
            throw new \Exception('ACF is not installed');
        }

        $fieldsbuilder = $this->fields();
        acf_add_local_field_group($fieldsbuilder->build());
    }

    abstract protected function fields() : FieldsBuilder;
}
