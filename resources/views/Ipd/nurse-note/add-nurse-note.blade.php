@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Nurse Note
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('save-nurse-note-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="nurse" class="form-label">Nurse <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('nurse') }}" name="nurse" id="nurse" required>
                            <optgroup>
                                <option value=" ">Select Nurse </option>
                                @foreach ($nurseName as $item)
                                <option value="{{$item->id}}"> {{$item->first_name}} {{$item->last_name}} </option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('nurse')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="note" class="form-label"> Note </label>
                        <textarea name="note" class="form-control">  </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="comment" class="form-label"> Comment </label>
                        <textarea name="comment" class="form-control">  </textarea>
                        @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Nurse Note</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection