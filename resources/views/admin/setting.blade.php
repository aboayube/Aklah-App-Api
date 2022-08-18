@extends('layouts.app')
@section('content')
<style>
    .table-responsive {
        overflow-x: hidden;
        direction: rtl
    }

    .logo-website {
        width: 104%;
        height: 275px;
    }
</style>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="row">

        <div class="col-xl-3">
            @if(isset($setting->image))
            <img width="100" height="200" class="logo-website" src="{{asset('Laravel/public/assets/setting/'.$setting->image)}}">
            @endif
        </div>
        <div class="col-xl-9">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="main-content-label mg-b-5 text-center">
                        اعدادات الخاصة بموقع
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('admin.settings.update')}}" method="POST" class="text-center" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">اسم</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name',$setting->name)}}" name="name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name_en',$setting->name_en)}}" name="name_en">
                                    @error('name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discription" class="col-sm-2 col-form-label">وصف</label>
                                <div class="col-sm-10">
                                    <textarea name="discription" class="form-control">{{old('discription',$setting->discription)}}</textarea>
                                    @error('discription')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discription" class="col-sm-2 col-form-label">وصف</label>
                                <div class="col-sm-10">
                                    <textarea name="discription_en" class="form-control">{{old('discription_en',$setting->discription_en)}}</textarea>
                                    @error('discription_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" value="{{old('address',$setting->address)}}" name="address">
                                    @error('address')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">address_en</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address_en" value="{{old('address_en',$setting->address_en)}}" name="address_en">
                                    @error('address_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" value="{{old('email',$setting->email)}}" name="email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="facebook" value="{{old('facebook',$setting->facebook)}}" name="facebook">
                                    @error('facebook')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twiter" class="col-sm-2 col-form-label">twiter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="twiter" value="{{old('twiter',$setting->twiter)}}" name="twiter">
                                    @error('twiter')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="linked_in" class="col-sm-2 col-form-label">linked_in</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="linked_in" value="{{old('linked_in',$setting->linked_in)}}" name="linked_in">
                                    @error('linked_in')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-sm-2 col-form-label">instagram</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="instagram" value="{{old('instagram',$setting->instagram)}}" name="instagram">
                                    @error('instagram')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="whatsapp" class="col-sm-2 col-form-label">whatsapp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="whatsapp" value="{{old('whatsapp',$setting->whatsapp)}}" name="whatsapp">
                                    @error('whatsapp')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">شعار الموقع</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="whatsapp" class="col-sm-2 col-form-label">whatsapp</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" {{$setting->status == 1 ? 'selected' : ''}}>مفعل</option>
                                        <option value="0" {{$setting->status == 0 ? 'selected' : ''}}>غير مفعل</option>
                                    </select>
                                    @error('whatsapp')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-info">تعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
</div>
</div>
@endsection