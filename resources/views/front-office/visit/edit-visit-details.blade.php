@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Visitor </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-visit-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $editVisit->id }}">
                    <div class="form-group col-md-4">
                        <label for="purpose" class="form-label">Purpose<span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('purpose') }}" name="purpose" id="purpose" required>
                            <option value="">Select Appointment Priority</option>
                            @foreach (Config::get('static.visit_purpose') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editVisit->purpose ? 'selected'  : " "}}> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('purpose')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="{{ $editVisit->name}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required value="{{ $editVisit->phone}}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="id_card" class="form-label">ID Card<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="id_card" name="id_card" placeholder="Enter ID Card"value="{{ $editVisit->id_card}}" >
                        @error('id_card')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="visit_to" class="form-label">Visit To<span class="text-danger">*</span></label>
                        <select id="visit_to" class="form-control" name="visit_to" onchange="visitWith(this.value)">
                            <option value="">Select...</option>
                            @foreach (Config::get('static.visit_to') as $lang => $item)
                            <option value="{{$item}}" {{ $item = $editVisit->visit_to ? 'selected' : " "}}> {{$item}}</option>
                            @endforeach  
                        </select>
                        @error('visit_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="visit_to_name" class="form-label">IPD/OPD/Staff<span class="text-danger">*</span></label>
                        <select name="visit_to_name" class="form-control select2-show-search" id="visit_to_name" >
                            <option value="">Select...</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('visit_to_name') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="number_of_person" class="form-label"> Number Of Person<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="number_of_person" name="number_of_person" value="{{ $editVisit->number_of_person }}">
                        @error('number_of_person')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" @if(isset($editVisit->date)) value="{{ date('Y-m-d',strtotime($editVisit->date)) }}" @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="in_time" class="form-label">In Time<span class="text-danger">*</span></label>
                        <input type="time"  class="form-control" id="in_time" name="in_time" @if(isset($editVisit->in_time)) value="{{$editVisit->in_time}}" @endif>
                        @error('in_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="out_time" class="form-label">Out Time<span class="text-danger">*</span></label>
                        <input type="time"  class="form-control" id="out_time" name="out_time" @if(isset($editVisit->out_time)) value="{{$editVisit->out_time}}" @endif>
                        @error('out_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"> {{ $editVisit->note }}</textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="attach_document" class="form-label">Attach Document</label>
                        <input type="file" id="attach_document" name="attach_document">
                        @error('attach_document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Appointment </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<script>
    function visitWith(visitor_type) {
         $("#visit_to_name").val('');
         var div_data = 'Select One...';

        $.ajax({
            url: "{{ route('find-staff-by-visitor') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                visitor: visitor_type,
            },

            success: function(response) {
                if (response.staff != null && response.staff != " ") {
                    $.each(response.staff, function(key, value) {
                        div_data += `<option value="${value.id}">${value.first_name} ${value.last_name}</option>`;
                        
                    });
                    $('#visit_to_name').html(div_data);
                }

                if (response.opd != null && response.opd != " ") {
                    $.each(response.opd, function(key, value) {
                        div_data += `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name} </option>`;
                     
                    });
                    $('#visit_to_name').html(div_data);
                }

                if (response.emg != null && response.emg != " ") {
                    $.each(response.emg, function(key, value) {
                        
                        div_data += `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name} </option>`;
                      
                    });
                    $('#visit_to_name').html(div_data);
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


@endsection