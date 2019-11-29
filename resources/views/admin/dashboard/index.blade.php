@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item active" aria-current="page">Панель управления</li>
        </ol>
    </nav>
@endsection
@section('title', 'Главная')
@extends('layouts.admin.admin-layout')
@section('content')
    <div class="d-flex justify-content-start flex-md-row flex-column">
        <div class="card-image-container d-flex align-items-center justify-content-center m-3" style="background-image: url(/img/background.jpg)">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex justify-content-center align-items-center" style="width: 150px; height:150px; border: 1px rgba(42,43,59,0.53) solid; border-radius: 50%; background-color: rgba(42,43,59,0.53)">
            <i class="fas fa-newspaper fa-5x text-white p5"></i>
                </div>
            <p class="text-white roboto22bl">Записей: {{$posts_count}}</p>
            <p class="text-white roboto14">В базе данных {{$posts_count}} записей</p>
            <a href="{{route('admin.posts')}}"><div class="btn btn-primary">Показать все записи</div></a>
            </div>
        </div>
        <div class="card-image-container d-flex align-items-center justify-content-center m-3" style="background-image: url(/img/background.jpg)">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex justify-content-center align-items-center" style="width: 150px; height:150px; border: 1px rgba(42,43,59,0.53) solid; border-radius: 50%; background-color: rgba(42,43,59,0.53)">
                    <i class="far fa-file-alt fa-5x text-white p5"></i>
                </div>
                <p class="text-white roboto22bl">Страниц: {{$pages_count}}</p>
                <p class="text-white roboto14">В базе данных {{$pages_count}} страниц</p>
                <a href="{{route('admin.pages')}}"><div class="btn btn-primary">Показать все страницы</div></a>
            </div>
        </div>
    </div>

    @endsection