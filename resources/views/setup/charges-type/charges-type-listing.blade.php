@extends('layouts.layout')

@section('content')

@can('charges add catagory')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Charges Type</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-charges-type-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="charge_type_name" class="medicinelabel">Enter Charges Type name <span class="text-danger">*</span></label>
                        <input type="text" id="charge_type_name" name="charge_type_name" placeholder="Enter Charges Type Name" value="{{ old('charge_type_name')}}" required>
                        @error('charge_type_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Charges Type</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Charges Type List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Type Name</th>
                                @can('charges edit catagory','charges delete catagory')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charge_type as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->charge_type_name}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('charges edit catagory')
                                            <a class="dropdown-item" href="{{ route('edit-charges-type-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('charges delete catagory')
                                            <a class="dropdown-item" href="{{ route('delete-charges-type-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>

@endsection