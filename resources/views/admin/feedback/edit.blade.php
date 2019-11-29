@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.feedback')}}">Обратная связь</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
        </ol>
    </nav>
@endsection
@section('title', 'Редактирование Обратной Связи')
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
        <span class="users_text mx-3">Редактирование Обратной связи</span>
    </div>
    <form method="post" class="mt-4" action="{{route('admin.feedback.update', $feedback->id)}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                    <label for="name" class="d-block">
                        Имя
                    </label>
                    <input required type="text" id="name" name="name" class="w-100 input_fields" value="{{$feedback->name}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Email
                    </label>
                    <input required type="text" name="email" class="w-100 input_fields" value="{{$feedback->email}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Телефон
                    </label>
                    <input required type="text" name="phone" class="w-100 input_fields" value="{{$feedback->phone}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Тема
                    </label>
                    <input required type="text" name="subject" class="w-100 input_fields" value="{{$feedback->subject}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Сообщение
                    </label>
                    <textarea name="message" id="" cols="30" rows="10">{{$feedback->message}}</textarea>
                </div>

                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Обновить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
