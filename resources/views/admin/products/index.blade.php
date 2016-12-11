@extends('app')

@section('content')
    <h1>Produtos</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo produto</a><br>
    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>R$ {{ $product->formatted_price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-default btn-xs">Editar</a>
                    <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-default btn-xs">Excluir</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->render() !!}
@endsection