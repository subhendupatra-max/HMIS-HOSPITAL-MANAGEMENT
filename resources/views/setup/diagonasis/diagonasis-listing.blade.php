@extends('layouts.layout')

@section('content')

@can('add diagonasis')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Diagonasis</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-diagonasis-details') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="diagonasis_name" class="medicinelabel">Diagonasis Name</label>
                        <input type="text" id="diagonasis_name" name="diagonasis_name" placeholder="Enter Diagonasis Name" value="{{ old('diagonasis_name')}}" required>
                        @error('diagonasis_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="diagonasisedit">

                            <label for="icd_code" class="diagoniseadd">Icd Code</label>
                            <input type="text" id="icd_code" name="icd_code" placeholder="Enter Icd Code" value="{{ old('icd_code')}}" required>

                            @error('icd_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Diagonasis</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Diagonasis List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Diagonasis Name</th>
                                <th class="border-bottom-0">Icd Code</th>
                                @can('delete diagonasis','edit diagonasis')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagonasis as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->diagonasis_name }}</td>
                                <td>{{ @$item->icd_code }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit diagonasis')
                                            <a class="dropdown-item" href="{{ route('edit-diagonasis-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete diagonasis')
                                            <a class="dropdown-item" href="{{ route('delete-diagonasis-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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