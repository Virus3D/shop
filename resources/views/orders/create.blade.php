@extends('layouts.app')

@section('title', 'Добавить заказ')

@section('content')
    <h1 class="mb-20">Добавить заказ</h1>

    <div class="card">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="customer_name">ФИО покупателя *</label>
                <input type="text" name="customer_name" id="customer_name"
                       value="{{ old('customer_name') }}" required
                       class="@error('customer_name') is-invalid @enderror">
                @error('customer_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_id">Товар *</label>
                <select name="product_id" id="product_id" required
                        class="@error('product_id') is-invalid @enderror">
                    <option value="">Выберите товар</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id', $selectedProduct) == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} ({{ number_format($product->price, 2, ',', ' ') }} руб.)
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Количество *</label>
                <input type="number" min="1" name="quantity" id="quantity"
                       value="{{ old('quantity', 1) }}" required
                       class="@error('quantity') is-invalid @enderror">
                @error('quantity')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea name="comment" id="comment"
                          class="@error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Добавить заказ</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
@endsection
