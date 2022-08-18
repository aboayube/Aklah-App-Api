@extends('layouts.app')
@section('content')

<!-- row -->
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach

<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>مقالات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
    </ul>
</div>
<!-- row -->
<div class="row">
    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة اضافة مكون</a>
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-body">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>صورة</th>
                                    <th>اسم الطبخة</th>
                                    <th>اسم en</th>
                                    <th>سعر</th>
                                    <th>الحاله</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wasfacontents as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td><img src="{{asset('Laravel/public/assets/wasfas_content/'.$x->image)}}" width="100" height="100"></td>
                                    <td>{{ $x->name}}</td>
                                    <td>{{ $x->name_en}}</td>
                                    <td>{{ $x->price }}</td>
                                    <td>{{ $x->status ? 'مفعل':'غير مفعل'}}</td>
                                    <td>
                                        @if($x->wasfa->user_id==auth()->id() )
                                        <a class="modal-effect btn btn-sm btn-info" data-id="{{$x->id}}" data-wasfa="{{ $id}}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $x->id }}" data-name="{{$x->name}}" data-toggle="modal" id="showDeleteModelCategory" href="showDeleteModelCategory" title="حذف"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{$wasfacontents->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.wasfacontent.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="wasfa_id" value="{{$id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسم</label>
                        <input type="text" class="form-control" id="" name="name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسمen</label>
                        <input type="text" class="form-control" id="" name="name_en">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسمen</label>
                        <input type="number" class="form-control" id="" name="price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">صورة</label>
                        <input type="file" class="form-control" id="" name="image">
                    </div>
                    <label for="exampleInputEmail1">حالة القسم</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0">غير مفعل</option>
                        <option value="1">مفعل</option>

                    </select>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->


</div>
<!-- edit -->

<div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.wasfacontent.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="data_id" id="cat_id">
                    <input type="hidden" name="wasfa_id" id="wasfa_edit">

                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                        <input class="form-control" name="name" id="name" type="text">
                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">اسم القسم en:</label>
                        <input class="form-control" name="name_en" id="name_en" type="text">
                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">price :</label>
                        <input class="form-control" name="price" id="price" type="number">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">صورة</label>
                        <input type="file" class="form-control" id="" name="image">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="cat_id">
                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0">غير مفعل</option>
                            <option value="1">مفعل</option>

                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>



<div class="modal" id="deleteCoateoryModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.wasfacontent.delete')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="cat_id_delete" value="">
                    <input class="form-control" name="name" id="delete_name" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
        </div>
        </form>
    </div>
</div>



@endsection

@push('scripts')

<script script src="{{asset('backend/js/jquery-3.3.1.min.js')}}">
</script>
<script>
    $('body').on('click', '#showEditModelCategory', function() {
        var wasfaid = $(this).data('wasfa');
        var contentId = $(this).data('id');
        $.get('/admin/wasfacontent/edit/' + wasfaid + '/' + contentId, function(data) {
            $('#categoryEditModel').modal('show');

            $('#cat_id').val(data.id);
            $('#wasfa_edit').val(data.wasfa_id);
            $('#name').val(data.name);
            $('#name_en').val(data.name_en);
            $('#price').val(data.price);
            $(`#status option[value='${data.status}']`).prop('selected', true);
        })
    });
    $('body').on('click', '#showDeleteModelCategory', function() {
        var cat_id = $(this).data('id');
        var name = $(this).data('name');
        console.log(cat_id);
        $('#deleteCoateoryModel').modal('show');
        $('#cat_id_delete').val(cat_id);
        $('#delete_name').val(name);

    });
</script>
@endpush