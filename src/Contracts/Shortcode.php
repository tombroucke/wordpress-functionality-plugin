<?php

namespace FunctionalityPlugin\Contracts;

interface Shortcode
{
    public function callback(array|string $atts = []) : string;
}
