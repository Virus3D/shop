@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-20">
        <h1>Заказ #{{ $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>ФИО покупателя:</label>
                <p>{{ $order->customer_name }}</p>
            </div>

            <div class="form-group">
                <label>Дата создания:</label>
                <p>{{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>

            <div class="form-group">
                <label>Статус:</label>
                <p>
                    <span class="badge {{ $order->status == 'new' ? 'badge-primary' : 'badge-success' }}">
                        {{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}
                    </span>
                </p>
            </div>

            <div class="form-group">
                <label>Товар:</label>
                <p>
                    <a href="{{ route('products.show', $order->product) }}">
                        {{ $order->product->name }}
                    </a>
                    ({{ $order->quantity }} шт.)
                </p>
            </div>

            <div class="form-group">
                <label>Цена за единицу:</label>
                <p>{{ number_format($order->product->price, 2, ',', ' ') }} руб.</p>
            </div>

            <div class="form-group">
                <label>Итоговая цена:</label>
                <p>{{ number_format($order->total_price, 2, ',', ' ') }} руб.</p>
            </div>

            <div class="form-group">
                <label>Комментарий:</label>
                <p>{{ $order->comment ?? 'Нет комментария' }}</p>
            </div>

            @if($order->status == 'new')
                <form action="{{ route('orders.complete', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Отметить как выполненный</button>
                </form>
            @endif
        </div>
    </div>
@endsection
