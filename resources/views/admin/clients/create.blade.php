@extends('app')

@section('content')
    <h1>Novo cliente</h1>

    @include('errors._form')

    {!! Form::open(['route'=> 'admin.clients.store']) !!}

    @include('admin.clients._form')

    <div class="form-group">
        {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection