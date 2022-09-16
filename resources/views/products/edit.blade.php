@extends('layouts.main')
@section('title', 'Продукты')

@section('content')
    <div style="margin-top: 25px"></div>
    <h2>Обновить существующий продукт</h2>
    <div class="" style="margin-top: 30px">
        <form action="{{route('products.update', $product)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Наименование продукта</label>
                <input type="text" name="title" value="{{old('title') ?? $product->title}}" class="form-control" id="title" required>
                @error('title')
                <div class="alert alert-danger" style="margin-top: 7px">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание (Необязательно)</label>
                <input type="text" name="description" value="{{old('code') ?? $product->description}}" class="form-control" id="description">
                @error('description')
                <div class="alert alert-danger" style="margin-top: 7px">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="manufacture_date" class="form-label">Дата изготовления</label>
                <input type="date" name="manufacture_date" value="{{old('manufacture_date') ?? \Illuminate\Support\Carbon::parse($product->manufacture_date)->format('Y-m-d')}}" class="form-control" min={{now()->format('Y-m-d')}} id="manufacture_date">
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
