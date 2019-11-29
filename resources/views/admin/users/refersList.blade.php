@section('breadcrumb')
<nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
        <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Список рефералов</li>
    </ol>
</nav>
    @endsection
@section('title', 'Список рефералов')
@extends('layouts.admin.admin-layout')
@section('content')

    <div class="roboto16">
        <div class="mt-4 d-block">
            <p>Зарегистрированные Рефералы (количество):&nbsp;<b>{{$referals->count()}}</b></p>
            <p>Успешно совершенные операции (количество):&nbsp;<b>{{$success_operations}}</b></p>
            <p>Успешно совершенные операции (суммарный объем в UAH):&nbsp;<b>{{$balance}}</b></p>
            <p>Реферальные вознаграждения (суммарно начислено в UAH):&nbsp;<b>{{$ref_balance}}</b></p>
            <p>Баланс начисленных/выплаченных вознаграждений (UAH):&nbsp;<a href="{{route('admin.users.paid.show', $user->id)}}">Выполнить переход</a></p>
            <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['exel' => '1'])) }}">Выгрузка данных в Excel</a>
        </div>
        <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
            <i class="fa fa-user fa-4x ml-2 ml-sm-0"></i>
            <span class="users_text ml-3 text-center">Список Рефералов Пользователя <a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></span>
        </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
        <div class="container-fluid">
            <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
                @include('layouts.admin.amount')
                <div class="d-flex align-items-center roboto16">
                    <form name="search" method="GET" class="m-0" action="{{ action('Admin\Users\UserController@referals',['user'=>$user->id]) }}">
                        <span class="mr-2">Поиск:</span>
                        <input class="custom-input" type="text" name="search" size="25">
                    </form>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table class="table">
                    <thead class="bg-gray">
                    <tr class="border-bottom">
                        <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Логин Реферала</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'login', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'login', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Email Реферала</th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'email', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'email', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Дата регистрации Реферала</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Суммарный объем операций (UAH)</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'balance', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'balance', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Реферальные вознаграждения (UAH)</a></th>
                        <th scope="col" class="p-2 text-center">Доступные действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($referals as $referal)
                        <tr class="border-bottom">
                            <td scope="col" class="p-2" align="center"><a href="{{route('admin.users.edit', $referal->id)}}">{{$referal->login}}</a></td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{$referal->email}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{$referal->created_at}}</td>
                            <td scope="col"></td>
                            <td scope="col"
                                class="p-2" align="center">{{$referal->balance==null?'0':$referal->balance}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{$referal->rfbalance==null?'0':$referal->rfbalance}}</td>
                            <td scope="col" class="p-2">
                                <div class=" d-flex flex-column align-items-end">
                                    <button type="button" class="btn btn-primary my-1"><div class="d-flex align-items-center"><i class="fa fa-edit mr-1"></i>Изменить
                                        </div></button>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-sm-between justify-content-center pb-5 mx-2 flex-wrap">
                <div class="d-flex align-items-center mb-2">
                    <span>Показано от 1 до {{$referals->count()}} из {{$referals->total()}} записей</span>
                </div>
                {{$referals->links()}}
            </div>
        </div>



    </div>


@endsection