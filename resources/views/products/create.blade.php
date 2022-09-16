@extends('layouts.main')
@section('title', 'Продукты')

@section('content')
    <div style="margin-top: 25px"></div>
    <h2>Создать новый продукт</h2>
    <div class="" style="margin-top: 30px">
        <form action="{{route('products.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Наименование продукта</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title">
                @error('title')
                <div class="alert alert-danger" style="margin-top: 7px">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание (Необязательно)</label>
                <input type="text" name="description" value="{{old('code')}}" class="form-control" id="description">
                @error('description')
                <div class="alert alert-danger" style="margin-top: 7px">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="manufacture_date" class="form-label">Дата изготовления</label>
                <input type="date" name="manufacture_date" value="{{old('date') ?? now()->format('Y-m-d')}}" class="form-control" min={{now()->format('Y-m-d')}} id="manufacture_date">
            </div>
            <div>
                <h3>Склады</h3>
                @if($errors->isNotEmpty())
                    <p class="alert alert-danger">{{$errors->first('warehouses')}}</p>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Наименование склада</th>
                        <th scope="col">Стоимость (руб)</th>
                        <th scope="col">Кол-во штук в наличии</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($warehouses as $warehouse)
                            <tr>
                                <td>{{$warehouse->title}}</td>
                                <td>
                                    <input type="number" step="any" name="warehouses[{{$warehouse->id}}][price]">
                                </td>
                                <td>
                                    <input type="number" name="warehouses[{{$warehouse->id}}][amount]">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
