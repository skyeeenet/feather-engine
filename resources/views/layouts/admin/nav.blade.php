<nav class="navbar navbar-expand-lg navbar-dark p-0 bg-dark">
    <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="sidenav" id="navAccordion">
            <ul class="colum_menu navbar-nav d-block">
                <li class="bg-primary" id="expand"><div class="d-flex justify-content-center"><i class="fa fa-align-justify" aria-hidden="true"></i></div><a href="#" class="roboto22bl"> Skye Pages</a></li>
                <li><a href="{{route('admin.dashboard')}}" class="nav-lnk d-flex align-items-center w-100"> <div class="d-flex justify-content-center"><i class="fa fa-home" aria-hidden="true"></i></div>На главную</a></li>
                <li><a href="{{route('admin.users')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-user" aria-hidden="true"></i></div>Пользователи</a></li>
                <li><a href="{{route('admin.blockedUsers')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-user-lock" aria-hidden="true"></i></div>Заблокированные Пользователи</a></li>
                <li><a href="{{route('admin.reviews')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-comments"></i></div>Комментарии</a></li>
                <li><a href="{{route('admin.categories')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-palette" aria-hidden="true"></i></div>Категории</a></li>
                <li><a href="{{route('admin.pages')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-user-lock" aria-hidden="true"></i></div>Страницы</a></li>
                <li><a href="{{route('admin.posts')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-pen-alt"></i></div>Записи</a></li>
                <li><a href="{{route('admin.templates')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-palette" aria-hidden="true"></i></div>Шаблоны</a></li>
                <li><a href="{{route('admin.blackList')}}" class="nav-lnk d-flex align-items-center w-100"> <div class="d-flex justify-content-center"><i class="fas fa-user-tag"></i></div>Черный список</a></li>
                <li><a href="{{route('admin.feedback')}}" class="nav-lnk d-flex align-items-center w-100"> <div class="d-flex justify-content-center"><i class="fas fa-user-tag"></i></div>Обратная связь</a></li>
                <li><a href="{{route('admin.languages')}}" class="nav-lnk d-flex align-items-center w-100"> <div class="d-flex justify-content-center"><i class="fas fa-user-tag"></i></div>Языки</a></li>
                <li><a href="{{route('admin.settings')}}" class="nav-lnk d-flex align-items-center w-100"><div class="d-flex justify-content-center"><i class="fas fa-cog" aria-hidden="true"></i></div>Настройки</a></li>
            </ul>
        </div>
    </div>
</nav>