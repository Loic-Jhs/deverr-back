@if($data['developer'])
    @foreach($data as $key => $val)
        {{ $key }} {{ $val }} <br>
    @endforeach
@else
    @foreach($data as $key => $val)
        {{ $key }} {{ $val }} <br>
    @endforeach
@endif

