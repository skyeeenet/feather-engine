@extends('layouts.public.public-layout')

@section('title', 'Создать публикацию')

@section('description', 'Создание публикации')

@section('content')

  <main class="wrap d-flex flex-column align-center">
    <div class="content">

      <div class="d-flex justify-center mt-4 mb-4">
        <h1>Создание поста</h1>
      </div>

      <div>
        <form method="post" enctype="multipart/form-data" class="mt-4" action="{{route('public.posts.store')}}">
          @csrf
          <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">

              <div class="my-3">
                <label for="name" class="d-block">
                  Заголовок
                </label>
                <input required type="text" name="seo_h1" value="" class="form-control" placeholder="">
              </div>

              <div class="my-3">
                <label for="name" class="d-block">
                  Изображение записи
                </label>
                <input type="file" name="image" class="form-control" value="">
              </div>

              <div class="my-3">
                <label for="name" class="d-block">
                  Выберите категорию
                </label>
                <select class="form-control" name="category_id" id="">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="my-3">
                <label for="name" class="d-block">
                  Краткое описание
                </label>
                <textarea required name="short" class="form-control"></textarea>
              </div>

              <div class="my-3">
                <textarea name="content" id="body"></textarea>
              </div>

              <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                <button type="submit" class="btn btn-primary">Сохранить</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
@endsection

@section('scripts')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/summernote.css">
  <script src="{{URL::asset('js/summernote.min.js')}}"></script>
  <script>
    $(function() {
      $('#body').summernote({
        height: 150,   //set editable area's height
      });
    })

  </script>
@endsection