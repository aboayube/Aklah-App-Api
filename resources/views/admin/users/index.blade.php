@extends('layouts.app')
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">ايميل </th>
                                <th class="border-bottom-0">رقم الجوال </th>
                                <th class="border-bottom-0">العنوان </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->popular() }}</td>
                                <td>{{ $x->email }}</td>
                                <td>{{ $x->mobile }}</td>
                                <td>{{ $x->location }}</td>
                                <td><img src="{{ asset('Laravel/public/users/'.$x->image) }}" width="100px" height="50px" /></td>

                                <td>{{ $x->status==1?'مفعل':'غير مفعل' }}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$x->name}}" data-id="{{ $x->id }}" data-toggle="modal" id="showModelNutr" href="javascript:void(0)" title="تعديل"><i class="fa  fa-edit"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-name="{{ $x->name }}" data-toggle="modal" id="showDeleteModelCategory" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- showElementModel -->
<div class="modal" id="showElementModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="" method="post" action="{{route('admin.users.update')}}">
                    @csrf
                    <input type="hidden" value="" name="id" id="user_id" />
                    <select name="status" id="status_user">
                        <option value="0">غير فعال</option>
                        <option value="1"> فعال</option>
                    </select>
                    <input type="submit" value="update" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
</div>
<!-- delete -->
<div class="modal" id="deleteUsersModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.users.delete')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="id_delete" value="">
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
<script>
    /**edit */
    $('body').on('click', '#showModelNutr', function() {
        var user_id = $(this).data('id');
        $.get('/admin/users/edit/' + user_id, function(data) {
            $('#showElementModel').modal('show');
            $("#user_id").val(user_id);
            $(`#status_user option[value='${data.status}']`).prop('selected', true);
        });
    });
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {
        $('#element_details').find('tbody tr').remove();
    })
    // حذف
    $(document).on('click', '#showDeleteModelCategory', function() {
        var nutr_id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteUsersModel').modal('show');
        $('#id_delete').val(nutr_id);
        $('#delete_name').val(name);
    });
</script>
@endpush