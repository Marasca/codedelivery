@extends('app')

@section('content')
    <h1>Meus pedidos</h1>

    <a href="{{ route('customer.order.create') }}" class="btn btn-default">Novo pedido</a><br>
    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Total</th>
            <th>Itens</th>
            <th>Status</th>
            <th>Cupom</th>
        </tr>
        </thead>

        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->formatted_created_at }}</td>
                <td>R$ {{ $order->formatted_total }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                        <li>{{ $item->product->name }} - Qtd.: {{ $item->qtd }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->formatted_status }}</td>
                <td>{{ isset($order->coupon->code) ? $order->coupon->code : '--' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nenhum pedido encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {!! $orders->render() !!}
@endsection