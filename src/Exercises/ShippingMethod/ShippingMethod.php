<?php

namespace App\Exercises\ShippingMethod;

interface ShippingMethod
{
    public function calculateShipping(string $zipcode): float;
}
