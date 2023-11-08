<?php

namespace FunctionalityPlugin\OptionsPages;

use FunctionalityPluginSocialMedia as SocialMedia;
use FunctionalityPlugin\Abstracts\OptionsPage as AbstractsOptionsPage;
use FunctionalityPlugin\Concerns\HasHooks;
use StoutLogic\AcfBuilder\FieldsBuilder;
use FunctionalityPlugin\Contracts\OptionsPage;

class General extends AbstractsOptionsPage implements OptionsPage
{
    use HasHooks;

    protected string $slug = 'functionality-plugin-settings';

    protected string $title = 'General Settings';

    protected string $menuTitle = 'General Settings';

    public function __construct()
    {
        $this->title = __('General Settings', 'functionality-plugin');
        $this->menuTitle = __('General Settings', 'functionality-plugin');
    }

    protected function fields(FieldsBuilder $fieldsBuilder) : FieldsBuilder
    {
        $fieldsBuilder = $this->addContactInformation($fieldsBuilder);
        $fieldsBuilder = $this->addSocialMedia($fieldsBuilder);
        $fieldsBuilder = $this->addOpeningHours($fieldsBuilder);
        $fieldsBuilder = $this->addNewsletter($fieldsBuilder);
        return $fieldsBuilder;
    }

    private function addSocialMedia(FieldsBuilder $settings): FieldsBuilder
    {
        $settings
            ->addTab('social_media', [
                'label' => __('Social media URL\'s', 'functionality-plugin'),
            ]);

        $channels = SocialMedia::allChannels();

        $channels->each(function ($channel, $key) use ($settings) {
            $settings
                ->addUrl('social_media_' . $key, [
                    'label' => $channel['label'],
                ]);
        });
        return $settings;
    }

    private function addContactInformation(FieldsBuilder $settings) : FieldsBuilder
    {
        $settings
            ->addTab('contact_information', [
                'label' => __('Contact information', 'functionality-plugin'),
            ]);
        
        $fields = collect([
            'company' => __('Company', 'functionality-plugin'),
            'street' => __('Street', 'functionality-plugin'),
            'street_number' => __('Number', 'functionality-plugin'),
            'postcode' => __('Postcode', 'functionality-plugin'),
            'city' => __('City', 'functionality-plugin'),
            'country' => __('Country', 'functionality-plugin'),
            'phone' => __('Phone', 'functionality-plugin'),
            'email' => __('Email', 'functionality-plugin'),
            'vat_number' => __('VAT number', 'functionality-plugin'),
        ]);

        $fields->each(function ($label, $key) use ($settings) {
            $settings
                ->addText('contact_information_' . $key, [
                    'label' => $label,
                ]);
        });
        return $settings;
    }

    private function addOpeningHours(FieldsBuilder $settings) : FieldsBuilder
    {
        $settings
            ->addTab('opening_hours', [
                'label' => __('Opening hours', 'functionality-plugin'),
            ]);
        $days = app()->make('functionality_plugin.locale')->weekDays();
        $days->each(function ($day, $key) use ($settings) {
            $settings
                ->addRepeater('opening_hours_' . $key, [
                    'label' => ucfirst($day),
                ])
                    ->addTimePicker('from', [
                        'label' => __('From', 'functionality-plugin'),
                        'display_format' => 'H:i',
                        'return_format' => 'H:i',
                        'default_value' => '09:00',
                    ])
                    ->addTimePicker('to', [
                        'label' => __('To', 'functionality-plugin'),
                        'display_format' => 'H:i',
                        'return_format' => 'H:i',
                        'default_value' => '17:00',
                    ])
                ->endRepeater();
        });
        return $settings;
    }

    private function addNewsletter(FieldsBuilder $settings) : FieldsBuilder
    {
        $settings
            ->addTab('newsletter', [
                'label' => __('Newsletter', 'functionality-plugin'),
            ]);
        $settings
            ->addTextarea('newsletter_signup_form', [
                'label' => __('Newsletter signup form', 'functionality-plugin'),
                'rows' => 40,
                'instructions' => __('Enter the signup form code. You can use the [newsletter-signup-form] shortcode to display the signup form.', 'functionality-plugin'),
            ]);
        return $settings;
    }
}
