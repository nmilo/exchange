<?php

namespace App\Interfaces;

/**
 * The Builder interface declares a set of methods to assemble an order object.
 *
 * All of the construction steps are returning the current builder object to
 * allow chaining: $builder->buildOrderBase(...)->applyDiscount(...)
 */
interface OrderBuilderInterface {

    /**
     * @param $orderDTO
     *
     * @return OrderBuilderInterface
     */
    public function buildOrderBase($orderDTO): OrderBuilderInterface;

    /**
     * @return OrderBuilderInterface
     */
    public function applySurcharge(): OrderBuilderInterface;

    /**
     * @return OrderBuilderInterface
     */
    public function applyAnotherTypeOfCommission(): OrderBuilderInterface;

    /**
     * @return OrderBuilderInterface
     */
    public function applyAnotherTypeOfDiscount(): OrderBuilderInterface;
}