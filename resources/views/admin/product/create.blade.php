<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            Создание товара
        @endsection
    </x-slot>
    <div class="container">
        <form action="{{route('store_product')}}" method="POST" class="mt-4" enctype="multipart/form-data">
            @include('layouts.flash')
            <label for="product" class="control-label"><h1>Добавить товар</h1></label>
            @csrf
            <div class="d-flex flex-column">
                <label for="title" class="font-bold mt-4 mb-2">Название*</label>
                <input name="title" id="title" value="{{old('title')}}"
                       type="text" placeholder="Название товара">
            </div>

            <div class="d-flex flex-column">
                <label for="photo1" class="font-bold mt-4 mb-2">Основное фото*</label>
                <input name="photo1" id="photo1" value="{{old('photo1')}}"
                       type="file">
            </div>

            <div class="d-flex flex-column">
                <text class="font-bold mt-4 mb-2">Дополнительные фото</text>
                <input name="photo2" id="photo2" value="{{old('photo2')}}" class="mb-2" type="file">
                <input name="photo3" id="photo3" value="{{old('photo3')}}" class="mb-2" type="file">
                <input name="photo4" id="photo4" value="{{old('photo4')}}" class="mb-2" type="file">
                <input name="photo5" id="photo5" value="{{old('photo5')}}" class="mb-2" type="file">
            </div>

            <div class="d-flex flex-column">
                <label for="price" class="font-bold mt-4 mb-2">Цена*, &#8381; </label>
                <input name="price" id="price" value="{{old('price')}}"
                       type="text" placeholder="Цена товара">
            </div>

            <div class="d-flex flex-column">
                <label for="oldPrice" class="font-bold mt-4 mb-2">Цена без скидки, &#8381;</label>
                <input name="oldPrice" id="oldPrice" value="{{old('oldPrice')}}"
                       type="text" placeholder="Цена товара без скидки">
            </div>

            <div class="d-flex flex-column">
                <label for="amount" class="font-bold mt-4 mb-2">Количество*, шт;</label>
                <input name="amount" id="amount" value="{{old('amount')}}"
                       type="text" placeholder="Количество товара">
            </div>

            <div class="d-flex flex-column">
                <label for="brand" class="font-bold mt-4 mb-1">Бренд*</label>
                <div class="d-flex justify-content-between">
                    <div class="flex flex-col justify-center">
                        <label for="brand" class="font-bold mt-4 mb-2">Microsoft</label>
                        <input type="radio" name="brand" id="brand" value="{{'microsoft'}} ">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Samsung</label>
                        <input type="radio" name="brand" id="brand" value="{{'samsung'}}">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Apple</label>
                        <input type="radio" name="brand" id="brand" value="{{'apple'}}">
                    </div>

                    <div class="d-flex flex-column">
                        <label for="brand" class="font-bold mt-4 mb-2">Xiaomi</label>
                        <input type="radio" name="brand" id="brand" value="{{'xiaomi'}}">
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label for="description" class="font-bold mt-4 mb-2">Описание</label>
                <textarea name="description" id="description"
                          placeholder="Опишите ваш товар">{{old('description')}}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <label for="liquid" class="font-bold mt-4 mb-2">Жидкий</label>
                    <input type="checkbox" name="liquid" id="liquid" value="{{true}} ">
                </div>

                <div class="d-flex flex-column">
                    <label for="hard" class="font-bold mt-4 mb-2">Жёсткий </label>
                    <input type="checkbox" name="hard" id="hard" value="{{true}}">
                </div>

                <div class="d-flex flex-column">
                    <label for="wet" class="font-bold mt-4 mb-2">Влажный</label>
                    <input type="checkbox" name="wet" id="wet" value="{{true}}">
                </div>

                <div class="d-flex flex-column">
                    <label for="warm" class="font-bold mt-4 mb-2">Тёплый</label>
                    <input type="checkbox" name="warm" id="warm" value="{{true}}">
                </div>
            </div>

            <div class="submit mb-2">
                <button type="submit" class="btn btn-primary form-control mt-4 font-semibold">
                    Добавить
                </button>
            </div>

            <b>*</b> - обязательно для заполнения
        </form>
    </div>
</x-app-layout>



