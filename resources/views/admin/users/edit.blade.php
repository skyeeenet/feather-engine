@section('breadcrumb')
  <nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
      <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$user->login}}</li>
    </ol>
  </nav>
@endsection
@section('title', 'Редактирование Пользователя')
@extends('layouts.admin.admin-layout')
@section('content')

  <div class="mt-5 d-flex align-items-center">
    <i class="fa fa-user fa-4x"></i>
    <span class="users_text mx-3">Информация Пользователя - <span>{{$user->login}}</span></span>
  </div>
  <form method="post"  action="{{route('admin.users.update', $user->id)}}" class="mt-4">
    @csrf
  <div class="row">
    <div class="col bg-white shadow roboto16lt form-color mx-3">
      <div class="my-3">
      <label for="name" class="d-block">
        Имя Пользователя
      </label>
      <input type="text" id="name" name="login" value="{{$user->login}}" class="w-100 input_fields" placeholder="{{$user->login}}">
      </div>
      <div class="my-3">
        <label for="name" class="d-block">
          E-mail
        </label>
        <input type="email" id="name" name="email" value="{{$user->email}}" placeholder="{{$user->email}}" class="w-100 input_fields">
      </div>

      <div class="my-3">
        <label for="name" class="d-block">
          Пароль
        </label>
        <small>Для сохранения того же значения оставьте поле пустым</small>
        <input type="password" id="name" name="password" value="" class="w-100 input_fields">
      </div>

      <div class="my-3">
        <label for="name" class="d-block">
          Дата регистрации
        </label>
        <input type="text" id="created_at" name="created_at" value="{{$user->created_at}}" class="w-100 input_fields">
      </div>

      <div class="my-3">
        <label for="name" class="d-block">
          Заблокировать пользователя? Текущий статус - @if($user->banned == 0) <b>Не заблокирован</b> @else <b style="color: tomato;">Заблокирован</b> @endif
        </label>
        <select class="w-100 input_fields" name="ban">
          @if($user->banned == 0)
          <option selected value="0">Нет</option>
          <option value="1">Да</option>
            @else
            <option value="0">Нет</option>
            <option selected value="1">Да</option>
            @endif
        </select>
      </div>
      <div class="my-3">
        <label for="name" class="d-block">
          Комментарий блокировки Пользователя
        </label>
        <input type="text" id="created_at" name="comment" value="{{$user->comment}}" class="w-100 input_fields">
      </div>

    </div>
  </div>
    <div class="d-flex mt-4 justify-content-center justify-content-sm-end">
      <a href="/admin/users"><div class="btn btn-secondary px-5 py-3 mr-4">Назад</div></a>
      <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
    </div>
  </form>

@endsection
