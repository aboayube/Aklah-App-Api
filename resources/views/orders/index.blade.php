orderspendeing




orderpayment
@foreach ($orderpayment as $pendeing )
{{$pendeing->wasfa->name}}
{{$pendeing->user->name}}
قيد الانتظار
@endforeach<br><br><br><br><br><br>
ordercacncle

@foreach ($ordercacncle as $cancle)
{{$cancle->wasfa->name}}
{{$cancle->user->name}}
ملغي
@endforeach<br><br><br><br><br><br>
orderend

@foreach ($orderend as $order)
<form action="{{route('orders.ratewasfa')}}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{$order->id}}">
    <button>تقييم طبيخ</button>
</form>
<form action="{{route('orders.ratechef')}}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{$order->id}}">
    <button>تقييم الطباخ</button>
</form>
@endforeach<br><br><br><br>
orderfinish


@foreach ($orderfinish as $order)

@endforeach