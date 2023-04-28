@extends('layouts.layout')

@section('content')

@can('Add purpose')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Purpose</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-purpose-in-front-office') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        {{--  <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Enter Purpose" value="{{ old('purpose')}}" required>  --}}
                        <input type="text"id="purpose" name="purpose" value="{{ old('purpose')}}">
                        <label class="purposelabel" for="purpose">Purpose<span class="text-danger">*</span></label>
                        @error('purpose')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{--  <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description"></textarea>  --}}
                        <input type="text"id="description" name="description">
                        <label class="purposelabelone" for="description">Description <span class="text-danger">*</span></label>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Purpose</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Purpose List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Purpose</th>
                                <th class="border-bottom-0">Description</th>
                                @can('Edit purpose','Delete purpose')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purpose as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->purpose}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine catagory')
                                            <a class="dropdown-item" href="{{ route('edit-purpose-in-front-office',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine catagory')
                                            <a class="dropdown-item" href="{{ route('delete-purpose-in-front-office',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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
