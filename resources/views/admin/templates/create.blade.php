@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.templates')}}">Шаблоны</a></li>
            <li class="breadcrumb-item active" aria-current="page">Создание</li>
        </ol>
    </nav>
@endsection
@section('title', 'Создание Шаблона')
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
        <span class="users_text mx-3">Создание Шаблона - <span></span></span>
    </div>
    <form method="post" class="mt-4" action="{{route('admin.templates.store')}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                    <label for="name" class="d-block">
                        Путь к Шаблону
                    </label>
                    <input required type="text" name="path" value="" class="w-100 input_fields" placeholder="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Название Шаблона
                    </label>
                    <input required type="text" name="name" value="" class="w-100 input_fields" placeholder="">
                </div>
                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
    @endsection