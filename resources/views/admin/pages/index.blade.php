@section('breadcrumb')
  <nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
      <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
      <li class="breadcrumb-item active" aria-current="page">Страницы</li>
    </ol>
  </nav>
@endsection
@section('title', 'Страницы')
@extends('layouts.admin.admin-layout')
@section('content')

    <div class="roboto16">

      <div class="mt-5 d-flex align-items-center justify-content-center justify-content-sm-start flex-wrap">
        <i class="fas fa-file-alt fa-4x ml-2 ml-sm-0"></i>
        <span class="users_text mx-3">Страницы</span>
        <a href="{{route('admin.pages.create')}}" class="btn btn-success mx-2 my-1"><i
                  class="fa fa-plus-circle mr-1"></i>Добавить</a>

      </div>
    </div>
    <div class="bg-white shadow d-block mb-5 roboto14">
      <div class="d-flex justify-content-between my-4 pt-4 flex-wrap mx-5">
      </div>

      <div class="table-responsive-xl">
        <table class="table">
          <thead class="bg-gray">
          <tr class="border-bottom">

            <th scope="col" class="pt-2 pl-2 pb-2 pr-0 text-center"><a class="sort" href="#">Имя</a></th>
            <th scope="col" class="pt-2 pr-0 pb-2 pl-2 text-center"><a class="sort" href="#">Шаблон</a></th>
            <th scope="col" class="p-2 text-center">Доступные действия</th>
          </tr>
          </thead>
          <tbody>
          @foreach($pages as $item)
            <tr class="border-bottom">

              <td scope="col" class="p-2" align="center">{{$item->name ?? ''}}</td>
              <td scope="col" class="p-2" align="center">{{$item->template->name ?? ''}}</td>
              <td scope="col" class="p-2">
                <div class=" d-flex flex-column align-items-center">
                  <form action="{{route('admin.pages.destroy', $item->id)}}" method="post">
                    @csrf
                    <button type="submit" class="btn  btn-danger my-1">
                      <div class="d-flex align-items-center"><i class="fa fa-trash-o  mr-1"></i>Удалить
                      </div>
                    </button>
                  </form>
                  <a href="{{route('admin.pages.edit', $item->id)}}" class="btn btn-primary my-1">
                    <div class="d-flex align-items-center"><i class="fa fa-edit mr-1"></i>Изменить
                    </div>
                  </a>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-4 d-flex justify-content-sm-between justify-content-center pb-5 mx-2 flex-wrap">
        <div class="d-flex align-items-center mb-2">
          <span>Показано от 1 до {{$pages->count()}} из {{$pages->total()}} записей</span>
        </div>
        {{$pages->links()}}
      </div>
    </div>
  <a href="">
@endsection