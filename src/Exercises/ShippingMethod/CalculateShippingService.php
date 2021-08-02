<?php

namespace App\Exercises\ShippingMethod;

class CalculateShippingService {

    const MIN_VALUE_TO_FREE_SHIPPING = 100;

    public ShippingMethod $shippingMethod;

    public function __construct(ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function getShippingTotal(Cart $cart): float
    {
        $shippingValue = 0;
        if ($cart->getTotals() > self::MIN_VALUE_TO_FREE_SHIPPING) {
            return $shippingValue;
        }

        $user = $cart->getUser();

        return $this->shippingMethod->calculateShipping($user->getZipcode());
    }
}
