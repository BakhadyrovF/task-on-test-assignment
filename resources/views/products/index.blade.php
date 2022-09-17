@extends('layouts.main')
@section('title', 'Продукты')

@section('content')

    <div style="margin-top: 50px;">
        <form action="{{route('products.index')}}" method="GET">
        <div style="display: flex">
            <a href="{{route('products.create')}}" class="btn btn-primary">Новый продукт</a>
            <input type="text" class="form-control" name="search" value="{{request()->query('search')}}" style="width: 20%; margin-left: 15px; margin-right: 10px" placeholder="Поиск по наименованию">
        </div>
            <div class="mb-3 mt-3">
                <h3>Фильтр по дате (От и До)</h3>
                <div style="display: flex">
                <input type="date" name="from" id="from" value="{{request()->query('from')}}" class="form-control" style="width: 20%; margin-right: 10px">

                <input type="date" name="to" id="to" value="{{request()->query('to')}}" class="form-control" style="width: 20%; margin-right: 10px">
                <button type="submit" class="btn btn-success">Отфильтровать</button>
                <a href="{{route('products.index')}}" class="btn btn-warning" style="margin-left: 15px;">Сбросить</a>
                </div>
            </div>
        </form>
    </div>
    <div style="margin-top: 15px">
        <h1>Продукты</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Дата изготовления</th>
                <th scope="col">Наименование товара</th>
                <th scope="col">Описание товара</th>
                <th scope="col">Склад и стоимость</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->manufacture_date}} г.</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description ?? 'Нет описания.'}}</td>
                    <td>
                        @if($product->warehouses->isNotEmpty())
                            @foreach($product->warehouses as $warehouse)
                                <p>{{$warehouse->title}} - {{$warehouse->pivot->price}} р.</p>
                            @endforeach
                        @else
                            <p>Нет в наличии.</p>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex">
                        <form action="{{route('products.destroy', $product)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                        <a class="btn btn-secondary" style="margin-left: 5px" href="{{route('products.edit', $product)}}">Редактировать</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
