@extends('app')

@section('content')
    <h1>Editando produto</h1>

    @include('errors._form')

    {!! Form::model($product, ['route' => ['admin.products.update', $product->id]]) !!}

    @include('admin.products._form')

    <div class="form-group">
        {!! Form::submit('Salvar', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection