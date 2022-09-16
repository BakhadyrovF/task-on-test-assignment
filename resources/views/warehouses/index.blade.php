@extends('layouts.main')
@section('title', 'Склады')

@section('content')
    <div style="margin-top: 50px">
        <a href="{{route('warehouses.create')}}" class="btn btn-primary">Новый склад</a>
    </div>
    <div style="margin-top: 15px">
        <h1>Склады</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Код</th>
                <th scope="col">Наименование склада</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouses as $warehouse)
                <tr>
                    <td>{{$warehouse->code}}</td>
                    <td>{{$warehouse->title}}</td>
                    <td>
                        <form action="{{route('warehouses.destroy', $warehouse)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
