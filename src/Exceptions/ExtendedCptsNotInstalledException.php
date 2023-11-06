<?php

namespace FunctionalityPlugin\Exceptions;

use Exception;

class ExtendedCptsNotInstalledException extends Exception
{
    public function __construct()
    {
        parent::__construct('The Extended CPTs library is not installed. Please require johnbillion/extended-cpts.');
    }
}
