@extends('app')

@section('content')
    <h1>Pedido #{{ $order->id }} - R$ {{ $order->formatted_total }}</h1>

    <h4>Cliente: {{ $order->client->user->name }}</h4>
    <h4>Data: {{ $order->formatted_created_at }}</h4>
    @if(isset($order->coupon->code))
        <h4>Cupom: {{ $order->coupon->code }}</h4>
    @endif

    <hr>

    <div class="row">
        <div class="col-md-6">
            <strong>Itens do pedido:</strong><br>
            <ul>
                @foreach($order->items as $item)
                    <li>{{ $item->product->name }} - Qtd.: {{ $item->qtd }} (R$ {{ $item->formatted_price }})</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <strong>Entregar em:</strong><br>
            {{ $order->client->address }}<br>
            {{ $order->client->city }} - {{ $order->client->state }}
        </div>
    </div>

    <hr>

    @include('errors._form')

    {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}

    <div class="form-group">
        {!! Form::label('user_deliveryman_id', 'Entregador:') !!}
        {!! Form::select('user_deliveryman_id', $deliverymen, null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', $statuses, null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Salvar', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection