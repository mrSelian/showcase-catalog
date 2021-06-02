<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            Товары
        @endsection
    </x-slot>
    <div class="container">
        @include('layouts.flash')
        @if($products->isEmpty())
            Товаров нет.
        @else
            <table class="table">
                <thead class="justify-between">
                <tr>
                    <th></th>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Остаток</th>
                    <th></th>
                </tr>

                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="bg-white">
                        <td><img src="{{$product->getMainPhoto()}}" width="100px" height="100px"></td>
                        <td class="text-center font-semibold">{{$product->getTitle()}}</td>
                        <td>{{$product->getPrice()}} &#8381;</td>
                        <td>{{$product->getAmount()}} шт.</td>
                        <td>

                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    Действия
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{route('show_product',$product->getId())}}">
                                            Подробнее</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('edit_product',$product->getId())}}">Изменить</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        @if($product->isDeleted())
                                            <form action="{{ route('restore_product', $product->getId())}}"
                                                  method="post">
                                                @csrf
                                                <button class="dropdown-item" type="submit">Восстановить</button>
                                            </form>
                                        @else
                                            <form action="{{ route('delete_product', $product->getId())}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">Удалить</button>
                                            </form>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$products->links('pagination::bootstrap-4')}} </div>
        @endif
    </div>
</x-app-layout>
