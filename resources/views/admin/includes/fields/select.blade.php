<label for="">
  {{$label_name}}
</label>
<select class="form-control" name="{{$name}}">
  @foreach ($options as $option)
    <option value="{{$option[$key]}}">{{$option[$public_key]}}</option>
  @endforeach
</select>