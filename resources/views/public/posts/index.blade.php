@extends('layouts.public.public-layout')

@section('content')
  @foreach($posts as $post)
    <div style="display: flex; flex-direction: column; align-items: center; border-bottom: 1px solid black;">
      <img style="max-width: 300px; height: auto;" src="/storage{{$post->image}}" alt="">
      <h3><a href="{{route('public.posts.show', $post->id)}}">{{$post->name}}</a></h3>
      <p>
        {!! $post->content !!}
      </p>
      <strong>Автор: {{$post->user['login']}}</strong>
    </div>
  @endforeach
  <div>
    {{$posts->links()}}
  </div>
@endsection