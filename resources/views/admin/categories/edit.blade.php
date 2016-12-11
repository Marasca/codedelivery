@extends('app')

@section('content')
    <h1>Editando categoria</h1>

    @include('errors._form')

    {!! Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}

    @include('admin.categories._form')

    <div class="form-group">
        {!! Form::submit('Salvar', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection