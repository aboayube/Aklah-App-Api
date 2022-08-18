@extends('layouts.app')
@section('content')
<form action="{{route('admin.wasfas.update')}}" method="post" enctype="multipart/form-data" style="    direction: rtl;">
    @csrf
    <input type="hidden" class="form-control" name="id" value="{{$wasfa->id}}">
    <div class="form-group">
        <label for="exampleInputEmail1">اسم</label>
        <input type="text" class="form-control" id="" name="name" value="{{old('name',$wasfa->name)}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">اسم en</label>
        <input type="text" class="form-control" id="" name="name_en" value="{{old('name_en',$wasfa->name_en)}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"> وصف
        </label>
        <textarea class="form-control " id="" name="discription" value="">{{old('discription',$wasfa->discription)}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"> discription_en
        </label>
        <textarea class="form-control " id="" name="discription_en" value="">{{old('discription_en',$wasfa->discription_en)}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">القسم</label>
        <select name="category_id">
            @foreach ($cats as $cat)
            <option value="{{$cat->id}}" {{$cat->id==$wasfa->category_id?"selected":"null"}}>{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"> عدد المستخدمين</label>
        <input type="number" class="form-control" id="" value="{{$wasfa->number_user}}" name="number_user" value="{{old('number_user')}}">
        @error('number_user')
        <span class="text-danger help-block">{{$message}} </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">سعر</label>
        <input type="number" class="form-control" id="" name="price" value="{{old('price',$wasfa->price)}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">وقت العمل</label>
        <input type="number" class="form-control" id="" name="time_make" value="{{old('time_make',$wasfa->time_make)}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">حاله</label>
        <select name="status">
            <option value="0" {{$wasfa->status==0?"selected":"null"}}>غير مفعل</option>
            <option value="1" {{$wasfa->status==1?"selected":"null"}}>مفعل</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">صورة مقال</label>
        <input type="file" name="image">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">تاكيد</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
    </div>
</form>
@endsection