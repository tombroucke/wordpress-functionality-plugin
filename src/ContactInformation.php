<?php

namespace FunctionalityPlugin;

class ContactInformation
{
    public function companyName() : ?string
    {
        return get_field('contact_information_company', 'option');
    }

    public function street() : ?string
    {
        return get_field('contact_information_street', 'option');
    }

    public function streetNumber() : ?string
    {
        return get_field('contact_information_street_number', 'option');
    }

    public function postcode() : ?string
    {
        return get_field('contact_information_postcode', 'option');
    }

    public function city() : ?string
    {
        return get_field('contact_information_city', 'option');
    }

    public function phone() : ?string
    {
        return get_field('contact_information_phone', 'option');
    }

    public function email() : ?string
    {
        return get_field('contact_information_email', 'option');
    }

    public function formattedAddress() {
        return view('FunctionalityPlugin::contact-information.address', [
            'companyName' => $this->companyName(),
            'street' => $this->street(),
            'streetNumber' => $this->streetNumber(),
            'postcode' => $this->postcode(),
            'city' => $this->city(),
        ])->toHtml();
    }

    public function formattedPhoneEmail() {
        return view('FunctionalityPlugin::contact-information.phone-email', [
            'phone' => $this->phone(),
            'email' => $this->email(),
        ])->toHtml();
    }
}
