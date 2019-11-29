@extends('layouts.public.public-layout')

@section('title', $title ?? $category->name . ' - ' . \App\Settings::getValue('TITLE'))

@section('description', $description ?? '')

@section('content')
  <main class="wrap">
    <div class="content">

      @if(count($posts) == 0)
        <div style="width: 800px;" class="d-flex justify-center">
          <h2>{{__('home.not_found')}}</h2>
        </div>
      @endif

      @foreach($posts as $post)
        <div class="item">
          <div class="item_menu"><span></span>
            <span></span>
            <span></span></div>
          <div class="post-menu">
            <ul>
              <li><a href="https://www.facebook.com/sharer.php?u={{URL::to('/').'/post/'.$post->slug}}">Поделиться</a></li>
              <li><a href="{{route('public.posts.show', $post->slug)}}">{{__('home.add_btn')}}</a></li>
              <li><a href="{{route('public.posts.show', $post->slug)}}">{{__('home.post_btn')}}</a></li>
              <li><a href="#" class="complain">{{__('home.complain')}}</a></li>
            </ul>
          </div>
          <div class="item_right">
            <img src="{{$post->image}}" alt="">
            <div class="date"><span>{{$post->created_at}}</span><span>{{$post->user['login']}}</span></div>
          </div>
          <div class="item_left">
            <h3>{{$post->seo_h1}}</h3>
            <p>{{$post->short}}</p>
            <div class="item_btn_wrap">
              <button class="review-button" data-id="{{$post->id}}">{{__('home.comment_btn')}} {{count($post->reviews()->published()->get())}}</button>
              <button><a href="{{route('public.posts.create')}}">{{__('home.add_more_info')}}</a></button>
              <button><a href="{{route('public.posts.show', $post->slug)}}">{{__('home.post_btn')}}</a></button>
              <button id="subscribe-btn" data-post="{{$post->id}}">{{__('home.subscribe_btn')}}</button>
            </div>
          </div>
        </div>
        <div class="item-reviews" id="{{$post->id}}">
          <h4>{{__('post.reviews')}}</h4>
          <form class="mt-4 d-flex flex-column" action="{{route('public.reviews.store')}}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <textarea name="content" id="" cols="30" rows="5"></textarea>
            <button class="mt-3 classic-btn" type="submit">{{__('post.add_review_btn')}}</button>
          </form>
          <div id="reviews">
            @foreach($post->reviews()->published()->get() as $review)
              <div class="mt-3">
                <b>{{$review->user['login']}}</b>
                <p>{{$review->content}}</p>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach

      {{$posts->links()}}

    </div>
    <div class="aside">
      <h4>{{ __('home.sidebar_title')  }}</h4>
      @foreach($blackListItems as $blackList)
        <a href="{{$blackList->url ?? ''}}">{{$blackList->name}}</a>
      @endforeach
      <div>
        {{$blackListItems->links()}}
      </div>
    </div>
  </main>
@endsection

@section('scripts')
  <script>
    $(function() {
      $('.item_menu').click(function() {

        $(this).find(' + .post-menu').fadeToggle();
      });
    });
  </script>

  <script>
    $(function() {
      $('.review-button').click(function() {

        $('#' + $(this).data('id')).fadeToggle();
      });
    })
  </script>
@endsection