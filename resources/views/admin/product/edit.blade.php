<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            Редактирование товара
        @endsection
    </x-slot>

    <div class="container">
        @php
            $noPhoto = '/no-foto.jpg';
        @endphp
        <form enctype="multipart/form-data" action="{{route('update_product', $product->getId())}}" method="POST"
              class="mt-4">
            @method('PATCH')
            @csrf
            @include('layouts.flash')
            <label for="product" class="control-label"><h1>Редактирование товара</h1></label>

            <div class="d-flex flex-column">
                <label for="title" class="font-bold mt-4 mb-2">Название*</label>
                <input name="title" id="title" value="{{$product->getTitle()}}"
                       type="text" placeholder="Название товара">
            </div>

            <div class="d-flex flex-column">
                <label for="photo1" class="font-bold mt-4 mb-2">Основное фото</label>
                <img src="{{$product->getMainPhoto()}}" width="180px" height="180px">
                <input name="photo1" id="photo1" class="mt-2 mb-2" type="file">
            </div>

            <div class="d-flex flex-column">
                <text class="font-bold mt-4 mb-2">Дополнительные фото</text>
                <img src="{{$product->getPhotos()[1] ?? $noPhoto}}" width="180px" height="180px">
                <input name="photo2" id="photo2" class="mt-2 mb-2" type="file">
                <img src="{{$product->getPhotos()[2] ?? $noPhoto}}" width="180px" height="180px">
                <input name="photo3" id="photo3" class="mt-2 mb-2" type="file">
                <img src="{{$product->getPhotos()[3] ?? $noPhoto}}" width="180px" height="180px">
                <input name="photo4" id="photo4" class="mt-2 mb-2" type="file">
                <img src="{{$product->getPhotos()[4] ?? $noPhoto}}" width="180px" height="180px">
                <input name="photo5" id="photo5" class="mt-2 mb-2" type="file">
            </div>


            <div class="d-flex flex-column">
                <label for="price" class="font-bold mt-4 mb-2">Цена*, &#8381;</label>
                <input name="price" id="price" value="{{$product->getPrice()}}"
                       type="text" placeholder="Цена товара">
            </div>

            <div class="d-flex flex-column">
                <label for="oldPrice" class="font-bold mt-4 mb-2">Цена без скидки, &#8381;</label>
                <input name="oldPrice" id="oldPrice" value="{{$product->getOldPrice()}}"
                       type="text" placeholder="Цена товара без скидки">
            </div>

            <div class="d-flex flex-column">
                <label for="amount" class="font-bold mt-4 mb-2">Количество*, шт;</label>
                <input name="amount" id="amount" value="{{$product->getAmount()}}"
                       type="text" placeholder="Количество товара">
            </div>

            <div class="d-flex flex-column">
                <label for="brand" class="font-bold mt-4 mb-1">Бренд*</label>
                <div class="d-flex justify-between">
                    <div class="d-flex flex-column justify-center">
                        <label for="brand" class="font-bold mt-4 mb-2">Microsoft</label>
                        <input type="radio" name="brand" id="brand"
                               @if($product->getBrand()=='microsoft') checked @endif value="{{'microsoft'}} ">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Samsung</label>
                        <input type="radio" name="brand" id="brand"
                               @if($product->getBrand()=='samsung') checked @endif value="{{'samsung'}}">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Apple</label>
                        <input type="radio" name="brand" id="brand"
                               @if($product->getBrand()=='apple') checked @endif value="{{'apple'}}">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Xiaomi</label>
                        <input type="radio" name="brand" id="brand"
                               @if($product->getBrand()=='xiaomi') checked @endif value="{{'xiaomi'}}">
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label for="description" class="font-bold mt-4 mb-2">Описание</label>
                <textarea name="description" id="description"
                          placeholder="Опишите ваш товар">{{$product->getDescription()}}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column justify-content-center">
                    <label for="liquid" class="font-bold mt-4 mb-2">Жидкий</label>
                    <input type="checkbox" name="liquid" id="liquid"
                           @if($product->getQuality('liquid')) checked @endif value="{{true}} ">
                </div>

                <div class="d-flex flex-column">
                    <label for="hard" class="font-bold mt-4 mb-2">Жёсткий </label>
                    <input type="checkbox" name="hard" id="hard"
                           @if($product->getQuality('hard')) checked @endif value="{{true}}">
                </div>

                <div class="d-flex flex-column">
                    <label for="wet" class="font-bold mt-4 mb-2">Влажный</label>
                    <input type="checkbox" name="wet" id="wet"
                           @if($product->getQuality('wet')) checked @endif value="{{true}}">
                </div>

                <div class="d-flex flex-column">
                    <label for="warm" class="font-bold mt-4 mb-2">Тёплый</label>
                    <input type="checkbox" name="warm" id="warm"
                           @if($product->getQuality('warm')) checked @endif value="{{true}}">
                </div>
            </div>

            <div class="submit mb-2">
                <button type="submit" class="btn btn-primary form-control mt-4 font-semibold">
                    Изменить
                </button>
            </div>

            <text><b>*</b> - обязательно для заполнения</text>
        </form>
    </div>
</x-app-layout>

