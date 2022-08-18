{{$wasfa->name}}
{{$wasfa->discription}}
{{$wasfa->image}}
{{$wasfa->price}}
{{$wasfa->time_make}}
{{$wasfa->number_user}}
{{$wasfa->user->name}}
{{$wasfa->category->name}}
<form method="POST" method="{{route('wasfas.store',$wasfa->id)}}">
    @csrf
    <input type="hidden" name="wasfa_id" value="{{$wasfa->id}}">
    <input type="number" name="countity">
    @foreach($wasfa->wasfa_content as $content)
    <input type="checkbox" value="{{$content->id}}" name="content[]">
    <img src="{{asset('assets/wasfas_content/'.$content->image)}}" width="100">

    {{$content->name}}
    {{$content->price}}
    <br><br>
    @endforeach
    <textarea name="notes">{{old('note')}}</textarea>
    <button>add</button>
</form>