<?php

namespace App\Exercises\ShippingMethod;

class User
{
    private int $id;
    private string $name;
    private string $zipcode;

    public function __construct(int $id, string $name, string $zipcode)
    {
        $this->id = $id;
        $this->name = $name;
        $this->zipcode = $zipcode;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }
}
