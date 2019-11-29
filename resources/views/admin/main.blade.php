@section('title', 'Главная')
@extends('layouts.admin.admin-layout')
@section('content')
    <ul>
    <li><a href="{{route('admin.users')}}">Пользователи</a></li>
        <li><a href="{{route('admin.referals')}}">Реферальная программа</a></li>
        <li><a href="{{route('admin.roles')}}">Роли</a></li>
        <li><a href="{{route('admin.operations')}}">Операции</a></li>
    </ul>
    <div class="d-flex justify-content-start flex-md-row flex-column">
        <div class="card-image-container d-flex align-items-center justify-content-center m-3" style="background-image: url(/img/background.jpg)">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex justify-content-center align-items-center" style="width: 150px; height:150px; border: 1px rgba(42,43,59,0.53) solid; border-radius: 50%; background-color: rgba(42,43,59,0.53)">
            <i class="fas fa-newspaper fa-5x text-white p5"></i>
                </div>
            <p class="text-white roboto22bl">10 записей</p>
            <p class="text-white roboto14">В базе данных 10 записей</p>
            <a href="#"><div class="btn btn-primary">Показать все записи</div></a>
            </div>
        </div>
        <div class="card-image-container d-flex align-items-center justify-content-center m-3" style="background-image: url(/img/background.jpg)">
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex justify-content-center align-items-center" style="width: 150px; height:150px; border: 1px rgba(42,43,59,0.53) solid; border-radius: 50%; background-color: rgba(42,43,59,0.53)">
                    <i class="fas fa-newspaper fa-5x text-white p5"></i>
                </div>
                <p class="text-white roboto22bl">10 записей</p>
                <p class="text-white roboto14">В базе данных 10 записей</p>
                <a href="#"><div class="btn btn-primary">Показать все записи</div></a>
            </div>
        </div>
    </div>

    @endsection