@extends('layouts.admin.admin-layout')
@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
        </ol>
    </nav>
@endsection
@section('title', 'Пользователи')
@section('content')

    <form id="search" method="GET" class="m-0" action="{{ action('Admin\Users\UserController@index') }}">

    </form>

    <form action="{{route('admin.users.trash')}}" method="post">
        @csrf
    <div class="roboto16">
        <div class="mt-4 d-block">
            <p>Зарегистрированные Пользователи (количество):&nbsp;<b>{{$users_count}}</b></p>
        </div>
        <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
            <i class="fa fa-user fa-4x ml-2 ml-sm-0"></i>
            <span class="users_text ml-3">Пользователи</span>

        </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
      <div class="container-fluid">
        <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
        </div>
        <div class="table-responsive-xl">
          <table class="table">
            <thead class="bg-gray">
            <tr class="border-bottom">
              <th scope="col" class="p-3 text-center"><input type="checkbox" id="selall" name="scales"></th>
              <th scope="col" class="pt-4 pl-2 pb-4 pr-0 text-center"><a class="sort" href="#">Логин Пользователя</a></th>
              <th scope="col" class="p-2 text-center">Email Пользователя</th>
              <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Дата регистрации Пользователя</a></th>
              <th scope="col" class="p-2 text-center">Активация Пользователя через email</th>
              <th scope="col" class="p-2 text-center">Доступные действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr class="border-bottom">
                <td scope="col" class="p-2"><input type="checkbox" class="checkbox" value="{{$user->id}}" name="checkbox[]"></td>
                <td scope="col" class="p-2" align="center"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></td>
                <td scope="col" class="p-2" align="center">{{$user->email}}</td>
                <td scope="col" class="p-2" align="center">{{spaceToUnderscore($user->created_at)}}</td>
                <td scope="col"
                    class="p-2" align="center">{{$user->email_verified_at == null ? 'Не активирован': '+'}}</td>

                <td scope="col" class="p-2">
                  <div class=" d-flex flex-column align-items-end">
                    <a href="{{route('admin.users.delete', $user->id)}}" class="btn  btn-danger my-1"><div class="d-flex align-items-center"><i class="fa fa-trash-o  mr-1"></i>Удалить
                      </div></a>
                    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary my-1"><div class="d-flex align-items-center"><i class="fa fa-edit mr-1"></i>Изменить
                      </div></a>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-4 d-flex justify-content-sm-between justify-content-center pb-5 mx-2 flex-wrap">
          <div class="d-flex align-items-center mb-2">
            <span>Показано от 1 до {{$users->count()}} из {{$users->total()}} записей</span>
          </div>
          {{ $users->links() }}
        </div>
      </div>
    </div>
    </form>

@endsection
