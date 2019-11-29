@section('title', 'Настройки')
@extends('layouts.admin.admin-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Настройки</li>
        </ol>
    </nav>
@endsection

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
        <span class="users_text mx-3">Настройки</span>
    </div>
    <form method="post" enctype="multipart/form-data" class="mt-4" action="{{route('admin.settings.update')}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">

                <div class="my-3">
                    <label for="">Название сайта</label>
                    <input class="form-control" type="text" name="title" value="{{$title ?? ''}}">
                </div>
                <div class="my-3">
                    <label for="">Описание сайта</label>
                    <input class="form-control" type="text" name="description" value="{{$description ?? ''}}">
                </div>

                <div class="my-3">
                    <label for="">Текст в шапке</label>
                    <input class="form-control" type="text" name="header_text" value="{{$header_text ?? ''}}">
                </div>

                <div>
                    <img style="max-width: 200px; width: 100%; height: auto;" src="{{$logo ?? ''}}" alt="">
                </div>
                <div class="my-3">
                    <label for="">Логотип сайта</label>
                    <input class="form-control" type="file" name="logo">
                </div>

                <div class="my-3">
                    <label for="">Разрешение изображений на сайте (500 = 500 x 500)</label>
                    <input class="form-control" type="text" name="image_size" value="{{$image_size ?? '800'}}">
                </div>

                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
    @endsection
