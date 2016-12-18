@extends('app')

@section('content')
    <h1>Editando cupom</h1>

    @include('errors._form')

    {!! Form::model($coupon, ['route' => ['admin.coupons.update', $coupon->id]]) !!}

    @include('admin.coupons._form')

    <div class="form-group">
        {!! Form::submit('Salvar', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection