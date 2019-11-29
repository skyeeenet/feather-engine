@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Обратная связь</li>
        </ol>
    </nav>
@endsection
@section('title', 'Обратная связь')
@extends('layouts.admin.admin-layout')
@section('content')

    <div class="roboto16">

        <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
            <i class="fas fa-pen-alt fa-4x ml-2 ml-sm-0"></i>
            <span class="users_text mx-3">Обратная связь</span>
        </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
        <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
            <div class="d-flex align-items-center">

            </div>
        </div>

        <div class="table-responsive-xl">
            <table class="table">
                <thead class="bg-gray">
                <tr class="border-bottom">
                    <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Имя</a></th>
                    <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Email</a></th>
                    <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Телефон</a></th>
                    <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Тема</a></th>
                    <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Сообщение</a></th>
                    <th scope="col" class="p-2 text-center">Доступные действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($feedback as $item)
                    <tr class="border-bottom">

                        <td scope="col" class="p-2" align="center">{{$item->name}}</td>
                        <td scope="col" class="p-2" align="center">{{$item->email}}</td>
                        <td scope="col" class="p-2" align="center">{{$item->phone}}</td>
                        <td scope="col" class="p-2" align="center">{{$item->subject}}</td>
                        <td scope="col" class="p-2" align="center">{{$item->message}}</td>
                        <td scope="col" class="p-2">
                            <div class=" d-flex flex-column align-items-center">
                              <form action="{{route('admin.feedback.destroy', $item->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn  btn-danger my-1"><div class="d-flex align-items-center"><i class="fa fa-trash-o  mr-1"></i>Удалить
                                  </div></button>
                              </form>
                                <a href="{{route('admin.feedback.edit', $item->id)}}" class="btn btn-primary my-1"><div class="d-flex align-items-center"><i class="fa fa-edit mr-1"></i>Изменить
                                    </div></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 d-flex justify-content-sm-between justify-content-center pb-5 mx-2 flex-wrap">
            {{$feedback->links()}}
        </div>
    </div>

    <a href="">
@endsection