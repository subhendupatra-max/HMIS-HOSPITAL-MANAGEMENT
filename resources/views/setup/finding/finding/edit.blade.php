@extends('layouts.layout')

@section('content')

@can('add finding')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Finding</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-finding') }}">
                @csrf
                <input type="hidden" name="id" value="{{$finding_edit->id}}" />
                <div class="">
                    <div class="form-group">
                        <label for="finding_name" class="form-label"> Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="finding_name" name="finding_name" placeholder="Enter Finding Name" value="{{$finding_edit->finding_name}}" required>
                        @error('finding_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="finding_category" class="form-label"> Category <span class="text-danger">*</span></label>
                        <select class="form-control" name="finding_category" required>
                            <option value="">Select One</option>
                            @if($finding_category)
                            @foreach ($finding_category as $value)
                                <option value="{{$value->category_name}}" {{ $finding_edit->finding_category_id == $value->category_name ? 'selected':'' }}>{{$value->category_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('finding_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="finding_name" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{@$finding_edit->description}}</textarea>
                        @error('finding_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Edit Finding</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Finding List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Finding Name</th>
                                <th class="border-bottom-0">Category </th>
                                @can('delete finding','edit finding')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($finding as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->finding_name }}</td>
                                <td>{{ $item->finding_category_id }}</td>

                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        @can('edit finding')
                                        <a class="dropdown-item" href="{{ route('edit-finding',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan

                                        @can('delete finding')
                                        <a class="dropdown-item" href="{{ route('delete-finding',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
