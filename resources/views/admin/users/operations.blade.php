@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Операции</li>
        </ol>
    </nav>
@endsection
@section('title')
Операции пользователя {{$user->login}}
@endsection

@extends('layouts.admin.admin-layout')
@section('content')

    <div class="roboto16">
        <div class="mt-4 d-block">
            <div class="mt-5 mb-3 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
                <i class="fa fa-user fa-4x ml-2 ml-sm-0"></i>
                <span class="users_text ml-3">Операции Пользователя <a href="{{route('admin.users.edit', $user->id)}}">{{$user->login}}</a></span>
            </div>
            <p>Успешно совершенные операции (количество):&nbsp;<b>{{$operations_count}}</b></p>
            <p>Успешно совершенные операции (суммарный объем в UAH):&nbsp;<b>{{$balance}}</b></p>
            <p>Партнерская скидка (суммарно начислено в UAH):&nbsp;<b>200</b></p>
            <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['exel' => '1'])) }}">Выгрузка данных в Excel</a>
        </div>

    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
        <div class="container-fluid">
            <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
                @include('layouts.admin.amount')
                <div class="d-flex align-items-center roboto16">
                    <form name="search" method="GET" class="m-0" {{ action('Admin\Users\UserController@operations', $user->id) }}>
                        <span class="mr-2">Поиск:</span>
                        <input class="custom-input" type="text" size="25" name="search">
                    </form>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table class="table">
                    <thead class="bg-gray">
                    <tr class="border-bottom">
                        <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Дата подачи заявки</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'created_at', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Дата совершенной операции</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'confirmed_at', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'confirmed_at', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Сумма совершенной операции (UAH)</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'uah', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'uah', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Партнерская скидка (%)</a></th>
                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'discount', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'discount', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a href="#" class="sort">Партнерская скидка (UAH)</a></th>

                        <th scope="col" class="pt-2 pb-2 pr-2 pl-0 align-text-top"><div class="d-flex flex-column"><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'discount_balance', 'sort'=>'asc'])) }}" class="text-dark"><i class="fas fa-sort-up fa-lg"></i></a><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['field' => 'discount_balance', 'sort'=>'desc'])) }}" class="text-dark"><i class="fas fa-sort-down fa-lg"></i></a></div></th>
                        <th scope="col" class="p-2 text-center">Доступные действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($operations as $operation)
                        <tr class="border-bottom">
                            <td scope="col" class="p-2" align="center">{{spaceToUnderscore($operation->created_at)}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center"><a href="{{route('admin.operations.edit', $operation->id)}}">{{spaceToUnderscore($operation->confirmed_at) ?? 'Не подтверждена'}}</a></td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{toNormalNumber($operation->uah)}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{$operation->discount?? '0'}}</td>
                            <td scope="col"></td>
                            <td scope="col" class="p-2" align="center">{{toNormalNumber($operation->discount_balance)?? '0'}}</td>
                            <td scope="col"></td>
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
                    <span>Показано от 1 до {{$operations->count()}} из {{$operations->total()}} записей</span>
                </div>
               {{$operations->links()}}
            </div>
        </div>



    </div>
@endsection