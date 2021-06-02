<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            Orders
        @endsection
    </x-slot>
    <div class="container">
        @if($orders->isEmpty())
            Заказов нет.
        @else
            <table class="table">
                <thead class="justify-center">
                <tr>
                    <th>ФИО клиента</th>
                    <th>Телефон</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->getCustomerName()}}</td>

                        <td>{{$order->getCustomerPhone()}}</td>

                        <td><a href="{{route('show_product',$order->getProductId())}}"
                               target="_blank"
                               class="btn btn-link form-control font-semibold">Страница товара</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$orders->links('pagination::bootstrap-4')}} </div>
        @endif
    </div>
</x-app-layout>
