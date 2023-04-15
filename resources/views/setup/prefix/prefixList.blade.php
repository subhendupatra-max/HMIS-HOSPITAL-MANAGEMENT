@extends('layouts.layout')

@section('content')

@can('add item unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Prefix</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('addPrefix') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Name</label>
                        <input type="text" class="form-control" id="prefix_name" name="prefix_name" placeholder="Enter Name" value="{{ old('prefix_name')}}" required>
                        @error('prefix_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Prefix</label>
                        <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Enter prefix" required>
                        @error('prefix')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ date('Y') }}" placeholder="Enter Year" required readonly>
                        @error('year')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Prefix</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Prefix List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit</th>
                                @can('delete item unit')
                                    <th class="border-bottom-0">Remove Unit</th>
                                @endcan
                                @can('edit item unit')
                                    <th class="border-bottom-0">Edit Unit</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allPrefix as $item)    
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->prefix }}</td>
                                    @can('delete prefix')
                                      <td>
                                        <form action="{{ route('deletePrefix') }}" method="POST" id="delete">
                                          @csrf
                                          <button class="btn btn-danger"  data-toggle="tooltip-primary" data-placement="top" title="Remove Item unit" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                          <input type="hidden" name="prefix_id" value="{{ base64_encode($item->id) }}">
                                        </form>
                                      </td>
                                    @endcan
                                    @can('edit prefix')
                                      <td>
                                        <a href="{{ route('editPrefix',['id'=>base64_encode($item->id)]) }}" class="btn btn-warning"  data-toggle="tooltip-primary" data-placement="top" title="Edit Item unit"><i class="fa fa-edit"></i></a>
                                      </td>
                                    @endcan
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