@extends('layouts.layout')

@section('content')

@can('Add source')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Source</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-source-in-front-office') }}">
                @csrf
                <div class="">
                    <input type="hidden" name="id" value="{{ $editSource->id }}" />
                    <div class="form-group">
                        <label for="source" class="medicinelabel">Enter Source <span class="text-danger">*</span></label>
                        <input type="text"  id="source" name="source" value="{{ $editSource->source }}" required>
                        @error('source')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="descriptionadd">
                        <label for="description" class="descriptiononelabel">Description </label>
                        <input type="text"id="description" name="description"value="{{ $editSource->description }}" >
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Source</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Source List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Source</th>
                                <th class="border-bottom-0">Description</th>
                                @can('Edit source','Delete source')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($source as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->source}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('Edit source')
                                            <a class="dropdown-item" href="{{ route('edit-source-in-front-office',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('Delete source')
                                            <a class="dropdown-item" href="{{ route('delete-source-in-front-office',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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
