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
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" required>
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
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
