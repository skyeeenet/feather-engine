@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.posts')}}">Записи</a></li>
            <li class="breadcrumb-item active" aria-current="page">Создание</li>
        </ol>
    </nav>
@endsection
@section('title', 'Создание Записи')
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
        <span class="users_text mx-3">Создание Записи</span>
    </div>
    <form method="post" enctype="multipart/form-data" class="mt-4" action="{{route('admin.posts.store')}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                    <label for="name" class="d-block">
                        Название
                    </label>
                    <input required type="text" name="name" class="w-100 input_fields" value="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Изображение записи
                    </label>
                    <input required type="file" name="image" class="w-100 input_fields" value="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Seo Url
                    </label>
                    <input required type="text" name="slug" class="w-100 input_fields" placeholder="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Seo Title
                    </label>
                    <input required type="text" name="seo_title" value="" class="w-100 input_fields" placeholder="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Seo Description
                    </label>
                    <input required type="text" name="seo_description" value="" class="w-100 input_fields" placeholder="">
                </div>
                <div class="my-3">
                    <label for="name" class="d-block">
                        Seo H1
                    </label>
                    <input required type="text" name="seo_h1" value="" class="w-100 input_fields" placeholder="">
                </div>

                <div class="my-3">
                    <textarea name="content" id="body"></textarea>
                </div>

                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
    @endsection

@section('scripts')
    <link rel="stylesheet" href="/css/summernote.css">
    <script src="{{URL::asset('js/summernote.min.js')}}"></script>
    <script>
        $('#body').summernote({
            height: 150,   //set editable area's height
        });
    </script>
@endsection