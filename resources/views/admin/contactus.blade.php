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
                                <th class="border-bottom-0">اسمen </th>
                                <th class="border-bottom-0">ايميل </th>
                                <th class="border-bottom-0">message </th>
                                <th class="border-bottom-0">message_en </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactus as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->name }}</td>
                                <td>{{ $x->name_en }}</td>
                                <td>{{ $x->email }}</td>
                                <td>{{ $x->message }}</td>
                                <td>{{ $x->message_en }}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-name="{{ $x->name }}" data-toggle="modal" id="showDeleteModelCategory" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$contactus->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete -->
<div class="modal" id="deleteUsersModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.contactus.delete')}}" method="POST">
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