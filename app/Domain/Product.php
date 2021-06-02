<?php

namespace App\Domain;

class Product
{
    protected bool $deleted;
    protected ?int $id;
    protected string $title;
    protected string $description;
    protected float $price;
    protected ?float $oldPrice;
    protected int $amount;
    protected string $brand;
    protected array $qualities;
    protected array $photos;

    protected function __construct(
        string $title,
        string $description,
        float $price,
        ?float $oldPrice,
        int $amount,
        string $brand,
        array $qualities,
        array $photos,
        bool $deleted = false)
    {
        $this->id = null;
        $this->title = $title;
        $this->description = $description;
        $this->oldPrice = $oldPrice;
        $this->price = $price;
        $this->amount = $amount;
        $this->brand = $brand;
        $this->qualities = $qualities;
        $this->photos = $photos;
        $this->deleted = $deleted;
    }

    public static function create(
        string $title,
        string $description,
        float $price,
        ?float $oldPrice,
        int $amount,
        string $brand,
        array $qualities,
        array $photos
    ): self
    {
        return new self($title, $description, $price, $oldPrice, $amount, $brand, $qualities, $photos);
    }

    public static function from(
        string $title,
        string $description,
        float $price,
        ?float $oldPrice,
        int $amount,
        string $brand,
        array $qualities,
        array $photos,
        bool $deleted,
        ?int $id
    ): self
    {
        $self = new self($title, $description, $price, $oldPrice, $amount, $brand, $qualities, $photos, $deleted);
        $self->id = $id;
        return $self;
    }

    public function update(
        string $title,
        string $description,
        float $price,
        ?float $oldPrice,
        int $amount,
        string $brand,
        array $qualities,
        array $photos
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->oldPrice = $oldPrice;
        $this->amount = $amount;
        $this->brand = $brand;
        $this->qualities = $qualities;
        $this->photos = $photos;
    }

    public function delete()
    {
        if (!$this->isDeleted()) $this->deleted = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getQualities(): array
    {
        return $this->qualities;
    }

    public function getQuality(string $quality): bool
    {
        return $this->qualities[$quality] ?? false;
    }

    public function getMainPhoto()
    {
        return $this->photos[0];
    }

    public function getAdditionalPhotos(): array
    {
        return [$this->photos[1], $this->photos[2], $this->photos[3], $this->photos[4]];
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function restore()
    {
        if ($this->isDeleted()) $this->deleted = false;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

}
