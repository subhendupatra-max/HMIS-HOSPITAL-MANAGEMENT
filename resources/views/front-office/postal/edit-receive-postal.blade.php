@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Receive</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-postal-receive-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input name="id" value="{{ $editReceive->id}}" type="hidden">
                    <div class="form-group col-md-4">
                        <label for="from_title" class="form-label">From Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="from_title" name="from_title"  required value="{{ $editReceive->from_title}}" >
                        @error('from_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="reference_no" class="form-label">Reference No </label>
                        <input type="text" class="form-control" id="reference_no" name="reference_no" value="{{ $editReceive->reference_no}}"  >
                        @error('reference_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address">{{  $editReceive->address }} </textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note">{{  $editReceive->note }}  </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="to_title" class="form-label">To Title </label>
                        <input type="text" class="form-control" id="to_title" name="to_title"  value="{{ $editReceive->to_title}}" >
                        @error('to_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" @if(isset($editReceive->date))  value="{{ date('Y-m-d',strtotime($editReceive->date))}}" @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="attach_document" class="form-label">Attach Document</label>
                        <input type="file" id="attach_document" name="attach_document" placeholder="">
                        @error('attach_document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                
                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Receive </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection