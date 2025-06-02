@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-20">
        <h1>Список заказов</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Добавить заказ</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th>Покупатель</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            <span class="badge {{ $order->status == 'new' ? 'badge-primary' : 'badge-success' }}">
                                {{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}
                            </span>
                        </td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} руб.</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-secondary">Просмотр</a>
                            @if($order->status == 'new')
                                <form action="{{ route('orders.complete', $order) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Завершить</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
