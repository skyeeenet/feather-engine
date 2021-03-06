@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.categories')}}">Категории</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
        </ol>
    </nav>
@endsection
@section('title', 'Редактирование Категории')
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
        <span class="users_text mx-3">Редактирование Категории</span>
    </div>
    <form method="post" class="mt-4" action="{{route('admin.categories.update', $category->id)}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                    <label for="name" class="d-block">
                        Название
                    </label>
                    <input required type="text" id="name" name="name" class="w-100 input_fields" value="{{$category->name}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Название UA
                    </label>
                    <input required type="text" id="name" name="name_ua" class="w-100 input_fields" value="{{$category->name_ua}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Seo Url
                    </label>
                    <input required id="slug" type="text" name="slug" class="w-100 input_fields" value="{{$category->slug}}">
                </div>

                <div class="my-3">
                    <label for="name" class="d-block">
                        Порядок сортировки
                    </label>
                    <input required type="text" name="sort" value="{{$category->sort}}" class="w-100 input_fields">
                </div>

                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Обновить</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>

        function urlRusLat(str) {
            str = str.toLowerCase(); // все в нижний регистр
            var cyr2latChars = new Array(
                    ['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
                    ['д', 'd'],  ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
                    ['и', 'i'], ['й', 'y'], ['к', 'k'], ['л', 'l'],
                    ['м', 'm'],  ['н', 'n'], ['о', 'o'], ['п', 'p'],  ['р', 'r'],
                    ['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
                    ['х', 'h'],  ['ц', 'c'], ['ч', 'ch'],['ш', 'sh'], ['щ', 'shch'],
                    ['ъ', ''],  ['ы', 'y'], ['ь', ''],  ['э', 'e'], ['ю', 'yu'], ['я', 'ya'],

                    ['А', 'A'], ['Б', 'B'],  ['В', 'V'], ['Г', 'G'],
                    ['Д', 'D'], ['Е', 'E'], ['Ё', 'YO'],  ['Ж', 'ZH'], ['З', 'Z'],
                    ['И', 'I'], ['Й', 'Y'],  ['К', 'K'], ['Л', 'L'],
                    ['М', 'M'], ['Н', 'N'], ['О', 'O'],  ['П', 'P'],  ['Р', 'R'],
                    ['С', 'S'], ['Т', 'T'],  ['У', 'U'], ['Ф', 'F'],
                    ['Х', 'H'], ['Ц', 'C'], ['Ч', 'CH'], ['Ш', 'SH'], ['Щ', 'SHCH'],
                    ['Ъ', ''],  ['Ы', 'Y'],
                    ['Ь', ''],
                    ['Э', 'E'],
                    ['Ю', 'YU'],
                    ['Я', 'YA'],

                    ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
                    ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
                    ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
                    ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
                    ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
                    ['z', 'z'],

                    ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'],['E', 'E'],
                    ['F', 'F'],['G', 'G'],['H', 'H'],['I', 'I'],['J', 'J'],['K', 'K'],
                    ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'],['P', 'P'],
                    ['Q', 'Q'],['R', 'R'],['S', 'S'],['T', 'T'],['U', 'U'],['V', 'V'],
                    ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],

                    [' ', '_'],['0', '0'],['1', '1'],['2', '2'],['3', '3'],
                    ['4', '4'],['5', '5'],['6', '6'],['7', '7'],['8', '8'],['9', '9'],
                    ['-', '-']

            );

            var newStr = new String();

            for (var i = 0; i < str.length; i++) {

                ch = str.charAt(i);
                var newCh = '';

                for (var j = 0; j < cyr2latChars.length; j++) {
                    if (ch == cyr2latChars[j][0]) {
                        newCh = cyr2latChars[j][1];

                    }
                }
                // Если найдено совпадение, то добавляется соответствие, если нет - пустая строка
                newStr += newCh;

            }
            // Удаляем повторяющие знаки - Именно на них заменяются пробелы.
            // Так же удаляем символы перевода строки, но это наверное уже лишнее
            return newStr.replace(/[_]{2,}/gim, '_').replace(/\n/gim, '');
        }

        $(function() {
            $('#name').keyup(function () {

                $('#slug').val(urlRusLat($(this).val()));
            })
        });
    </script>
@endsection