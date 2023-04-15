@extends('layouts.layout')

@section('content')

@can('edit opd ticket fees')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Ticket Fees</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-opd-ticket-fees-details') }}">
                @csrf
                <div class="">
                  <input type="hidden" name="id" value="{{$editTicketFees->id}}">
                    <div class="form-group">
                        <label for="patient_type" class="form-label"> Patient Type <span class="text-danger">*</span></label>
                        <select name="patient_type" class="form-control select2-show-search" id="patient_type">
                            <option value="">Select</option>
                            @foreach (Config::get('static.patient_types') as $lang => $patient)
                            <option value="{{$patient}}" {{ $patient == $editTicketFees->patient_type ? 'selected' : " "}}> {{$patient}}</option>
                            @endforeach
                        </select>
                        @error('patient_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ticket_fees" class="form-label">Ticket Fees</label>
                        <input type="text" class="form-control" id="ticket_fees" name="ticket_fees" placeholder="Enter Ticket Fees" value="{{ $editTicketFees->ticket_fees }}" required>
                        @error('ticket_fees')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Ticket Fees</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ticket Fees List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Patient Type</th>
                                <th class="border-bottom-0">Ticket Fees</th>
                                @can('delete opd ticket fees','edit opd ticket fees')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketFees as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->patient_type}}</td>
                                <td>{{ $item->ticket_fees}}</td>
                                    <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit opd ticket fees')
                                            <a class="dropdown-item" href="{{ route('edit-opd-ticket-fees-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete opd ticket fees')
                                            <a class="dropdown-item" href="{{ route('delete-opd-ticket-fees-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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