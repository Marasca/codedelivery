@extends('app')

@section('content')
    <h1>Cupons</h1>

    <a href="{{ route('admin.coupons.create') }}" class="btn btn-default">Novo cupom</a><br>
    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Valor</th>
            <th>Usado</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->code }}</td>
                <td>R$ {{ $coupon->formatted_value }}</td>
                <td>{{ $coupon->used ? 'Sim' : 'Não' }}</td>
                <td>
                    @if(!$coupon->used)
                    <a href="{{ route('admin.coupons.edit', ['id' => $coupon->id]) }}" class="btn btn-default btn-xs">Editar</a>
                    <a href="{{ route('admin.coupons.destroy', ['id' => $coupon->id]) }}" class="btn btn-default btn-xs">Excluir</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $coupons->render() !!}
@endsection