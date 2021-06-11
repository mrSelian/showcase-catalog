<?php

namespace App\Http\Controllers;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('admin.product.create');
    }

    public function store(CreateProductRequest $request): RedirectResponse
    {
        $this->authorize('store', Product::class);

        $product = Product::create(
            $request->title,
            $request->description ?? '',
            $request->price,
            (int)$request->oldPrice,
            $request->amount,
            $request->brand,
            [
                'liquid' => (bool)$request->liquid,
                'hard' => (bool)$request->hard,
                'wet' => (bool)$request->wet,
                'warm' => (bool)$request->warm
            ],
            [
                $this->savePhoto($request->photo1),
                $this->savePhoto($request->photo2),
                $this->savePhoto($request->photo3),
                $this->savePhoto($request->photo4),
                $this->savePhoto($request->photo5)
            ]
        );
        $this->productRepository->save($product);

        $id = $this->productRepository->save($product);

        return redirect()->route('admin_products')->with('success', 'Товар успешно добавлен!')->with('productId', $id);;
    }

    protected function savePhoto($photo): ?string
    {
        if ($photo == null) return null;

        $path = Storage::disk('public')->put('uploads', $photo);

        return Storage::url($path);
    }

    public function edit($id)
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('edit', Product::class);

        return view('admin.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id): RedirectResponse
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('update', Product::class);

        $photos = [
            $request->photo1,
            $request->photo2,
            $request->photo3,
            $request->photo4,
            $request->photo5
        ];

        foreach ($photos as $key => $photo) {
            if ($photo == null) {
                $photos[$key] = $product->getPhotos()[$key];
                continue;
            }
            $photos[$key] = $this->savePhoto($photo);
        }

        $product->update(
            $request->title,
            $request->description ?? '',
            $request->price,
            (int)$request->oldPrice,
            $request->amount,
            $request->brand,
            [
                'liquid' => (bool)$request->liquid,
                'hard' => (bool)$request->hard,
                'wet' => (bool)$request->wet,
                'warm' => (bool)$request->warm
            ],
            $photos
        );

        $this->productRepository->save($product);

        return redirect()->route('admin_products')->with('success', 'Товар успешно изменен.');
    }

    public function destroy($id): RedirectResponse
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('destroy', Product::class);

        $product->delete();

        $this->productRepository->delete($product);

        return redirect()->route('admin_products')->with('success', 'Товар удалён.');;
    }

    public function restore($id): RedirectResponse
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('restore', Product::class);

        $product->restore();

        $this->productRepository->save($product);

        return redirect()->route('admin_products')->with('success', 'Товар восстановлен.');;
    }
}
