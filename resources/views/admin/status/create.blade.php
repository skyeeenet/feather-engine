@section('title', 'Создание статуса')
@extends('layouts.admin.admin-layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-5 d-flex align-items-center">
        <i class="fa fa-user fa-4x"></i>
        <span class="users_text mx-3">Создание Статуса</span>
    </div>
    <form method="post" class="mt-4" action="{{route('admin.statuses.store')}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                    <label for="name" class="d-block">
                        Название статуса
                    </label>
                    <input type="text" id="name" name="status" value="" class="w-100 input_fields" placeholder="">
                </div>
                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
