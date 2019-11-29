<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('description')">
  <link rel="stylesheet" href="/css/public.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
<header>
  <div class="wrap">
    <a href="/" class="logo"><img src="{{\App\Settings::getValue('LOGO')}}" alt=""></a>
    <h2>{{\App\Settings::getValue('header_text')}}</h2>

        <div class="header-items">

          @if (!Auth::user())
            <a href="/login" class="enter"><i class="fa fa-user" aria-hidden="true"></i>
              @else
                <a href="#" class="enter"><i class="fa fa-user" aria-hidden="true"></i>
                  @endif
                  @if (Auth::user())
                    <div class="account">
                      <p>{{__('auth.welcome')}}<br> {{Auth::user()->login}}</p>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="dropdown-item">{{__('auth.logout')}}</button>
                      </form>
                    </div>
                  @endif
                </a>
          <button class="mob"><span></span></button>

          <div class="lang">
            <a href="/setlocale/ua">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 200">
                <g fill="#0976e6" fill-opacity=".98485">
                  <path d="m0 100h340v100h-340z"/>
                  <path d="m0 0h340v100h-340z"/>
                </g>
                <g transform="matrix(1 0 0 .50479 0 99.042)" fill="#fefd03">
                  <path d="m0 100h340v100h-340z"/>
                  <path d="m0 0h340v100h-340z"/>
                </g>
              </svg>
            </a>
            <a href="/setlocale/ru">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1062.99 708.661">
                <path d="m0 0h1063v708.66h-1063z" fill="#fff" fill-rule="evenodd"/>
                <path d="m0 236.22h1063v472.44h-1063z" fill="#01017e" fill-rule="evenodd"/>
                <path d="m0 472.44h1063v236.22h-1063z" fill="#fe0101" fill-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>



          @if (!Auth::user())
            <div class="login-form">
              <div class="container">
                <input type="radio" name="tab" id="signin" checked="checked"/>
                <input type="radio" name="tab" id="register"/>
                <div class="pages">

                  <div class="page">
                    <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="input">
                        <div class="title">{{ __('E-Mail Address') }}</div>
                        <input class="text" name="email" type="email" placeholder=""/>
                      </div>
                      <div class="input">
                        <div class="title">{{__('Password')}}</div>
                        <input class="text" name="password" type="password" placeholder=""/>
                      </div>
                      <div class="input">
                        <input type="submit" value="{{__('Login')}}"/>
                      </div>
                    </form>
                  </div>

                  <div class="page signup">
                    <form method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="input">
                        <div class="title">{{__('auth.register_name')}}</div>
                        <input required class="text" type="text" name="login" placeholder=""/>
                      </div>
                      <div class="input">
                        <div class="title">{{__('auth.register_email')}}</div>
                        <input required class="text" name="email" type="email" placeholder=""/>
                      </div>
                      <div class="input">
                        <div class="title">{{__('auth.password')}}</div>
                        <input required class="text" name="password" type="password" placeholder=""/>
                      </div>
                      <div class="input">
                        <div class="title">{{__('auth.password_confirm')}}</div>
                        <input required class="text" name="password_confirmation" type="password" placeholder=""/>
                      </div>
                      <div class="input">
                        <input type="submit" value="SIGN ME UP!"/>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="tabs">
                  <label class="tab" for="signin">
                    <div class="text">{{__('auth.login')}}</div>
                  </label>
                  <label class="tab" for="register">
                    <div class="text">{{__('auth.register')}}</div>
                  </label>
                </div>
              </div>
            </div>
    @endif

  </div>
</header>
<nav>
  <div class="wrap">
    <ul class="nav">
      @foreach(\App\Category::orderBy('sort')->get() as $category)
        @if (Session::get('locale') == 'ru')
          <li><a href="{{route('public.categories.show', $category->slug)}}">{{$category->name}}</a></li>
        @else
          <li><a href="{{route('public.categories.show', $category->slug)}}">{{$category->name_ua}}</a></li>
        @endif
      @endforeach
    </ul>

    <div class="search">
      <div class="btn-add-info-container">
        <button class="btn-add-info"><a href="{{route('public.posts.create')}}">{{ __('home.add_info')  }}</a></button>
      </div>
      <form class="search_form" action="{{route('public.search.show')}}" method="get">
        <div class="input-wrapper" data-text="">
          <input type="text" name="search" placeholder="{{ __('home.search') }}...">
          <button class="go-btn" type="submit">{{__('home.btn_search')}}</button>
        </div>
      </form>
    </div>

  </div>
</nav>

@yield('content')

<footer>
  <div class="wrap">
    <nav>
      <ul class="menu">
        @foreach(\App\Page::all() as $page)
          @if (Session::get('locale') == 'ru')
            <li><a href="{{route('public.pages.show', $page->slug)}}">{{$page->seo_h1}}</a></li>
          @else
            <li><a href="{{route('public.pages.show', $page->slug)}}">{{$page->seo_h1_ua}}</a></li>
          @endif
        @endforeach
      </ul>
    </nav>
    <div class="copy">
      {{ __('home.copy')  }}
    </div>
  </div>

</footer>

<div class="hide-background"></div>

<div class="subscribe-form">
  <section id="subscribe" class="container">
    <section class="one">
      <div class="logo">
        <img src="https://image.flaticon.com/icons/svg/143/143361.svg">
      </div>
      <h2 class="heading">
        {{__('home.subscribe_title')}}
      </h2>
      <p> {{__('home.subscribe_sub_title')}}
      </p>
      <form>
        <input type='email' required id="email-input" placeholder="{{__('home.email_text')}}"><br/>
        <button class="btn mt-3" role="button">
          {{__('home.subscribe_btn_form')}}
        </button>
      </form>
    </section>
    <section class="two">
      <h3>
        {{__('home.subscribe_thanks')}}
      </h3>
      <div class="close">
      </div>
    </section>
  </section>
</div>
<!-- feedback -->
<div class="bg-cover"></div>
<div class="feedback">
  <div class="container-feedback">
    <form id="contact" action="{{route('public.feedback.store')}}" method="post">
      @csrf
      <h3>{{__('home.feedback_title')}}</h3>

      <fieldset>
        <input placeholder="{{__('home.feedback_name')}}" type="text" tabindex="1" name="name" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="{{__('home.feedback_email')}}" type="email" tabindex="2" name="email" required>
      </fieldset>
      <fieldset>
        <input placeholder="{{__('home.feedback_phone')}}" name="phone" type="tel" tabindex="3" required>
      </fieldset>
      <fieldset>
        <input placeholder="{{__('home.feedback_subject')}}" name="subject" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <textarea placeholder="{{__('home.feedback_message')}}" name="message" tabindex="5" required></textarea>
      </fieldset>
      <fieldset>
        <button type="submit" id="contact-submit" data-submit="...Sending">{{__('home.feedback_send')}}</button>
      </fieldset>
    </form>
  </div>
</div>

<!-- https://developers.google.com/speed/libraries/  actual version -->
<script>
  $(document).ready(function () {
    $('.mob').on('click', function () {
      $('.mob span').toggleClass('active');
    });
  }); // end ready
</script>

<script>
  $(function () {
    const wrapper = document.querySelector(".input-wrapper"),
        textInput = document.querySelector(".input-wrapper input[type='text']");

    console.log(textInput);

    textInput.addEventListener("keyup", event => {
      wrapper.setAttribute("data-text", event.target.value);
    });
  });
</script>

<script>
  // форма подписки
  $('#subscribe-btn').click(function () {

    $('.subscribe-form').fadeIn();
    $('html').css('overflow', 'hidden');
    $('.hide-background').show();

    $('.one form .btn').data('post', $(this).data('post'));
  });

  $('.hide-background').click(function () {

    $('.subscribe-form').fadeOut();
    $('html').css('overflow', 'visible');
    $('.hide-background').hide();
  });
</script>

<script>
  //отправка данных их формы подписки
  $(function () {

    $('.one form .btn').on('click', function () {

      $.ajax({
        type: 'POST',
        url: '/api/subscribe',
        data: {
          post_id: $(this).data('post'),
          email: $('#email-input').val(),
        },
        success: function (result) {

          console.log(result);
        },
        error: function (result) {

          console.log(result);
        },
      });

      $(this).parents('.one').animate({
        top: '-500px'
      }, 500);

      $(this).parents('.one').siblings('.two').animate({
        top: '0px'
      }, 500);
      return false;
    });

    $('.two .close').on('click', function () {
      $(this).parent().animate({
        top: '-500px'
      }, 500);

      $(this).parent().siblings('.one').animate({
        top: '0px'
      }, 500);
      return false;
    });
  });
</script>

<script>
  var signin = document.querySelector('#signin')
  var register = document.querySelector('#register')
</script>

<script>
  $('.mob').click(function () {

    $('.login-form').fadeToggle();
  });
</script>

<script>
  $(document).ready(() => {
    let $button = $('button[type="submit"]');

    $button.on('click', function () {
      var $this = $(this);
      if ($this.hasClass('active') || $this.hasClass('success')) {
        return false;
      }
      $this.addClass('active');
      setTimeout(() => {
        $this.addClass('loader');
      }, 125);
      setTimeout(() => {
        $this.removeClass('loader active');
        $this.text('Success');
        $this.addClass('success animated pulse');
      }, 1600);
      setTimeout(() => {
        $this.text('Go');
        $this.removeClass('success animated pulse');
        $this.blur();
      }, 2900);
    });
  });
</script>
<script>
  $(function () {
    $('.complain').click(function () {
      $('.bg-cover').show();
      $('body').css('overflow', 'hidden');
      $('.feedback').show();
    });

    $('.bg-cover').click(function () {
      $(this).hide();
      $('body').css('overflow', 'visible');
      $('.feedback').hide();
    });
  })
</script>
@yield('scripts')

</body>
</html>