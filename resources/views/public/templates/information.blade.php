@extends('layouts.public.public-layout')

@section('title', $title ?? '')

@section('description', $description ?? '')

@section('content')
  <main class="wrap">
    <div class="content d-flex flex-column w-100">

      <h1 class="mt-4 mb-4">{{$seo_h1}}</h1>

      {!! $content !!}
    </div>
  </main>
@endsection