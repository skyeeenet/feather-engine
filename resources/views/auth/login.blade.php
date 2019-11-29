@section('title', 'Вход')
@extends('layouts.app')

@section('content')
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
@endsection
