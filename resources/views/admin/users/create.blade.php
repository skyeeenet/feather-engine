@section('breadcrumb')
  <nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
      <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
      <li class="breadcrumb-item active" aria-current="page">Создать</li>
    </ol>
  </nav>
@endsection
@section('title', 'Редактирование Пользователя')
@extends('layouts.admin.admin-layout')
@section('content')

  <div class="mt-5 d-flex align-items-center">
    <i class="fa fa-user fa-4x"></i>
    <span class="users_text mx-3">Создать Пользователя</span>
  </div>
  <form method="post"  action="{{route('admin.users.store')}}" class="mt-4">
    @csrf
    <div class="row">
      <div class="col bg-white shadow roboto16lt form-color mx-3">
        <div class="my-3">
          <label for="name" class="d-block">
            Имя Пользователя
          </label>
          <input type="text" id="name" name="login" value="" class="w-100 input_fields" placeholder="">
        </div>
        <div class="my-3">
          <label for="name" class="d-block">
            E-mail
          </label>
          <input type="email" id="name" name="email" value="" placeholder="" class="w-100 input_fields">
        </div>

        <div class="my-3">
          <label for="name" class="d-block">
            Пароль
          </label>
          <input type="text" id="name" name="password" value="" class="w-100 input_fields">
        </div>
        <div class="my-3">
          <label for="name" class="d-block">
            Роль по умолчанию
          </label>
          <select class="w-100 input_fields" name="role">
            @foreach($roles as $role)
              <option value="{{$role->id}}">{{$role->value}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="d-flex mt-4 justify-content-center justify-content-sm-end">
      <a href="/admin/users"><div class="btn btn-secondary px-5 py-3 mr-4">Назад</div></a>
      <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
    </div>
  </form>
@endsection
