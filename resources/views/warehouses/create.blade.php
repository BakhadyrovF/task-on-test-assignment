@extends('layouts.main')
@section('title', 'Склады')

@section('content')
    <div style="margin-top: 25px"></div>
    <h2>Создать новый склад</h2>
    <div class="" style="margin-top: 30px">
        <form action="{{route('warehouses.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Наименование склада</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" required>
                @error('title')
                    <div class="alert alert-danger" style="margin-top: 7px">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Код (Уникальный)</label>
                <input type="number" name="code" value="{{old('code')}}" class="form-control" id="code" required>
                @error('code')
                <div class="alert alert-danger" style="margin-top: 7px">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
