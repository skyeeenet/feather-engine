@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
            <li class="breadcrumb-item active" aria-current="page">Корзина</li>
        </ol>
    </nav>
@endsection
@section('title', 'Корзина с Пользователями')
@extends('layouts.admin.admin-layout')
@section('content')

    <form id="deleteChecked" action="{{route('admin.users.deleteChecked')}}" method="post">
        @csrf
    </form>
    <div class="roboto16">
        <div class="mt-4 d-block">
            <p>Пользователей в корзине (количество):&nbsp;<b>{{count($users)}}</b></p>
        </div>
        <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
            <i class="fa fa-user fa-4x ml-2 ml-sm-0"></i>
            <span class="users_text ml-3">Корзина c Пользователями</span>
            <button type="submit" form="deleteChecked" class="btn btn-danger mx-2 my-1"><i class="fa fa-trash-o  mr-1"></i>Удалить выбранное из корзины
            </button>
        </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
        <div class="container-fluid">
            <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
                <div class="d-flex align-items-center mb-2 roboto16">
                    <span>Показать</span>
                    <select class="mx-1 custom-select" id="select">
                        <option selected value="5">5</option>
                        <option  value="3">3</option>
                    </select>
                    <span>записей</span>
                </div>
                <div class="d-flex align-items-center roboto16">
                    <div name="search" method="post" class="m-0">
                        <span class="mr-2">Поиск:</span>
                        <input class="custom-input" type="text" size="25">
                    </div>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table class="table">
                    <thead class="bg-gray">
                    <tr class="border-bottom">
                        <th scope="col" class="p-3 text-center"><input type="checkbox" id="selall" name="scales"></th>
                        <th scope="col" class="pt-4 pl-2 pb-4 pr-0 text-center"><a class="sort" href="#">Логин Пользователя</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="/admin/users/sort/?field=login&sort=Up" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="/admin/users/sort/?field=login&sort=Down" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Email Пользователя</th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Дата регистрации Пользователя</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="/admin/users/sort/?field=created_at&sort=Up" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="/admin/users/sort/?field=created_at&sort=Down" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Активация Пользователя через email</th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Суммарный объем операций (UAH)</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="/admin/users/sort/?field=balance&sort=Up" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="/admin/users/sort/?field=balance&sort=Down" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Реферальные вознаграждения</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="/admin/users/sort/?field=ref_balance&sort=Up" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="/admin/users/sort/?field=ref_balance&sort=Down" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Доступные действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="border-bottom">
                            <td scope="col" class="p-2"><input type="checkbox" form="deleteChecked" class="checkbox" value="{{$user->id}}" name="checkbox[]"></td>
                            <td scope="col" class="p-2" align="center"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a>
                            </td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{$user->email}}</td>
                            <td scope="col" class="p-2" align="center">{{spaceToUnderscore($user->created_at)}}</td>
                            <td scope="col"></td>
                            <td scope="col"
                                class="p-2" align="center">{{$user->email_verified_at == null ? 'Не активирован': '+'}}</td>
                            <td scope="col" class="p-2" align="center">{{number_format($user->balance, 2, '.', ' ') ?? 0}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{number_format($user->ref_balance, 2, '.', ' ') ?? 0}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2">
                                <div class=" d-flex flex-column align-items-end">
                                    <form action="{{route('admin.users.trashForceDelete', $user->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger my-1"><div class="d-flex align-items-center"><i class="fa fa-trash-o  mr-1"></i>Удалить
                                            </div></button>
                                    </form>

                                    <a href="{{route('admin.users.trashRestore', $user->id)}}" class="btn btn-info my-1"><div class="d-flex align-items-center"><i class="fa fa-trash-restore  mr-1"></i>Восстановить
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
               {{$users->links()}}
            </div>
        </div>
    </div>
        @endsection