@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Complain</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-complain-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $editComplain->id }}">
                    <div class="form-group col-md-4">
                        <label for="complain_type" class="form-label">Complain Type<span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('complain_type') }}" name="complain_type" id="complain_type" required>
                            <option value="">Select Complain Type</option>
                            @foreach (Config::get('static.complain_type') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editComplain->complain_type ? 'selected' : " "}} > {{$item}}</option>
                            @endforeach
                        </select>
                        @error('complain_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="source" class="form-label">Source<span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('source') }}" name="source" id="source" >
                            <option value="">Select Source</option>
                            @foreach (Config::get('static.complain_source') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editComplain->source ? 'selected' : " "}}> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('source')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="complain_by" class="form-label">Complain By <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="complain_by" name="complain_by" placeholder="" value="{{ $editComplain->complain_by}}">
                        @error('complain_by')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $editComplain->phone}}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" @if(isset($editComplain->date)) value="{{ date('Y-m-d',strtotime($editComplain->date))}}" @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{$editComplain->description}} </textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="action_taken" class="form-label">Action Taken</label>
                        <input type="text" class="form-control" id="action_taken" name="action_taken" placeholder="" value="{{ $editComplain->action_taken}}">
                        @error('action_taken')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="assigned" class="form-label">Assigned</label>
                        <input type="text" class="form-control" id="assigned" name="assigned" placeholder=""  value="{{ $editComplain->assigned}}">
                        @error('assigned')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> {{$editComplain->note}}</textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="attach_document" class="form-label">Attach Document</label>
                        <input type="file"  id="attach_document" name="attach_document" placeholder="" >
                        @error('attach_document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Complain </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection