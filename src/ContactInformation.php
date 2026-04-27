<?php

namespace FunctionalityPlugin;

use Illuminate\Support\Collection;

class ContactInformation
{
    private Collection $fields;

    public function __construct()
    {
        $this->fields = collect([
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
    }

    public function allFields(): Collection
    {
        return $this->fields->mapWithKeys(function ($label, $key) {
            return ['contact_information_'.$key => $label];
        });
    }

    public function branches(): array
    {
        $return = [
            'main' => __('Main branch', 'functionality-plugin'),
        ];

        $branches = get_field('contact_information_branches', 'option');

        if (! $branches) {
            return $return;
        }

        foreach ($branches as $key => $branch) {
            $return['branch_'.$key] = $branch['contact_information_company'] ?? __('Branch', 'functionality-plugin').' '.($key + 1);
        }

        return $return;
    }
}
