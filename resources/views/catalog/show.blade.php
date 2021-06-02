<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            Каталог
        @endsection
    </x-slot>
    <div class="container">
        <div class="row top">
            <div class="logo col-lg-3 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                <div class="p-1 mt-8 d-flex justify-content-center mb-3">
                    <a href="{{route('catalog')}}"><img src="/logo.jpg" width="90%" height="90%"></a>
                </div>
            </div>

            <div class="space d-none d-md-block col-lg-9 col-md-6">
            </div>
        </div>
        @include('layouts.flash')
        <div class="row sort-info">
            <div class="info d-none d-md-block col-lg-3 col-md-4 ">
                <text class="d-flex fw-bold fs-5 justify-content-center">
                    - 15 лет на рынке <br>- Высокое качество <br>- Конкурентная цена<br></text>
            </div>
            <div class="sort-form col-lg-9 col-md-8 col-sm-12 col-xs-12 ">
                <div class="bg-transparent border-2 border-dashed border-black pt-0 px-3 pb-2 mb-2 w-100">
                    <text class="fw-bolder fs-5 text-left mb-2">сортировка</text>
                    <div class="d-flex justify-content-between">
                        <div class="dropdown">
                            <button class="fw-bold fs-5 @if($sort['sortBy'] == 'price')underline @endif"
                                    id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                по цене
                            </button>
                            <text class="fw-bold">
                                @if($sort['sortBy'] == 'price' && $sort['desc'] == '1')&#9650;
                                @else &#9660;
                                @endif
                            </text>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'price'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'0'}}">
                                        <button type="submit" class="dropdown-item">
                                            По возрастанию
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'price'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'1'}}">
                                        <button type="submit" class="dropdown-item">
                                            По убыванию
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="fw-bold fs-5 @if($sort['sortBy'] == 'title')underline @endif"
                                    id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                по алфавиту
                            </button>
                            <text class="fw-bold">
                                @if($sort['sortBy'] == 'title' && $sort['desc'] == '1')&#9650;
                                @else &#9660;
                                @endif
                            </text>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'title'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'0'}}">
                                        <button type="submit" class="dropdown-item">
                                            А - Я
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'title'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'1'}}">
                                        <button type="submit" class="dropdown-item">
                                            Я - А
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="fw-bold fs-5 @if($sort['sortBy'] == 'amount')underline @endif"
                                    id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                по количеству
                            </button>
                            <text class="fw-bold">
                                @if($sort['sortBy'] == 'amount' && $sort['desc'] == '1')&#9650;
                                @else &#9660;
                                @endif
                            </text>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'amount'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'0'}}">
                                        <button type="submit" class="dropdown-item">
                                            От меньших
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{route('catalog')}}" method="GET" class="form">

                                        <input type="hidden" name="sortBy" id="sortBy" value="{{'amount'}} ">
                                        <input type="hidden" name="filter" id="filter"
                                               value="{{json_encode($filter)}}">
                                        <input type="hidden" name="desc" id="desc" value="{{'1'}}">
                                        <button type="submit" class="dropdown-item">
                                            От больших
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row page">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="bg-transparent border-2 border-dashed border-black mt-1 pt-1 px-3 pb-3 mb-2">
                    <form action="{{route('catalog')}}" method="GET" class="form">

                        <text class="fw-bold fs-5 text-left mb-2">фильтр</text>
                        <div>
                            <label for="brand" class="text-lg mt-2 control-label font-bold text-center">
                                Производитель
                            </label>
                            <div class="flex flex-wrap  ">

                                <div class="flex flex-col justify-between">
                                    <div class="text-sm">
                                        <input type="checkbox" name="brand1" id="brand1"
                                               @if(in_array('microsoft',$filter['brand']))checked
                                               @endif
                                               value="{{'microsoft'}} ">
                                        <label for="brand1" class="font-bold mx-1 mt-2 mb-2">Microsoft</label>
                                    </div>

                                    <div class="text-sm">
                                        <input type="checkbox" name="brand2" id="brand2"
                                               @if(in_array('samsung',$filter['brand']))checked
                                               @endif
                                               value="{{'samsung'}}">
                                        <label for="brand2" class="font-bold mx-1 mt-2 mb-2">Samsung</label>
                                    </div>

                                    <div class="text-sm">
                                        <input type="checkbox" name="brand3" id="brand3"
                                               @if(in_array('apple',$filter['brand']))checked
                                               @endif
                                               value="{{'apple'}}">
                                        <label for="brand3" class="font-bold mx-1 mt-2 mb-2">Apple</label>
                                    </div>

                                    <div class="text-sm">
                                        <input type="checkbox" name="brand4" id="brand4"
                                               @if(in_array('xiaomi',$filter['brand']))checked
                                               @endif
                                               value="{{'xiaomi'}}">
                                        <label for="brand4" class="font-bold mx-1 mt-2 mb-2">Xiaomi</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label for="product" class="text-lg mt-2 control-label font-bold text-left">Цена
                            </label>
                            <input
                                class="border border-gray-200 p-2 mb-2 focus:outline-none focus:border-gray-500"
                                type="text" name="minPrice" id="minPrice"
                                value="@if($filter['minPrice'] != null){{$filter['minPrice']}}@endif"
                                placeholder="От  &#8381;">
                            <input
                                class="border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                type="text" name="maxPrice" id="maxPrice"
                                value="@if($filter['maxPrice'] != null){{$filter['maxPrice']}}@endif"
                                placeholder="До  &#8381;">
                        </div>


                        <label for="product" class="text-lg mt-2 control-label font-bold text-left">
                            Параметры
                        </label>
                        <div class="flex flex-wrap">
                            <div class="flex flex-col justify-between">
                                <div class="text-sm">
                                    <input type="checkbox" name="liquid" id="liquid"
                                           @if(isset($filter['liquid']))checked
                                           @endif
                                           value="{{true}} ">
                                    <label for="liquid" class="font-bold mx-1 mt-2 mb-2">Жидкий</label>
                                </div>

                                <div class="text-sm">
                                    <input type="checkbox" name="hard" id="hard"
                                           @if(isset($filter['hard']))checked
                                           @endif
                                           value="{{true}}">
                                    <label for="hard" class="font-bold mx-1 mt-2 mb-2">Жёсткий </label>
                                </div>

                                <div class="text-sm">
                                    <input type="checkbox" name="wet" id="wet"
                                           @if(isset($filter['wet']))checked
                                           @endif
                                           value="{{true}}">
                                    <label for="wet" class="font-bold mx-1 mt-2 mb-2">Влажный</label>
                                </div>

                                <div class="text-sm">
                                    <input type="checkbox" name="warm" id="warm"
                                           @if(isset($filter['warm']))checked
                                           @endif
                                           value="{{true}}">
                                    <label for="warm" class="font-bold mx-1 mt-2 mb-2">Тёплый</label>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="sort" id="sort"
                               value="{{json_encode($sort)}}">
                        <div class="submit mb-1">
                            <button type="submit"
                                    class="btn btn-primary input-block-level form-control mt-3 font-semibold">
                                Применить
                            </button>
                        </div>
                    </form>
                    <form action="{{route('catalog')}}" method="GET" class="form">
                        <input type="hidden" name="sort" id="sort"
                               value="{{json_encode($sort)}}">
                        <div class="submit ">
                            <button type="submit"
                                    class="btn btn-secondary input-block-level form-control mt-1 font-semibold">
                                Сбросить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 py-0">
                <div class="row products ">
                    @if($products->isEmpty())
                        <div class="text-center py-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            Товары, соответствующие вашему запросу, отсутствуют!
                        </div>  @endif
                    @foreach($products as $product)
                        @if($product->getAmount() <1 )
                            @continue
                        @endif
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 py-2 px-3">
                            <div
                                class="bg-transparent overflow-hidden">
                                <div class="bg-cover bg-center h-56"
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
        <div class="row bottom">
            <div class="d-none d-md-block col-lg-3 col-md-3"></div>
            <div class="d-flex justify-content-center col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                {{$products->appends(array_merge($filter ?? [],$sort ?? []))->links('pagination::bootstrap-4')}} </div>
        </div>
    </div>

</x-app-layout>
