<?php

namespace App\Exercises\ShippingMethod;

class PacCorreiosService implements CorreiosService
{
    public function calculateShipping(string $zipcode): float
    {
        return rand(5, 250);
    }
}
