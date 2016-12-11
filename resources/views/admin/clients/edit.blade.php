@extends('app')

@section('content')
    <h1>Editando cliente</h1>

    @include('errors._form')

    {!! Form::model($client, ['route' => ['admin.clients.update', $client->id]]) !!}

    @include('admin.clients._form')

    <div class="form-group">
        {!! Form::submit('Salvar', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection