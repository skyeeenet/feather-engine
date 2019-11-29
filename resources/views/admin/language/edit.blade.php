@section('breadcrumb')
  <nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
      <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.languages')}}">Языки</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$language->key}}</li>
    </ol>
  </nav>
@endsection
@section('title', 'Редактирование Языка')
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
    <span class="users_text mx-3">Редактирование Языка - <span>{{$language->key}}</span></span>
  </div>

  <form method="post" class="mt-4" action="{{route('admin.languages.update', $language->id)}}">
    @csrf
    <div class="row">
      <div class="col bg-white shadow roboto16lt form-color mx-3">

        <div class="my-3">
          @include('admin.includes.fields.input', ['label_name' => 'Ключевое значение', 'required' => true, 'type' => 'text', 'name' => 'key', 'value' => $language->key])
        </div>

        <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
          @include('admin.includes.buttons.updateButton')
        </div>
      </div>
    </div>
  </form>
@endsection
