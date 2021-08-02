<?php

use App\Exercises\ShippingMethod\CalculateShippingService;
use App\Exercises\ShippingMethod\Cart;
use App\Exercises\ShippingMethod\Product;
use App\Exercises\ShippingMethod\SedexCorreiosService;
use App\Exercises\ShippingMethod\User;
use PHPUnit\Framework\TestCase;

class FreightCalculationTest extends TestCase
{
    /**
     * @test
     */
    public function checkCartIsEmpty()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $this->assertEquals(0, $cart->getTotals());
    }

    /**
     * @test
     */
    public function checkCartHasProduct()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $product = new Product(1, 'Book A', 25.90);
        $cart->addProduct($product, 2);

        $this->assertGreaterThan(0, $cart->getTotals());
    }

    /**
     * @test
     */
    public function canRemoveProductInCart()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);
        $productB = new Product(2, 'Book B', 15.90);

        $cart->addProduct($productA, 3);
        $cart->addProduct($productB, 1);
        $cart->removeProduct($productA);

        $this->assertCount(1, $cart->getItems());
    }

    /**
     * @test
     */
    public function canRemoveAllItemsInCart()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);
        $productB = new Product(2, 'Book B', 15.90);

        $cart->addProduct($productA, 3);
        $cart->addProduct($productB, 1);
        $cart->clearItems();

        $this->assertCount(0, $cart->getItems());
    }

    /**
     * @test
     */
    public function checkIfCartTotalIsCorrectWhenValueIsLessThanOneHundred()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);

        $cart->addProduct($productA, 1);

        $sedexCorreiosService = new SedexCorreiosService();
        $shippingService = new CalculateShippingService($sedexCorreiosService);
        $total = $cart->getTotals() + $shippingService->getShippingTotal($cart);

        $this->assertGreaterThan($cart->getTotals(), $total);
    }

    /**
     * @test
     */
    public function checkIfCartTotalIsCorrectWhenValueIsGreaterThanOneHundred()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);

        $cart->addProduct($productA, 10);

        $sedexCorreiosService = $this->createMock(SedexCorreiosService::class);
        $shippingService = new CalculateShippingService($sedexCorreiosService);
        $total = $cart->getTotals() + $shippingService->getShippingTotal($cart);

        $this->assertEquals($cart->getTotals(), $total);
    }

    /**
     * @test
     */
    public function checkIfMethodCalculateShippingExecutedOnce()
    {
        $correiosService = $this->createMock(SedexCorreiosService::class);
        $correiosService->expects($spy = $this->any())->method('calculateShipping');
        $correiosService->calculateShipping('62870000');

        $this->assertEquals(1, $spy->getInvocationCount());
    }

    /**
     * @test
     */
    public function checkIfMethodCalculateShippingExecutedTwoTimes()
    {
        $correiosService = $this->createMock(SedexCorreiosService::class);
        $correiosService->expects($spy = $this->any())->method('calculateShipping');
        $correiosService->calculateShipping('62870000');
        $correiosService->calculateShipping('60150170');

        $this->assertEquals(2, $spy->getInvocationCount());
    }

    /**
     * @test
     */
    public function checkIfMethodCalculateShippingResponseIsValid()
    {
        $correiosService = new SedexCorreiosService();
        $value = $correiosService->calculateShipping('62870000');

        $this->assertGreaterThan(0, $value);
    }

    /**
     * @test
     */
    public function shouldNotAddProductsDuplicates()
    {
        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);

        $cart->addProduct($productA, 1);
        $cart->addProduct($productA, 3);

        $this->assertCount(1, $cart->getItems());
    }

    /**
     * @test
     */
    public function checkIfQuantityEqualsToZero()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = $this->createMock(User::class);
        $cart = new Cart($user);
        $productA = new Product(1, 'Book A', 25.90);

        $cart->addProduct($productA, 0);
    }
}
