<label for="name" class="d-block">
  {{$label_name}}
</label>
<input @if($required) required @endif type="{{$type}}" name="{{$name}}" class="w-100 input_fields" value="{{$value ?? ''}}">