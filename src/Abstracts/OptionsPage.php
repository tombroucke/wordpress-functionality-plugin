<?php

namespace FunctionalityPlugin\Abstracts;

use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class OptionsPage
{
    protected string $slug = 'options-page';

    protected string $title = 'Options';

    protected string $menuTitle = 'Options';

    protected string $capability = 'edit_posts';

    public function register() : void
    {
        if (!function_exists('acf_add_options_page')) {
            throw new \Exception('ACF is not installed');
        }

        $this->addOptionsPage();
        $this->addFields();
    }

    private function addOptionsPage()
    {
        acf_add_options_page([
            'page_title' => $this->title,
            'menu_title' => $this->menuTitle,
            'menu_slug' => $this->slug,
            'capability' => $this->capability,
            'redirect' => false,
        ]);
    }
    
    public function addFields()
    {
        $fieldsbuilder = new FieldsBuilder($this->slug, [
            'title' => $this->title,
        ]);

        $fieldsbuilder = $this->fields($fieldsbuilder);
        $fieldsbuilder->setLocation('options_page', '==', $this->slug);
        acf_add_local_field_group($fieldsbuilder->build());
    }

    abstract protected function fields(FieldsBuilder $fieldsBuilder) : FieldsBuilder;
}
