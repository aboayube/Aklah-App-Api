@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<style>
    .note-editable {

        height: 599.425px;
        background: #eee;
    }

    .modal-content-demo {
        width: 1000px
    }
</style>
<!-- row -->
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> وصفات </h1>
    </div>

</div>
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" href="{{route('admin.wasfas.create')}}">اضافة وصفات</a>
                </div>
            </div>
            <div class="card-body">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>صورة</th>
                                    <th>عنوان</th>
                                    <th>الطباخ</th>
                                    <th>سعر</th>
                                    <th>الحاله</th>
                                    <th>القسم</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wasfas as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td><img src="{{asset('Laravel/public/assets/wasfas/'.$x->image)}}" width="100" height="100"></td>
                                    <td>{{ $x->name}}</td>

                                    <td>{{ $x->user->name }}</td>
                                    <td>{{ $x->price }}</td>
                                    <td>{{ $x->status ? 'مفعل':'غير مفعل'}}</td>
                                    <td>{{ $x->category->name}}</td>
                                    @if($x->user_id==auth()->id() || auth()->user()->role=='admin')

                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" href="{{route('admin.wasfas.show',$x->id)}}" title="عرض"><i class="fa fa-eye"></i></a>
                                        <a class="modal-effect btn btn-sm btn-info" href="{{route('admin.wasfas.edit',$x->id)}}" title="تعديل"><i class="fa fa-edit"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-title="{{ $x->name }}" data-toggle="modal" href="#deletePostModel" title="حذف"><i class="fa fa-trash"></i></a>

                                    </td>
                                    @else
                                    <td>...</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            {{$wasfas->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- delete -->
<div class="modal" id="deletePostModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.wasfas.delete')}}" method="POST">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="id" value="">
                    <input class="form-control" name="title" id="title" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
        </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@endsection
@push('scripts')
<script>
    $(() => {
        $('#deletePostModel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #title').val(title);
        })
    })
</script>
@endpush