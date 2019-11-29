@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Операции рефералов</li>
        </ol>
    </nav>
@endsection
@section('title', 'Операции рефералов пользователя')
@extends('layouts.admin.admin-layout')
@section('content')

    <div class="roboto16">
        <div class="mt-4 d-block">
            <p>Зарегистрированные Рефералы (количество):&nbsp;<b>{{$ref_count}}</b></p>
            <p>Успешно совершенные операции (количество):&nbsp;<b>{{$operations_count}}</b></p>
            <p>Успешно совершенные операции (суммарный объем в UAH):&nbsp;<b>{{$total_balance}}</b></p>
            <p>Реферальные вознаграждения (суммарно начислено в UAH):&nbsp;<b>{{$ref_balance}}</b></p>
            <p>Баланс начисленных/выплаченных вознаграждений (UAH):&nbsp;<b>&nbsp;<a href="{{route('admin.users.paid.show', $user->id)}}">Выполнить переход</a></b></p>
            <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['exel' => '1'])) }}">Выгрузка данных в Excel</a>
        </div>
        <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
            <i class="fa fa-user fa-4x ml-2 ml-sm-0"></i>
            <span class="users_text ml-3 text-center">Операции Рефералов Пользователя <a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></span>
        </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
        <div class="container-fluid">
            <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
                @include('layouts.admin.amount')
                <div class="d-flex align-items-center roboto16">
                    <form name="search" method="GET" class="m-0" action="{{ action('Admin\Users\UserController@refOperations', $user->id) }}">
                        <span class="mr-2">Поиск:</span>
                        <input class="custom-input" name="search" type="text" size="25">
                    </form>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table class="table">
                    <thead class="bg-gray">
                    <tr class="border-bottom">
                        <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Логин Реферала</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'login', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'login', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Дата подачи заявки Рефералом</th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Дата совершенной операции Рефералом</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'confirmed_at', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'confirmed_at', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Сумма (UAH) совершенной операции Рефералом</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'uah', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'uah', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Реферальное вознаграждение (%)</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'ref', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'ref', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center"><a href="#" class="sort">Реферальное вознаграждение (UAH)</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($operations as $operation)
                    <tr class="border-bottom">
                        <td scope="col" class="p-2" align="center"><a href="{{route('admin.users.edit', $operation->user_id)}}">{{$operation->login}}</a></td>
                        <td scope="col"></td>
                        <td scope="col" class="p-2" align="center">{{spaceToUnderscore($operation->created_at)}}</td>
                        <td scope="col"></td>
                        <td scope="col" class="p-2" align="center"><a href="{{route('admin.operations.edit', $operation->id)}}">{{spaceToUnderscore($operation->confirmed_at)}}</a></td>
                        <td scope="col"></td>
                        <td scope="col"
                            class="p-2" align="center">{{$operation->uah}}</td>
                        <td scope="col"></td>
                        <td scope="col" class="p-2" align="center">{{$operation->ref ?? '0'}}</td>
                        <td scope="col"></td>
                        <td scope="col" class="p-2" align="center">{{$operation->ref_balance ??'0'}}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-sm-between justify-content-center pb-5 mx-2 flex-wrap">
                <div class="d-flex align-items-center mb-2">
                    <span>Показано от 1 до {{$operations->count()}} из {{$operations->total()}} записей</span>
                </div>
                {{$operations->links()}}
            </div>
        </div>



    </div>

    @endsection