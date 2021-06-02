<?php

namespace App\Domain;
interface ProductRepositoryInterface
{
    public function getById(int $id): ?Product;

    public function save(Product $product);

    public function delete(Product $product);

    public function mapToProduct();

    public function getAllFiltered(array $filterRules, array $sortRules);

    public function getAllAvailable();

    public function getSimilarFor(Product $product);

    public function getAllNotDeleted();

    public function getAllDeleted();

}
