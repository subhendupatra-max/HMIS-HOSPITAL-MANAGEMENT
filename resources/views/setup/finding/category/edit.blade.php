@extends('layouts.layout')

@section('content')

@can('add finding category')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Category</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('finding-category-update') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="{{ $finding_category_edit->category_name}}" required>
                        @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <input type="hidden" name="id" value="{{ $finding_category_edit->id }}">
                <button type="submit" class="btn btn-primary mt-4 mb-0">Edit Category</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Category List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Category Name</th>
                                @can('delete finding category','edit finding category')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($finding_category as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        @can('edit finding category')
                                        <a class="dropdown-item" href="{{ route('edit-finding-category',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan

                                        @can('delete finding category')
                                        <a class="dropdown-item" href="{{ route('delete-finding-category',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
