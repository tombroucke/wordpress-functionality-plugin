<?php
namespace ProjectnameNamespace\Functionality\Core;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Add ACF options pages
 */
class OptionsPage
{

    /**
     * Create pages
     *
     * @return void
     */
    public function addOptionsPage() : void
    {
        
        acf_add_options_page(
            [
                'page_title'    => __('Projectname settings', 'projectname-textdomain'),
                'menu_title'    => __('Projectname settings', 'projectname-textdomain'),
                'menu_slug'     => 'projectname-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false,
            ]
        );

        // acf_add_options_sub_page(
        //  array(
        //      'page_title'    => __( 'Projectname settings', 'projectname-textdomain' ),
        //      'menu_title' => __( 'Projectname settings', 'projectname-textdomain' ),
        //      'parent_slug'   => 'projectname-settings',
        //  )
        // );
    }

    /**
     * Add options fields
     *
     * @return void
     */
    public function addOptionsFields() : void
    {
        $projectnameSettings = new FieldsBuilder('projectname-settings');
        $projectnameSettings
            ->setLocation('options_page', '==', 'projectname-settings');
        acf_add_local_field_group($projectnameSettings->build());
    }
}
