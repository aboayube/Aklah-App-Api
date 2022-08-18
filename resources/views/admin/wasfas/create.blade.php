@extends('layouts.app')
@section('content')
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
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
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="main-content-label mg-b-5 text-center">
                        wasfas create</div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('admin.wasfas.store')}}" method="POST" class="text-center" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">اسم</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">name_en</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name_en')}}" name="name_en">
                                    @error('name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discription" class="col-sm-2 col-form-label">discription</label>
                                <div class="col-sm-10">
                                    <textarea name="discription" class="form-control">{{old('discription')}}</textarea>
                                    @error('discription')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discription" class="col-sm-2 col-form-label">discription_en</label>
                                <div class="col-sm-10">
                                    <textarea name="discription_en" class="form-control">{{old('discription_en')}}</textarea>
                                    @error('discription_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" value="{{old('price')}}" name="price">
                                    @error('price')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">time_make</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="time_make" value="{{old('time_make')}}" name="time_make">
                                    @error('time_make')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">number_user</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="number_user" value="{{old('number_user')}}" name="number_user">
                                    @error('number_user')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">category_id</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id">

                                        @foreach($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status">

                                        <option value="1">فعال</option>
                                        <option value="0">غير فعال</option>

                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <h1>مكونات الاصافية للوجبة</h1>
                            <table class="table" id="invoice_details">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم</th>
                                        <th>name_en</th>
                                        <th>سعر</th>
                                        <th>صورة</th>
                                        <th>حالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cloning_row" id="0">
                                        <td>#</td>
                                        <td>
                                            <input type="text" name="element[0]" id="name" class="name form-control">
                                            @error('name')
                                            <span class="text-danger help-block">{{$message}} </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="element_en[0]" id="element" class="name form-control">
                                            @error('name_en')
                                            <span class="text-danger help-block">{{$message}} </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" name="element_value[0]" id="element_value" class="element_value form-control">
                                            @error('element_value')
                                            <span class="text-danger help-block">{{$message}} </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="file" name="element_img[0]">
                                            @error('element_img')
                                            <span class="text-danger help-block">{{$message}} </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select name="element_status[0]">
                                                <option value="0">غير مفعل</option>
                                                <option value="1">مفعل</option>
                                            </select>
                                            @error('element_status')
                                            <span class="text-danger help-block">{{$message}} </span>
                                            @enderror
                                        </td>
                                        <td colspan="6">
                                            <button type="button" class="btn_add btn btn-primary">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-info">save</button>
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
@push('scripts')
<script>
    $(document).on('click', '.btn_add', function() {
        let trCount = $("#invoice_details").find('tr.cloning_row:last').length;
        let numberIncr = trCount > 0 ? parseInt($("#invoice_details").find('tr.cloning_row:last').attr('id')) + 1 : 0;
        $("#invoice_details").find('tbody').append($('' +
            '<tr class="cloning_row" id="' + numberIncr + '">' +
            '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
            '<td><input type="text" name="element[' + numberIncr + ']" class="element form-control"></td>' +
            '<td><input type="text" name="element_en[' + numberIncr + ']" class="element_en form-control"></td>' +
            '<td><input type="number" name="element_value[' + numberIncr + ']"  class="element_value form-control"></td>' +
            '<td><input type="file" name="element_img[' + numberIncr + ']"  class="element_img form-control"></td>' +
            '<td><select name="element_status[' + numberIncr + ']"  class="element_img form-control"><option value="0">غير مفعل</option><option value="1">مفعل</option></select></td>' +

            '</tr>'))
    });
    $(document).on('click', '.delegated-btn', function(ee) {
        ee.preventDefault();
        $(this).parent().parent().remove()
    });
</script>

@endpush
@endsection