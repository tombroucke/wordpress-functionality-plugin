<?php

namespace FunctionalityPlugin;

class ContactInformation
{
    public function company() : ?string
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

    public function vatNumber() : ?string
    {
        return get_field('contact_information_vat_number', 'option');
    }

    public function bankAccountNumber() : ?string
    {
        return get_field('contact_information_bank_account_number', 'option');
    }

    public function formattedAddress() {
        return view('FunctionalityPlugin::contact-information.address', [
            'company' => $this->company(),
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

    public function formattedPhone() {
        return view('FunctionalityPlugin::contact-information.phone', [
            'phone' => $this->phone(),
        ])->toHtml();
    }

    public function formattedEmail() {
        return view('FunctionalityPlugin::contact-information.email', [
            'email' => $this->email(),
        ])->toHtml();
    }
}
