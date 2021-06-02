<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            {{$product->getTitle()}} -  Карточка товара
        @endsection
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                <div class="p-1 mt-8 d-flex justify-content-center mb-3">
                    <a href="{{route('catalog')}}"><img src="/logo.jpg" width="90%" height="90%"></a>
                </div>
            </div>
            <div class="d-none d-md-block col-lg-9 col-md-6 col-sm-6 col-xs-12 "></div>
        </div>

        <div class="row">
            <div class="col-col-lg-3 col-md-5 col-sm-6 col-xs-6">
                <div class="p-1 mt-2 mb-2 ">
                    <a href="{{ route('catalog')}}" class="text-lg font-semibold text-black">
                        &lArr; на главную</a>
                </div>
            </div>
            <div class="space col-lg-9 col-md-7 col-sm-6 col-xs-6">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                <div class="bg-transparent">
                    @php
                        $mainPhoto = $product->getMainPhoto();
                        $photos = $product->getAdditionalPhotos();
                        $slideNumber = 1;
                    @endphp
                    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true"></button>
                            @foreach($photos as $photo)
                                @if($photo != null)
                                    <button type="button" data-bs-target="#carouselIndicators"
                                            data-bs-slide-to="{{$slideNumber}}"></button>
                                    @php
                                        $slideNumber++;
                                    @endphp
                                @endif
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{$mainPhoto}}" class="d-block w-100" alt="...">
                            </div>
                            @foreach($photos as $photo)
                                @if($photo != null)
                                    <div class="carousel-item">
                                        <img src="{{$photo}}" class="d-block w-100" alt="...">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Предыдущий</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Следующий</span>
                        </button>
                    </div>

                    <div
                        class="uppercase mt-2 mb-3 text-lg font-semibold"
                        data-id="{{$product->getId()}}">{{$product->getTitle()}}</div>
                </div>
                @if($product->getOldPrice()!= null)
                    <text class="text-2xl text-gray-500 mb-1"><s>{{$product->getOldPrice()}}
                            &#8381;</s></text>
                    <br>
                @endif
                <div class="float-left text-3xl mb-3">{{$product->getPrice()}}
                    &#8381;
                </div>
                <div class="float-right font-semibold  mb-1 ">
                    @if($product->isDeleted())
                        <span style="color: red">Товар удалён.</span>
                    @elseif($product->getAmount() > 0)
                        <span class=""
                              style="color: green">В наличии: {{$product->getAmount()}} шт</span>
                    @else
                        <span style="color: red">Отсутствует.</span>
                    @endif
                </div>
            </div>

            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">

                <div class="bg-transparent">

                    <div class="text-xl font-semibold text-gray-700">
                        Описание
                    </div>

                    <div class="text-lg">
                        <p>{{$product->getDescription()}}</p>
                    </div>

                    <hr>
                    <div class="mt-2 d-flex align-items-center justify-content-between mb-1">
                        <h2 class="text-xl font-semibold text-gray-700">Бренд</h2>
                        <h2 class="text-lg font-semibold">{{strtoupper($product->getBrand())}}</h2>
                    </div>
                    <hr>
                    <div class="mt-2 mb-2">
                        <h2 class="text-xl font-semibold text-gray-700">Характеристики:</h2>
                    </div>
                    <div class="float-left">
                        <div class="mt-1">
                            <h2 class="text-lg font-semibold text-gray-700">Жидкий</h2>
                            <p> @if(($product->getQuality('liquid'))) да @else нет @endif</p>
                        </div>

                        <div class="mt-3">
                            <h2 class="text-lg font-semibold text-gray-700">Жёсткий</h2>
                            <p>@if(($product->getQuality('hard'))) да @else нет @endif</p>
                        </div>
                    </div>

                    <div class="float-right">
                        <div class="mt-1">
                            <h2 class="text-lg font-semibold text-gray-700">Влажный</h2>
                            <p>@if(($product->getQuality('wet'))) да @else нет @endif</p>
                        </div>

                        <div class="mt-3">
                            <h2 class="text-lg font-semibold text-gray-700">Теплый</h2>
                            <p>@if(($product->getQuality('warm'))) да @else нет @endif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.flash')
        <div class="row order-form">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 @if($product->isDeleted()) hidden @endif">
                <a name="form"></a>
                <form action="{{route('make_order')}}" method="POST"
                      class="form-horizontal">
                    @csrf
                    <div class="mb-3 mt-3 text-xl font-semibold">
                        Оставить заказ
                    </div>

                    <div class="input-group row">
                        <div class="order_form_name col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <input name="customer" id="customer" value="{{old('customer')}}"
                                   class="form-control mb-3  rounded-md" type="text" placeholder="Ваше ФИО">
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <input name="phone" id="phone" value="{{old('phone')}}"
                                   class="form-control mb-3  rounded-md" type="text" placeholder="Номер телефона">
                            <input type="hidden" name="productId" id="productId" value="{{$product->getId()}}">
                        </div>

                        <div class="order_form_button col-lg-4 col-md-12 col-sm-12 col-xs-12 mb-6">
                            <button type="submit" class="btn btn-primary form-control font-semibold">
                                Отправить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mb-3 mt-3 text-xl font-semibold">
                    @if($similarProducts->isEmpty())
                        Похожих товаров не найдено.
                    @else
                        Похожие товары
                    @endif
                </div>

                <div class="row">
                    @foreach($similarProducts as $product)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                            <div class="bg-transparent overflow-hidden">
                                <div class="bg-cover  bg-center h-56 p-4"
                                     style="background-image: url({{$product->getMainPhoto()}})">
                                </div>
                                <div class="pt-2">
                                    <p class="uppercase font-bold text-gray-700 text-center"><a
                                            href="{{route('show_product',$product->getId())}}">{{$product->getTitle()}}</a>
                                    </p>
                                    @if($product->getOldPrice()!= null)
                                        <text class="text-xl text-gray-500 mb-1"><s>{{$product->getOldPrice()}}
                                                &#8381;</s></text>
                                        <br>
                                    @endif
                                    <p class="float-left text-2xl text-gray-900 mb-2">{{$product->getPrice()}}
                                        &#8381;</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
