<?php

namespace FunctionalityPlugin\Blocks;

use FunctionalityPlugin\Abstracts\Block;
use FunctionalityPlugin\Facades\ContactInformation as ContactInformationFacade;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactInformation extends Block
{
    protected function slug(): string
    {
        return 'contact-information';
    }

    protected function fields(FieldsBuilder $fieldsBuilder): FieldsBuilder
    {
        $fields = ContactInformationFacade::allFields();
        $branches = ContactInformationFacade::branches();

        $fieldsBuilder
            ->addSelect('branch', [
                'label' => __('Branch', 'functionality-plugin'),
                'choices' => $branches,
                'default_value' => 'main',
            ])
            ->addWysiwyg('template', [
                'label' => __('Template', 'functionality-plugin'),
                'instructions' => __('Use the following variables to display the contact information: '.implode(', ', $fields->keys()->map(fn ($key) => '{{'.str_replace('contact_information_', '', $key).'}}')->toArray()), 'functionality-plugin'),
                'default_value' => '{{company}}<br />{{street}} {{street_number}}<br />{{postcode}} {{city}}<br />{{country}}<br /><br />{{phone}}<br />{{email}}<br /><br />VAT: {{vat_number}}',
            ]);

        return $fieldsBuilder;
    }

    protected function data(): array
    {
        return [
            'contactInformation' => $this->replaceVariables(get_field('template') ?? '', get_field('branch') ?? 'main'),
        ];
    }

    private function replaceVariables(string $template, string $branchKey): string
    {
        $contactInformation = ContactInformationFacade::allFields();

        if ($branchKey === 'main') {
            foreach ($contactInformation as $key => $label) {
                $template = str_replace('{{'.str_replace('contact_information_', '', $key).'}}', get_field($key, 'option') ?? '', $template);
            }
        } else {
            $branch = get_field('contact_information_branches', 'option')[ltrim($branchKey, 'branch_')];
            foreach ($contactInformation as $key => $label) {
                $template = str_replace('{{'.str_replace('contact_information_', '', $key).'}}', $branch[$key] ?? '', $template);
            }
        }

        return $template;
    }
}
