@foreach($wasfas as $wasfa)countity
{{$wasfa->wasfa->name}}
{{$wasfa->countity}}
{{$wasfa->wasfa->price}}
{{$wasfa->created_at}}
<button>number</button>
<a href="{{route('card.delete',$wasfa->id)}}">delete</a>
<a href="">buy</a>
<br>
<br>
<br>
<br>
@endforeach

طريقة التوصيل
<input type="radio" name="self_delivery" value="1">استلم بنفسك
<input type="radio" name="self_delivery" value="0">ديلفري
12
<form action="{{route('card.payment')}}" method="post">
    @csrf
    <input type="hidden" name="price" value="12">
    <button>pay</button>

</form>