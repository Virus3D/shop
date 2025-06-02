@extends('layouts.app')

@section('title', 'Редактировать: ' . $product->name)

@section('content')
    <h1 class="mb-20">Редактировать товар: {{ $product->name }}</h1>

    <div class="card">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название товара *</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $product->name) }}" required
                       class="@error('name') is-invalid @enderror">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Категория *</label>
                <select name="category_id" id="category_id" required
                        class="@error('category_id') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена (рубли) *</label>
                <input type="number" step="0.01" min="0.01"
                       name="price" id="price"
                       value="{{ old('price', $product->price) }}"
                       required
                       class="@error('price') is-invalid @enderror">
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description"
                          class="@error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
@endsection
