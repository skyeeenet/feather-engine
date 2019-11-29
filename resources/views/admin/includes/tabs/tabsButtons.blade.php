<div class="tab mt-3">
  @foreach ($languages as $lang)
    <button class="tablinks" onclick="openCity(event, {{$lang->key}})">{{$lang->key}}</button>
  @endforeach
</div>