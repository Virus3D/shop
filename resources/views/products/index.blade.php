@extends('layouts.app')

@section('title', 'Список товаров')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-20">
        <h1>Список товаров</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить товар</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Цена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ number_format($product->price, 2, ',', ' ') }} руб.</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-secondary">Просмотр</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Редактировать</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить товар?')">Удалить</button>
                            </form>
                            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}"
                                class="btn btn-sm btn-success">
                                Заказать
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
