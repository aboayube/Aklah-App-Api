@extends('layouts.app')
@section('content')
<!-- row -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة طباخ </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">wasfa </th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">image </th>
                                <th class="border-bottom-0">الحالة </th>
                                @if(auth()->user()->role=='admin')
                                <th class="border-bottom-0">chef </th>
                                @endif
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wasfas as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->wasfa->name }}</td>
                                <td>{{ $x->user->name }}</td>
                                <td><img src="{{ asset('assets/wasfas/'.$x->wasfa->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $x->status }}</td>
                                <td>
                                    @if(auth()->user()->id == $x->chef_id )
                                    <a href="{{route('admin.orders.show',$x->id)}}" title="رؤية الطلبية"><i class="fa fa-eye"></i></a>

                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$x->name}}" data-id="{{ $x->id }}" data-toggle="modal" id="showEditModelCategory" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$wasfas->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editmodelNutrl">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> تعديل حاله</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.orders.update')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="docotor_id" name="id">

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <label for="exampleInputEmail1">status</label>
                                        <select name="status" id="status">
                                            <option value="end">مكتمل</option>
                                        </select>
                                        @error('status')
                                        <span class="btn btn-danger">{{$message}}</span>
                                        @enderror
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
    /**show */
    $('body').on('click', '#showModelNutr', function() {
        var nutr_val = $(this).data('id');
        $.get('/admin/chef/edit/' + nutr_val, function(data) {
            $('#showElementModel').modal('show');
        });
    });
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
    $(() => {
        //edit
        $('body').on('click', '#showEditModelCategory', function() {

            var docotor_id = $(this).data('id');
            var docotor_name = $(this).data('name');

            var nutr_val = $(this).data('value');
            $.get('/admin/chef/edit/' + docotor_id, function(data) {
                $('#editmodelNutrl').modal('show');
                $('#docotor_id').val(docotor_id);
                $('#docotor_name').val(docotor_name);

                $(`#status option[value='${data[0].status}']`).prop('selected', true);

                $(`#role option[value='${data[0].role}']`).prop('selected', true);
                // status
                // role


            });
        });
    })
</script>
@endpush