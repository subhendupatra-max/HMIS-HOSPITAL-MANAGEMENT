@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Medication
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
        @include('message.notification')
        <div class="card-body ">
            <form action="{{ route('save-medicaiton-dose') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" required>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="time" name="time" required>
                        @error('time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="medicine_catagory_id" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" name="medicine_catagory_id" id="medicine_catagory_id" required>
                            <optgroup>
                                <option value=" ">Select Medicine Category</option>
                                @foreach ($medicine_catagory as $item)
                                <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('medicine_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <select name="medicine_name" id="medicine_name" class="form-control select2-show-search">
                            <option value="">Select Medicine Name</option>
                        </select>
                        @error('medicine_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dosage" class="form-label">Dosage <span class="text-danger">*</span></label>
                        <select name="dosage" id="dosage" class="form-control select2-show-search">
                            <option value="">Select Dosage</option>
                        </select>
                        @error('dosage')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                        <textarea name="remarks" id="remarks" class="form-control" rowsapan="1"> </textarea>
                        @error('remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Medication</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_id = $(this).val();

            $("#medicine_name").html('<option value=" ">Select Medicine Name...</option>');
            $.ajax({
                url: "{{ route('find-medicine-name-by-medicine-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id: medicine_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#medicine_name').append(`<option value="${value.id}">${value.medicine_name}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_catagory_id = $(this).val();

            $("#dosage").html('<option value=" ">Select Dose...</option>');
            $.ajax({
                url: "{{ route('find-dosage-by-medicine-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id_for_dose: medicine_catagory_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#dosage').append(`<option value="${value.id}">${value.dose}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<!-- <script>
    function medicine_name_and_dose(medicine_name = null, dosage = null) {
        let medicine_catagory_id = $('#m_medicine_catagory_id').val();
        //alert('uy'+medicine_catagory_id);
        $("#dosage").html('<option value=" ">Select Dose...</option>');
        $.ajax({
            url: "{{ route('find-dosage-and-name-by-medicine-catagory') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                medicine_catagory_id_for_dose: medicine_catagory_id,
            },

            success: function(response) {
                console.log(response);
                $.each(response.dosage, function(key, value) {
                    if (dosage == value.id) {
                        var sel = "selected";
                    }
                    $('#m_e_dosage').append(`<option value="${value.id}" ${sel}>${value.dose}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script> -->
@endsection