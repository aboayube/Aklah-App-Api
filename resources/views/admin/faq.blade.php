@extends('layouts.app')


@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة سؤال</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">العنوان</th>
                                <th class="border-bottom-0">title</th>


                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">discription</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">مستخدم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $faq->title }}</td>
                                <td>{{ $faq->title_en }}</td>
                                <td>{{ $faq->body }}</td>
                                <td>{{ $faq->body_en }}</td>
                                <td>{{ $faq->status ? 'مفعل':'غير مفعل'}}
                                <td>{{ $faq->user->name }}</td>
                                <td>
                                    @if($faq->user_id==auth()->id() || auth()->user()->role=='admin')
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $faq->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $faq->id }}" data-name="{{ $faq->title }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$faqs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة سؤال</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.faq.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">سؤال </label>
                            <input type="text" class="form-control" id="" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">title </label>
                            <input type="text" class="form-control" id="" name="title_en">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الاجابة</label>
                            <textarea class="form-control" id="" name="body"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">discription</label>
                            <textarea class="form-control" id="" name="body_en"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                            <select name="status">
                                <option value="0">غير مفعل</option>
                                <option value="1">مفعل</option>

                            </select>
                        </div>

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
                    <h5 class="modal-title" id="exampleModalLabel">تعديل سؤال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.faq.update')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="cat_id" value="">
                            <label for="recipient-name" class="col-form-label">سؤال:</label>
                            <input class="form-control" name="title" id="name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">سؤال:</label>
                            <input class="form-control" name="title_en" id="name_en" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اجابة</label>
                            <textarea class="form-control" id="body" name="body"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اجابة</label>
                            <textarea class="form-control" id="body_en" name="body_en"> </textarea>
                        </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">حاله</label>
                    <select name="status" id="status">
                        <option value="0">غير مفعل</option>
                        <option value="1">مفعل</option>

                    </select>
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
                <form action="{{route('admin.faq.delete')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="delete_id" value="">
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




    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@push('scripts')
<!-- Internal Data tables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('body').on('click', '#showEditModelCategory', function() {
        var cat_id = $(this).data('id');
        $.get('/admin/faq/edit/' + cat_id, function(data) {
            $('#categoryEditModel').modal('show');
            $('#cat_id').val(data.id);
            $('#name').val(data.title);
            $('#name_en').val(data.title_en);
            $('#body').val(data.body);
            $('#body_en').val(data.body_en);
            $(`#status option[value='${data.status}']`).prop('selected', true);
        })
    });
    $('body').on('click', '#deleteCoateory', function() {

        $('#deleteCoateoryModel').modal('show');
        var id = $(this).data('id')
        var name = $(this).data('name')
        console.log(name, id)
        $('#delete_id').val(id);
        $('#delete_name').val(name);
    })
</script>
@endpush