@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Discharge Patient
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

        <div class="card-body">
            <form action="{{ route('save-discharged-patient-in-ipd') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="ipd_id" value="{{ $ipdId }}" />
                    <input type="hidden" name="case_id" value="{{ $ipd_patient_details->case_id }}" />
                    <input type="hidden" name="patient_id" value="{{ $ipd_patient_details->patient_id }}" />

                    <div class="form-group col-md-4">
                        <label for="discharge_date" class="form-label">Discharge Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="discharge_date" name="discharge_date" value="{{ old('discharge_date') }}" />
                        @error('discharge_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_status" class="form-label">Discharge Status</label>
                        <select name="discharge_status" class="form-control" id="discharge_status" required>
                            <option value="">Select...</option>
                            @foreach (Config::get('static.discharge_type') as $lang => $dischargeType)
                            <option value="{{ $dischargeType }}"> {{ $dischargeType }}
                            </option>
                            @endforeach
                        </select>
                        @error('discharge_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="icd_code" class="form-label">Icd Code</label>
                        <select name="icd_code" class="form-control" id="icd_code" required>
                            <option value="">Select...</option>
                            @foreach ( $icd_code as $item)
                            <option value="{{ $item->id }}"> {{ $item->icd_code }}
                            </option>
                            @endforeach
                        </select>
                        @error('icd_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" value="{{ old('note') }}"></textarea>
                        @error('weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="operation" class="form-label">operation</label>
                        <textarea class="form-control" id="operation" name="operation" value="{{ old('operation') }}"></textarea>
                        @error('operation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <textarea class="form-control" id="diagnosis" name="diagnosis" value="{{ old('diagnosis') }}"></textarea>
                        @error('diagnosis')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="investigation" class="form-label">Investigation</label>
                        <textarea class="form-control" id="investigation" name="investigation" value="{{ old('investigation') }}"></textarea>
                        @error('investigation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="treatment_home" class="form-label">Treatment Home</label>
                        <textarea class="form-control" id="treatment_home" name="treatment_home" value="{{ old('treatment_home') }}"></textarea>
                        @error('treatment_home')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Discharged Patient</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection