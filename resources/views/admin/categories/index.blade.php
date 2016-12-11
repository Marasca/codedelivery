@extends('app')

@section('content')
    <h1>Categorias</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-default">Nova categoria</a><br>
    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Produtos</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products()->count() }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-default btn-xs">Editar</a>
                    @if($category->products()->count() == 0)
                    <a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" class="btn btn-default btn-xs">Excluir</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $categories->render() !!}
@endsection