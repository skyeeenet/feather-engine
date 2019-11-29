@section('breadcrumb')
  <nav aria-label="breadcrumb" class="roboto16lt">
    <ol class="breadcrumb breadcrumb-dot bg-color my-2">
      <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.pages')}}">Страницы</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$page->id}}</li>
    </ol>
  </nav>
@endsection
@section('title', 'Редактирование Страницы')
@extends('layouts.admin.admin-layout')

@section('content')

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="mt-5 d-flex align-items-center">
    <i class="fa fa-user fa-4x"></i>
    <span class="users_text mx-3">Редактирование Страницы - <span>{{$page->name}}</span></span>
  </div>

  @include('admin.includes.tabs.tabsButtons', ['languages' => ['RU', 'UA']])

  <form method="post" class="mt-4" action="{{route('admin.pages.update', $page->id)}}">
    @csrf
    <div class="row">
      <div class="col bg-white shadow roboto16lt form-color mx-3">

        <div class="my-3">
          @include('admin.includes.fields.select', ['label_name' => 'Шаблон', 'name' => 'template_id', 'key'=> 'id', 'public_key' => 'template', 'options' => [['id' => 1, 'template' => 'Шаблон страницы информации']]])
        </div>

        <div class="my-3">
          @include('admin.includes.fields.input', ['label_name' => 'Название', 'required' => true, 'type' => 'text', 'name' => 'name', 'value' => $page->name])
        </div>


        <div id="RU" class="tabcontent">
          {{-- RU --}}
          <div class="my-3">
            @include('admin.includes.fields.input', ['label_name' => 'Seo H1 RU', 'required' => true, 'type' => 'text', 'name' => 'seo_h1', 'value' => $page->seo_h1])
          </div>

          <div class="my-3">
            @include('admin.includes.fields.input', ['label_name' => 'Seo Title RU', 'required' => true, 'type' => 'text', 'name' => 'seo_title', 'value' => $page->seo_title])
          </div>

          <div class="my-3">
            @include('admin.includes.fields.input', ['label_name' => 'Seo Description RU', 'required' => true, 'type' => 'text', 'name' => 'seo_description', 'value' => $page->seo_description])
          </div>

          <div class="my-3">
            @include('admin.includes.fields.textarea', ['label_name' => 'Content RU', 'name' => 'content', 'value' => $page->content])
          </div>
        </div>

        <div id="UA" class="tabcontent">

          <div class="my-3">
            <label for="name" class="d-block">
              Seo H1 UA
            </label>
            <input required type="text" name="seo_h1_ua" value="{{$page->seo_h1_ua}}" class="w-100 input_fields"
                   placeholder="">
          </div>

          <div class="my-3">
            <label for="name" class="d-block">
              Seo Title UA
            </label>
            <input required type="text" name="seo_title_ua" class="w-100 input_fields" value="{{$page->seo_title_ua}}">
          </div>

          <div class="my-3">
            <label for="name" class="d-block">
              Seo Description UA
            </label>
            <input required type="text" name="seo_description_ua" class="w-100 input_fields"
                   value="{{$page->seo_description_ua}}">
          </div>

          <div class="my-3">
            <label for="">Content UA</label>
            <textarea name="content_ua" class="body">{{$page->content_ua}}</textarea>
          </div>

        </div>


        <div class="my-3">
          <label for="name" class="d-block">
            Seo Url
          </label>
          <input required type="text" name="slug" class="w-100 input_fields" value="{{$page->slug}}">
        </div>

        <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
          @include('admin.includes.buttons.updateButton')
        </div>
      </div>
    </div>
  </form>
@endsection

@section('scripts')
  <link rel="stylesheet" href="/css/summernote.css">
  <script src="{{URL::asset('js/summernote.min.js')}}"></script>
  <script src="{{URL::asset('js/admin/tabs.js')}}"></script>
  <script>
    $('.body').summernote({
      height: 150,   //set editable area's height
    });
  </script>
@endsection