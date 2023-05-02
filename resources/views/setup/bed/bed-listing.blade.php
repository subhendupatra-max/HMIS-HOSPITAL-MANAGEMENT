@extends('layouts.layout')

@section('content')

@can('add item unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Bed</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-bed-details') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="bed_name" class="medicinelabel">Bed Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="bed_name" name="bed_name" placeholder="Enter Bed Name" value="{{ old('bed_name')}}" required>
                        @error('bed_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <div class="bededit">
                        <label for="bedType_id" class="bedlabel">Bed Type</label>
                        <select id="bedType_id" class="form-control" name="bedType_id">
                            <option value=" ">Select Bed Type Id</option>
                            @foreach ($bedTypeId as $item)
                            <option value="{{$item->id}}">{{$item->bedType_name}}</option>
                            @endforeach
                        </select>
                        @error('bedType_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                        <div class="bededit">
                        <label for="bedWard_id" class="bedlabelone">Ward <span class="text-danger">*</span></label>
                        <select id="bedWard_id" class="form-control" name="bedWard_id">
                            <option value=" ">Select Ward </option>
                            @if(isset($bedWard))
                            @foreach ($bedWard as $item)
                            <option value="{{$item->id}}" >{{$item->ward_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('bedWard_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group">
                      <div class="bededit">
                        <label for="bedGroup_id" class="bedlabeltwo">Bed Group</label>
                        <select id="bedGroup_id" class="form-control" name="bedGroup_id">
                            <option value=" ">Select Bed Group </option>
                            @foreach ($bedGroupId as $item)
                            <option value="{{$item->id}}">{{$item->bedGroup_name}}</option>
                            @endforeach
                        </select>
                        @error('bedGroup_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                    </div>

                    <div class="form-group">
                        <label for="bedUnit_id" class="bedlabelthree">Bed Unit</label>
                        <select id="bedUnit_id" class="form-control" name="bedUnit_id">
                            <option value=" ">Select Bed Unit Id</option>
                            @foreach ($bedUnitId as $item)
                            <option value="{{$item->id}}">{{$item->bedUnit_name}}</option>
                            @endforeach
                        </select>
                        @error('bedUnit_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="bedlabelfour">Department</label>
                        <select id="department_id" class="form-control" name="department_id">
                            <option value=" ">Select Department</option>
                            @foreach ($departmentId as $item)
                            <option value="{{$item->id}}">{{$item->department_name}}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Bed</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Bed List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Bed Name</th>
                                <th class="border-bottom-0">Ward Name</th>
                                <th class="border-bottom-0">Bed Type Name</th>
                                <th class="border-bottom-0">Bed Group Name</th>
                                <th class="border-bottom-0">Bed Unit Name</th>
                                <th class="border-bottom-0">Bed Department Name</th>
                                @can('delete bed','edit bed')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bed as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->bed_name }}</td>
                                <td>{{@$item->bed_ward->ward_name }}</td>
                                <td>{{@$item->bed_type->bedType_name }}</td>
                                <td>{{@$item->bed_unit->bedUnit_name }}</td>
                                <td>{{@$item->bed_group->bedGroup_name }}</td>
                                <td>{{@$item->bed_department->department_name }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit bed')
                                            <a class="dropdown-item" href="{{ route('edit-bed-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete bed')
                                            <a class="dropdown-item" href="{{ route('delete-bed-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
