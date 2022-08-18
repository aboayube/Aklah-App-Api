@foreach ($wasfas as $wasfa)
{{$wasfa->name}}
{{$wasfa->discription}}
{{$wasfa->image}}
{{$wasfa->price}}
{{$wasfa->time_make}}
{{$wasfa->number_user}}
{{$wasfa->user->name}}
{{$wasfa->category->name}}

<a href="{{route('wasfas.show',$wasfa->id)}}">send</a>
@endforeach