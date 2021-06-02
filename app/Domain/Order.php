<?php

namespace App\Domain;

class Order
{
    protected string $customerName;
    protected string $customerPhone;
    protected int $productId;
    protected ?int $id;

    protected function __construct(string $customerName, string $customerPhone, int $productId)
    {
        $this->productId = $productId;
        $this->customerName = $customerName;
        $this->customerPhone = $customerPhone;
        $this->id = null;
    }

    public static function create(string $customerName, string $customerPhone, int $productId): self
    {
        return new self($customerName, $customerPhone, $productId);
    }

    public static function from(string $customerName, string $customerPhone, int $productId, ?int $id): self
    {
        $self = new self($customerName, $customerPhone, $productId);
        $self->id = $id;
        return $self;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

}
