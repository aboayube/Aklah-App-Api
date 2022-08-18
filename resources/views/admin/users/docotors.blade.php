@extends('layouts.backend.app')


@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافةطبيب </a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0">رقم الجوال </th>
                                <th class="border-bottom-0">ايميل </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->name }}</td>
                                <td><img src="{{ asset('Laravel/public/assets/users/'.$x->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $x->mobile }}</td>
                                <td>{{ $x->email }}</td>
                                <td>{{ $x->status==1?'مفعل':'غير مفعل' }}</td>
                                <td>

                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$x->name}}" data-id="{{ $x->id }}" data-toggle="modal" id="showDateModelCategory" href="javascript:void(0)" title="عرض جدول"><i class="fa fa-eye"></i></a>

                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$x->name}}" data-id="{{ $x->id }}" data-toggle="modal" id="showEditModelCategory" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-name="{{ $x->name }}" data-toggle="modal" id="showDeleteModelDocotors" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>

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


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة طبيب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.docotors.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم</label>
                            <input type="text" class="form-control" id="" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> ايميل</label>
                            <input type="email" class="form-control" id="" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> رقم الجوال</label>
                            <input type="number" class="form-control" id="" name="mobile" value="{{old('mobile')}}">
                            @error('mobile')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">password</label>
                            <input type="password" class="form-control" id="" name="password">
                            @error('password')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">confipassword</label>
                            <input type="password" class="form-control" id="" name="confirm-password">
                            @error('confirm-password')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">status</label>
                            <select name="status">
                                <option value="0">غير فعال</option>
                                <option value="1">فعال</option>
                            </select>
                            @error('status')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">صلاحياته</label>
                            <select name="role" multiple id="role">
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                                @error('role')
                                <span class="btn btn-danger">{{$message}}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">cv</label>
                            <input type="file" name="cv">
                            @error('cv')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
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
    <div class="modal" id="editmodelNutrl">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> تعديل حاله</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.docotors.update')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="docotor_id" name="id">

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">اسم</label>
                                        <input type="text" class="form-control" id="docotor_name" name="name">
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="exampleInputEmail1">status</label>
                                        <select name="status" id="status">
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                        @error('status')
                                        <span class="btn btn-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">صلاحياته</label>
                                        <select name="role" multiple id="role" id="role">
                                            @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                            @error('role')
                                            <span class="btn btn-danger">{{$message}}</span>
                                            @enderror
                                        </select>
                                    </div>

                                </div>
                                <hr>


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


    <!-- date docotor -->

    <div class="modal" id="showElementModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">مواعيد <span id="docotorName"></span></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <table class="table key-buttons text-md-nowrap" id="element_showdate_details">
                    <thead>
                        <tr>
                            <td>يوم</td>
                            <td>اليوم </td>
                            <td>من ساعة</td>
                            <td>الي الساعة</td>
                            <td>الحاله</td>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>

                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
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
                <h6 class="modal-title">اضافة طبيب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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




<div class="modal" id="deleteCoateoryModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.docotors.delete')}}" method="POST">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="docotor_id_delete" value="">
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
    $('#deleteCoateoryModel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
    //show Edit
    $('body').on('click', '#showDateModelCategory', function() {

        var docotor_id = $(this).data('id');
        var docotor_name = $(this).data('name');

        var nutr_val = $(this).data('value');
        $.get('/admin/docotors/showDate/' + docotor_id, function(data) {

            $('#showElementModel').modal('show');
            if (data) {
                data.forEach(function(el) {

                    $('#element_showdate_details').find('tbody').append($('' +
                        '<tr>' +
                        '<td>' + el['id'] + '</td>' +
                        '<td>' + el['day'] + '</td>' +
                        '<td>' + el['from_hour'] + '</td>' +
                        '<td>' + el['to_hour'] + '</td>' +
                        '<td>' + el['status'] + '</td>' +
                        '<tr>'
                    ));


                });
            } else {

                $('#element_showdate_details').find('tbody').append($('' +
                    '<tr>' +
                    '<td>لا يوجد حالينا مواعيد</td>' +
                    '<tr>'
                ));
            }
        });
    });
    $(document).ready(function() {
        $(document).on('hidden.bs.modal', '#showElementModel', function() {

            console.log('1');
            $('#element_showdate_details').find('tbody tr').remove();
        });
    });


    //edit
    $('body').on('click', '#showEditModelCategory', function() {

        var docotor_id = $(this).data('id');
        var docotor_name = $(this).data('name');

        var nutr_val = $(this).data('value');
        $.get('/admin/docotors/edit/' + docotor_id, function(data) {
            console.log(data[0].role, data);
            $('#editmodelNutrl').modal('show');
            $('#docotor_id').val(docotor_id);
            $('#docotor_name').val(docotor_name);

            $(`#status option[value='${data[0].status}']`).prop('selected', true);

            $(`#role option[value='${data[0].role}']`).prop('selected', true);
            // status
            // role



            let trCount = $("#invoice_details_edit").find('tr.cloning_row:last').length;
            let numberIncr = trCount > 0 ? parseInt($("#invoice_details_edit").find('tr.cloning_row:last').attr('id')) + 1 : 0;

            data.forEach(function(el) {


                $("#invoice_details_edit").find('tbody').append($('' +
                    `<tr class="cloning_row" id="${numberIncr}">
            <td><input type="checkbox"  value=" name="permission[]" class="element " ></td>
            </tr>`))



                numberIncr++;
            });

        });
    });
    $('#showDatemodelNutrl').on('hidden.bs.modal', function(event) {
        console.log('yes');
        $('#element_showdate_details').find('tbody tr').remove();
    })


    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
    //لما يروح الضغط عن اضهار العناصر



    // حذف

    $('body').on('click', '#showDeleteModelDocotors', function() {
        var cat_id = $(this).data('id');
        var name = $(this).data('name');
        $('#deleteCoateoryModel').modal('show');
        $('#docotor_id_delete').val(cat_id);
        $('#delete_name').val(name);

    });
</script>
@endpush