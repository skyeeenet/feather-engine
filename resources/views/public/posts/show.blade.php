@extends('layouts.public.public-layout')

@section('title', $post->seo_title ?? $post->seo_h1 . ' - ' . \App\Settings::getValue('TITLE'))

@section('description', $post->seo_description ?? \App\Settings::getValue('DESCRIPTION'))

@section('content')

  <main class="wrap">
    <div class="content">
      <div class="single-item">

        <h1>{{$post->seo_h1}}</h1>

        <img src="{{$post->image}}" alt="">
        <div class="date date-single"><span>{{$post->created_at}}</span><span>{{$post->user['login']}}</span></div>


        <div class="">
          <div class="item_btn_wrap item_btn_wrap-single">
            <button>{{__('home.comment_btn')}} {{$reviews_count}}</button>
            <button><a href="{{route('public.posts.show', $post->slug)}}">{{__('home.add_btn')}}</a></button>
            <button>{{__('home.post_btn')}}</button>
            <button id="subscribe-btn" data-post="{{$post->id}}">{{__('home.subscribe_btn')}}</button>
          </div>

          <div>
            {!! $post->content !!}
          </div>

        </div>

        <div class="mt-4 d-flex flex-column align-center">
          <h4>{{__('post.add_review')}}</h4>
          <form class="mt-4 d-flex flex-column" action="{{route('public.reviews.store')}}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <textarea name="content" id="" cols="30" rows="5"></textarea>
            <button class="mt-3 classic-btn" type="submit">{{__('post.add_review_btn')}}</button>
          </form>
        </div>

        <div class="mt-4">
          <h4>{{__('post.reviews')}}</h4>
          <div id="reviews">
            @foreach($reviews as $review)
              <div class="mt-3">
                <b>{{$review->user['login']}}</b>
                <p>{{$review->content}}</p>
              </div>
            @endforeach
          </div>
          <button class="classic-btn mt-4" id="btn-review-more" data-href="/api/reviews/{{$post->id}}">{{__('post.more_review_btn')}}</button>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('scripts')
  <script>
    $(function () {
      $('#btn-review-more').click(function() {

        $.ajax({
          'type': 'GET',
          'url': $('#btn-review-more').data('href'),
          success: function (result) {

            const reviews = result.content;

            reviews.forEach(function (item) {

              $('#reviews').append('<div class="mt-3">' + '<b>' + item.login + '</b>' + '<p>' + item.content + '</p>' + '</div>')
            });

            $('#btn-review-more').hide();
          }
        })
      });
    });
  </script>
@endsection