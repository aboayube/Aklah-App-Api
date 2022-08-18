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
                                <th class="border-bottom-0">مستخدم </th>
                                <th class="border-bottom-0">تقييم </th>
                                <th class="border-bottom-0">ملاحظات </th>
                                <th class="border-bottom-0">note_en </th>
                                @if(auth()->user()->role=='admin')
                                <th class="border-bottom-0">طباخ </th>
                                @endif <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ratings as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->user->name }}</td>
                                <td>{{ $x->rating }}</td>
                                <td>{{ $x->note }}</td>
                                <td>{{ $x->note_en }}</td>
                                <td>{{ $x->chef->name }}</td>

                                @if(auth()->user()->role=='admin')
                                <td>{{ $x->chef->name }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$ratings->links()}}
                    <div class="text-center">
                    </div>
                </div>
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