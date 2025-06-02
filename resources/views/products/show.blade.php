@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-20">
        <h1>Товар: {{ $product->name }}</h1>
        <div class="actions">
            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}"
                class="btn btn-success">
                Создать заказ
            </a>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Редактировать</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить товар?')">Удалить</button>
            </form>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </div>

    <div class="product-details">
        <div class="product-info">
            <p><span class="label">ID:</span> {{ $product->id }}</p>
            <p><span class="label">Категория:</span> {{ $product->category->name }}</p>
            <p><span class="label">Цена:</span> {{ number_format($product->price, 2, ',', ' ') }} руб.</p>
            <p><span class="label">Описание:</span></p>
            <p>{{ $product->description ?? 'Нет описания' }}</p>
            <p><span class="label">Дата создания:</span> {{ $product->created_at->format('d.m.Y H:i') }}</p>
            <p><span class="label">Последнее обновление:</span> {{ $product->updated_at->format('d.m.Y H:i') }}</p>
        </div>
    </div>
@endsection
