@extends('layouts.layout')

@section('content')

@can('add tpa management')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Tpa Management</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-tpa-management-details') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="TPA_name" class="form-label">TPA Name</label>
                        <input type="text" class="form-control" id="TPA_name" name="TPA_name" placeholder="Enter Tpa Name" value="{{ old('TPA_name')}}" required>
                        @error('TPA_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_person_name" class="form-label">Contact Person Name</label>
                        <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Enter Contact Person Name " value="{{ old('contact_person_name')}}" required>
                        @error('contact_person_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_person_ph_no" class="form-label">Contact Person Phone No</label>
                        <input type="text" class="form-control" id="contact_person_ph_no" name="contact_person_ph_no" placeholder="Enter Contact Person Ph No" value="{{ old('contact_person_ph_no')}}" required>
                        @error('contact_person_ph_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Tpa Management</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tpa Management List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">TPA Name</th>
                                <th class="border-bottom-0">Contact Person Name</th>
                                <th class="border-bottom-0">Contact Person Phone No</th>
                                @can('delete tpa management','edit tpa management')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($management as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$item->TPA_name }}</td>
                                <td>{{ @$item->contact_person_name }}</td>
                                <td>{{ @$item->contact_person_ph_no }}</td>
                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        @can('edit tpa management')
                                        <a class="dropdown-item" href="{{ route('edit-tpa-management-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan

                                        @can('delete tpa management')
                                        <a class="dropdown-item" href="{{ route('delete-tpa-management-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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