@extends('app')

@section('content')
    <h1>Pedidos</h1>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Total</th>
            <th>Itens</th>
            <th>Entregador</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->client->user->name }}</td>
                <td>{{ $order->formatted_created_at }}</td>
                <td>R$ {{ $order->formatted_total }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                        <li>{{ $item->product->name }} - Qtd.: {{ $item->qtd }} (R$ {{ $item->formatted_price }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ isset($order->deliveryman->name) ? $order->deliveryman->name : '--' }}</td>
                <td>{{ $statuses[$order->status] }}</td>
                <td>
                    <a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" class="btn btn-default btn-xs">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $orders->render() !!}
@endsection