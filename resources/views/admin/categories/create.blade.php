@extends('app')

@section('content')
    <h1>Nova categoria</h1>

    @include('errors._form')

    {!! Form::open(['route'=> 'admin.categories.store']) !!}

    @include('admin.categories._form')

    <div class="form-group">
        {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection