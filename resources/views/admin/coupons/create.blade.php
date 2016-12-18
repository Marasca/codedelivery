@extends('app')

@section('content')
    <h1>Novo cupom</h1>

    @include('errors._form')

    {!! Form::open(['route'=> 'admin.coupons.store']) !!}

    @include('admin.coupons._form')

    <div class="form-group">
        {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection