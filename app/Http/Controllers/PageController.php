<?php

namespace App\Http\Controllers;

use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function showCatalog(Request $request)
    {
        $sort = [
            'sortBy' => $request->sortBy,
            'desc' => $request->desc
        ];

        if ($request->sort != null && (!empty(json_decode($request->sort, true)))) {
            $sort = json_decode($request->sort, true);
        }

        $brands = array_filter([$request->brand1, $request->brand2, $request->brand3, $request->brand4],
            function ($value) {
                return $value != null;
            });

        if ($brands == []) $brands = ['all'];

        $filter = [
            'brand' => $brands,
            'liquid' => $request->liquid,
            'hard' => $request->hard,
            'wet' => $request->wet,
            'warm' => $request->warm,
            'minPrice' => abs((int)$request->minPrice),
            'maxPrice' => abs((int)$request->maxPrice)
        ];

        if ($request->filter != null && (!empty(json_decode($request->filter, true)))) {
            $filter = json_decode($request->filter, true);
        }

        $products = $this->productRepository->getAllFiltered($filter, $sort);

        return view('catalog.show', compact('products', 'filter', 'sort'));
    }

    public function showProductPage($id)
    {
        $product = $this->productRepository->getById($id);

        $similarProducts = $this->productRepository->getSimilarFor($product);

        return view('catalog.product.show', compact('product', 'similarProducts'));
    }

    public function showAdminProducts()
    {
        $products = $this->productRepository->getAllNotDeleted();

        return view('admin.products', compact('products'));
    }

    public function showAdminDeletedProducts()
    {
        $products = $this->productRepository->getAllDeleted();

        return view('admin.products', compact('products'));
    }

    public function showAdminOrders()
    {
        $orders = $this->orderRepository->getAllAvailable();

        return view('admin.orders', compact('orders'));
    }


}
