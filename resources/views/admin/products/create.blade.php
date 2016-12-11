@extends('app')

@section('content')
    <h1>Novo produto</h1>

    @include('errors._form')

    {!! Form::open(['route'=> 'admin.products.store']) !!}

    @include('admin.products._form')

    <div class="form-group">
        {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection