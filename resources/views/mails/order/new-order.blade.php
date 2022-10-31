@foreach($data as $key => $val)
    {{ $key }} {{ $val }} <br>
@endforeach
<a href="{{ env("APP_URL") }}/order/prestation-accepted/{{ $data['order_id'] }}">Accepter la prestation</a>
