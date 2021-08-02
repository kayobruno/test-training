<?php

namespace App\Exercises\ShippingMethod;

class SedexCorreiosService implements CorreiosService
{
    public function calculateShipping(string $zipcode): float
    {
        return rand(10, 500);
    }
}
