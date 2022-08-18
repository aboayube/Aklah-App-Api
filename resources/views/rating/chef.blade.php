{{$order->chef->name}}

<form action="{{route('orders.ratechef.post')}}" method="post">
    @csrf
    <input type="hidden" name="wasfa_id" value="{{$order->wasfa->id}}">
    <input type="hidden" name="chef_id" value="{{$order->chef->id}}">
    <input type="number" name="rating">
    <input type="text" name="note">
    <button>save</button>
</form>