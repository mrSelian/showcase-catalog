<?php

namespace App\Repositories;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Helpers\PaginationHelper;
use App\Models\ProductModel;


class DbProductRepository implements ProductRepositoryInterface
{
    protected const RECORDS_PER_PAGE = 6;
    protected const ADMIN_PAGE_RECORDS_PER_PAGE = 15;

    public function getById(int $id): ?Product
    {
        return ProductModel::withId($id)
            ->get()
            ->map($this->mapToProduct())
            ->first();
    }

    public function save(Product $product)
    {
        $record = ProductModel::withId($product->getId())->firstOrNew();

        $record->title = $product->getTitle();
        $record->description = $product->getDescription();
        $record->price = $product->getPrice();
        $record->old_price = $product->getOldPrice();
        $record->amount = $product->getAmount();
        $record->brand = $product->getBrand();
        $record->photos = collect($product->getPhotos())->toJson();
        $record->liquid = $product->getQualities()['liquid'];
        $record->hard = $product->getQualities()['hard'];
        $record->wet = $product->getQualities()['wet'];
        $record->warm = $product->getQualities()['warm'];
        $record->deleted = $product->isDeleted();
        $record->save();

        return $record->id;
    }

    public function delete(Product $product)
    {
        $record = ProductModel::withId($product->getId())->firstOrFail();

        $record->deleted = $product->isDeleted();
        $record->save();
    }

    public function getAllAvailable()
    {
        $products = ProductModel::query()
            ->where('amount', '>', 0)
            ->where('deleted', '=', false)
            ->get()
            ->map($this->mapToProduct());

        return PaginationHelper::paginate($products, self::RECORDS_PER_PAGE);
    }

    public function getAllFiltered(array $filterRules, array $sortRules)
    {
        $clearFilter = collect($filterRules)
            ->filter(function ($value) {
                return $value != null;
            });

        $products = ProductModel::query()
            ->where('amount', '>', 0)
            ->where('deleted', '=', false)
            ->get();

        if (isset($clearFilter['maxPrice'])) {
            $products = $products->reject(function ($item) use ($clearFilter) {
                if ($item->price > (int)$clearFilter['maxPrice']) {
                    return true;
                }
                return false;
            });
            unset($clearFilter['maxPrice']);
        }

        if (isset($clearFilter['minPrice'])) {
            $products = $products->reject(function ($item) use ($clearFilter) {
                if ($item->price < (int)$clearFilter['minPrice']) {
                    return true;
                }
                return false;
            });
            unset($clearFilter['minPrice']);
        }


        if (!in_array('all', $clearFilter['brand'])) {
            $products = $products->reject(function ($item) use ($clearFilter) {
                if (!in_array($item->brand, $clearFilter['brand'])) {
                    return true;
                }
                return false;
            });

        }

        unset($clearFilter['brand']);

        $products = $products
            ->reject(function ($item) use ($clearFilter) {
                foreach ($clearFilter as $name => $value) {
                    if ($item->$name != $value) {
                        return true;
                    }
                }
                return false;
            });

        $sortedProducts = $this->sort($products, $sortRules)->map($this->mapToProduct());

        return PaginationHelper::paginate($sortedProducts, self::RECORDS_PER_PAGE);
    }

    protected function sort($products, array $sort)
    {
        if ($sort['sortBy'] != null && $sort['desc'] != null) {
            if ($sort['desc'] == 0) $products = $products->sortBy($sort['sortBy']);
            else $products = $products->sortByDesc($sort['sortBy']);
        }

        return $products;
    }

    public function getAllNotDeleted()
    {
        $products = ProductModel::query()
            ->where('deleted', '=', false)
            ->get()
            ->map($this->mapToProduct());

        return PaginationHelper::paginate($products, self::ADMIN_PAGE_RECORDS_PER_PAGE);
    }

    public function getAllDeleted()
    {
        $products = ProductModel::query()
            ->where('deleted', '=', true)
            ->get()
            ->map($this->mapToProduct());

        return PaginationHelper::paginate($products, self::ADMIN_PAGE_RECORDS_PER_PAGE);
    }

    public function mapToProduct(): \Closure
    {
        return fn(ProductModel $record) => Product::from(
            $record->title,
            $record->description,
            $record->price,
            $record->old_price,
            $record->amount,
            $record->brand,
            [
                'liquid' => $record->liquid,
                'hard' => $record->hard,
                'wet' => $record->wet,
                'warm' => $record->warm
            ],
            json_decode($record->photos),
            $record->deleted,
            $record->id
        );
    }

    public function getSimilarFor(Product $product)
    {
        return ProductModel::query()
            ->where('amount', '>', 0)
            ->where('deleted', '=', false)
            ->get()
            ->random(4)
            ->map($this->mapToProduct());
    }
}
