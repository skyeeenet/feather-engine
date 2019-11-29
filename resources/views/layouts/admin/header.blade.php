<div class="row justify-content-sm-between justify-content-center border border-top-0 border-right-0 border-left-0 flex-wrap">
    @yield('breadcrumb')
    <div class="d-flex justify-content-sm-start justify-content-center">
        <div class="w-25 d-flex align-items-center mx-3 nav-item dropdown"><a class="nav-link dropdown-toggle"
                                                                              data-toggle="dropdown"
                                                                              href="#" role="button"
                                                                              aria-haspopup="true"
                                                                              aria-expanded="false">
                <img src="/img/avatar.png" class="d-block mw-100 rounded-circle">Admin</a>
            <div class="dropdown-menu ">
                <a class="dropdown-item" href="/">Просмотреть сайт</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item">Выход</button>
                </form>
            </div>
        </div>

    </div>
</div>
