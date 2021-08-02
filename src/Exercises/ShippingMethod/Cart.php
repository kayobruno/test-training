<?php

namespace App\Exercises\ShippingMethod;

use InvalidArgumentException;

class Cart
{
    private array $items;
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->items = [];
    }

    public function addProduct(Product $product, int $qty): void
    {
        if ($qty <= 0) {
            throw new InvalidArgumentException('the quantity cannot be less than or equal zero');
        }

        $items = $this->getItems();
        foreach ($items as $key => $item) {
            /** @var Product $productItem */
            $productItem = $item['product'];
            if ($productItem->getId() === $product->getId()) {
                $this->items[$key]['qty'] = $qty;
                return;
            }
        }

        $this->items[] = [
            'product' => $product,
            'qty' => $qty,
        ];
    }

    public function removeProduct(Product $product, int $qty = null): void
    {
        foreach ($this->getItems() as $key => $item) {
            /** @var Product $productItem */
            $productItem = $item['product'];

            if ($product->getId() != $productItem->getId()) {
                continue;
            }

            if (is_null($qty) || $qty >= $item['qty']) {
                unset($this->items[$key]);
                break;
            }

            $newItem = [
                'product' => $product,
                'qty' => ($item['qty'] - $qty),
            ];

            $this->items[$key] = $newItem;
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotals(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            /** @var Product $product */
            $product = $item['product'];
            $total += ($product->getPrice() * $item['qty']);
        }

        return $total;
    }

    public function clearItems(): void
    {
        $this->items = [];
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
