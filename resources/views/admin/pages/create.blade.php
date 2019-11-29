@section('breadcrumb')
    <nav aria-label="breadcrumb" class="roboto16lt">
        <ol class="breadcrumb breadcrumb-dot bg-color my-2">
            <li class="mr-2"><i class="fas fa-tasks text-primary"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.pages')}}">Страницы</a></li>
            <li class="breadcrumb-item active" aria-current="page">Создание страницы</li>
        </ol>
    </nav>
@endsection
@section('title', 'Создание Страницы')
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
        <span class="users_text mx-3">Создание Страницы</span>
    </div>

    @include('admin.includes.tabs.tabsButtons', ['languages' => $languages])

    <form method="post" class="mt-4" action="{{route('admin.pages.store')}}">
        @csrf
        <div class="row">
            <div class="col bg-white shadow roboto16lt form-color mx-3">
                <div class="my-3">
                  @include('admin.includes.fields.select', ['label_name' => 'Шаблон', 'name' => 'template_id', 'key'=> 'id', 'public_key' => 'template', 'options' => [['id' => 1, 'template' => 'Шаблон страницы информации']]])
                </div>

                <div class="my-3">
                    @include('admin.includes.fields.input', ['label_name' => 'Название', 'required' => true, 'type' => 'text', 'name' => 'name'])
                </div>

                <div class="my-3">
                  @include('admin.includes.fields.input', ['label_name' => 'Seo Url', 'required' => true, 'type' => 'text', 'name' => 'slug'])
                </div>

                @foreach($languages as $language)
                    <div id="{{$language->key}}" class="tabcontent">
                        {{-- RU --}}
                        <div class="my-3">
                            @include('admin.includes.fields.input', ['label_name' => 'Seo H1', 'required' => true, 'type' => 'text', 'name' => 'seo_h1_'.$language->key])
                        </div>

                        <div class="my-3">
                            @include('admin.includes.fields.input', ['label_name' => 'Seo Title', 'required' => true, 'type' => 'text', 'name' => 'seo_title_'.$language->key])
                        </div>

                        <div class="my-3">
                            @include('admin.includes.fields.input', ['label_name' => 'Seo Description', 'required' => true, 'type' => 'text', 'name' => 'seo_description_'.$language->key])
                        </div>

                        <div class="my-3">
                            @include('admin.includes.fields.input', ['label_name' => 'Seo Keywords', 'required' => true, 'type' => 'text', 'name' => 'seo_keywords_'.$language->key])
                        </div>

                        <div class="my-3">
                            @include('admin.includes.fields.textarea', ['label_name' => 'Content', 'name' => 'content_'.$language->key])
                        </div>
                    </div>
                @endforeach

                <div class="d-flex mt-4 justify-content-center justify-content-sm-start mb-3">
                    <button type="submit" class="btn btn-primary px-5 py-3">Сохранить</button>
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