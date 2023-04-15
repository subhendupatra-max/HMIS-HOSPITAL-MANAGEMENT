@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Call Log </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-call-log-details') }}" method="POST" >
                @csrf
                <div class="row">

                    <input type="hidden" name="id" value="{{ $editPhoneLog->id }}">

                    <div class="form-group col-md-4">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="{{ $editPhoneLog->name }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required value="{{ $editPhoneLog->phone }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label> 
                        <input type="date" class="form-control" id="date" name="date" @if(isset($editPhoneLog->date))  value="{{ date('Y-m-d',strtotime($editPhoneLog->date)) }}"  @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{$editPhoneLog->description}} </textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="next_fllow_up_date" class="form-label">Next Follow Up Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="next_fllow_up_date" name="next_fllow_up_date" @if(isset($editPhoneLog->next_follow_up_date))  value="{{ date('Y-m-d',strtotime($editPhoneLog->next_follow_up_date))}}"  @endif>
                        @error('next_fllow_up_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-4">
                        <label for="call_duraiton" class="form-label">Call Duraiton<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="call_duraiton" name="call_duraiton" placeholder="Enter Call Duraiton" value="{{ $editPhoneLog->call_duraiton }}">
                        @error('call_duraiton')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="call_type" class="form-label">Call Type<span class="text-danger">*</span></label>
                        <input type="radio" name="call_type" value="incoming" {{ $editPhoneLog->call_type == 'incoming' ? 'checked' : " "}} class="from-control"><span class="font-weight-bold;">Incoming</span>
                        <input type="radio" name="call_type" value="outgoing" {{ $editPhoneLog->call_type == 'outgoing' ? 'checked' : " "}} class="from-control" ><span class="fw-bold;">Outgoing</span>
                        @error('call_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> {{  $editPhoneLog->note }}</textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Call </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection