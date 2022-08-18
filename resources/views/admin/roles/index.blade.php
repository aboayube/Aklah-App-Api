@extends('layouts.app')


@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافةصلاحيه </a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم الصلاحيه</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->name }}</td>
                                <td>

                                    <a class="modal-effect btn btn-sm btn-info" href="{{route('admin.roles.edit',$x->id)}}" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $x->id }}" data-name="{{$x->name}}" data-toggle="modal" id="showDeleteModelCategory" href="#" title="حذف"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة صلاحيه</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.roles.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">اسم </label>
                                        <input type="text" class="form-control" id="" name="name">
                                    </div>

                                </div>
                                <hr>
                                <table class="table" id="invoice_details">
                                    <thead>
                                        <tr>
                                            <th>اسم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr class="cloning_row" id="0">
                                            <td>
                                                <input type="checkbox" name="permission[]" value="{{$permission->id}}" class=""> {{ $permission->name }}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
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
    <!-- edit model -->

</div>


<!-- showElementModel -->
<div class="modal" id="showElementModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة صلاحية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <table class="table key-buttons text-md-nowrap" id="element_details">
                    <thead>
                        <tr>
                            <td>رقم</td>
                            <td>اسم</td>
                            <td>كميه</td>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->


</div>

<!-- delete -->
<div class="modal" id="deleteCoateoryModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.roles.delete')}}" method="POST">
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
    /**show */
    $('body').on('click', '#showModelNutr', function() {
        var nutr_val = $(this).data('id');
        $.get('/admin/nutrs/edit/' + nutr_val, function(data) {
            $('#showElementModel').modal('show');
            data.forEach(function(el) {
                $('#element_details').find('tbody').append($('' +
                    '<tr>' +
                    '<td>' + el['id'] + '</td>' +
                    '<td>' + el['element'] + '</td>' +
                    '<td>' + el['element_value'] + '</td>' +
                    '<tr>'
                ));
            });
        });

    });

    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
    // حذف


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