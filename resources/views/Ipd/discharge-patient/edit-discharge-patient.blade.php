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
            <form action="{{ route('update-discharged-patient-in-ipd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <input type="hidden" name="discharged_patient_id" value="{{ $patient_discharge_details->id }}" />
                    <input type="hidden" name="ipd_id" value="{{ $ipdId }}" />
                    <input type="hidden" name="case_id" value="{{ $ipd_patient_details->case_id }}" />
                    <input type="hidden" name="patient_id" value="{{ $ipd_patient_details->patient_id }}" />

                    <div class="form-group col-md-4">
                        <label for="ipd_no" class="form-label">IPD No<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="ipd_no" name="ipd_no" value="{{ $ipd_details->id }}" />

                    </div>

                    <div class="form-group col-md-4">
                        <label for="doctor_name" class="form-label">Treating Consultant's Name<span class="text-danger">*</span></label>
                        <select name="doctor_name" class="form-control" id="doctor_name">
                            <option value="">Select...</option>
                            @foreach ($doctor as $name)
                            <option value="{{ $name->id }}" {{ @$name->id == @$patient_discharge_details->doctor_name }}> {{ $name->first_name }} {{ $name->last_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doctor_name" class="form-label">Department<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="doctor_name" name="doctor_name" value="{{ $ipd_details->department_details->department_name }} " />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doctor_name" class="form-label">UHID<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="doctor_name" name="doctor_name" value="{{ $patient_details->id }} " />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="admission_date" class="form-label">Admission Date<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="admission_date" name="admission_date" value="{{ $ipd_details->appointment_date }} " />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_date" class="form-label">Discharge Date</label>
                        <input type="datetime-local" class="form-control" id="discharge_date" name="discharge_date" @if(isset($patient_discharge_details->discharge_date)) value="{{ date('Y-m-d h:m:s',strtotime( $patient_discharge_details->discharge_date)) }}" @endif/>
                        @error('discharge_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="icd_code" class="form-label">Icd code </label>
                        <select name="icd_code" class="form-control" id="icd_code" required>
                            <option value="">Select...</option>
                            @foreach ($icd_code as $icd_codes)
                            <option value="{{ $icd_codes->id }}" {{ $icd_codes->id == @$patient_discharge_details->icd_code ? 'selected' : " "  }}> {{ $icd_codes->diagonasis_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('icd_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="diagonsis_admission_time" class="form-label">Provisional Diagnosis at the time of Admission</label>
                        <input type="text" class="form-control" id="diagonsis_admission_time" name="diagonsis_admission_time" value="{{ @$patient_discharge_details->diagonsis_admission_time }} " />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="final_diagonsis_discharge" class="form-label">Final Diagnosis at the time of Discharge</label>
                        <input type="text" class="form-control" id="final_diagonsis_discharge" name="final_diagonsis_discharge" value="{{ @$patient_discharge_details->final_diagonsis_discharge }} " />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="complaiints_duraiton" class="form-label">Presenting Complaints with Duration and Reason for Admission </label>
                        <textarea class="form-control" id="complaiints_duraiton" name="complaiints_duraiton">{{@$patient_discharge_details->complaiints_duraiton}}</textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="presenting_illness" class="form-label">Summary of Presenting Illness</label>
                        <textarea class="form-control" id="presenting_illness" name="presenting_illness" v>{{@$patient_discharge_details->presenting_illness }}</textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="physical_examinaiton_at_admission" class="form-label">Key findings, on physical examination at the time of admission</label>
                        <textarea class="form-control" id="physical_examinaiton_at_admission" name="physical_examinaiton_at_admission">{{@$patient_discharge_details->physical_examinaiton_at_admission}}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="history_alcoholism" class="form-label"> History of alcoholism, tobacco or substance abuse, if nay</label>
                        <textarea class="form-control" id="history_alcoholism" name="history_alcoholism">{{@$patient_discharge_details->history_alcoholism}}</textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="medical_surgical_history" class="form-label"> Significant Past Medical and Surgical History, if any</label>
                        <textarea class="form-control" id="medical_surgical_history" name="medical_surgical_history"> {{@$patient_discharge_details->medical_surgical_history}}</textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="family_history_diagnosis" class="form-label"> Family History if significant/ relevant to diagnosis or treatment</label>
                        <textarea class="form-control" id="family_history_diagnosis" name="family_history_diagnosis">{{@$patient_discharge_details->family_history_diagnosis}}</textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="summary_inves_during_hos" class="form-label"> Summary of key invesigations during Hospitalization<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary_inves_during_hos" name="summary_inves_during_hos"> {{@$patient_discharge_details->summary_inves_during_hos}} </textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="course_complications" class="form-label"> Course in the Hospital including complicaiotns if any</label>
                        <textarea class="form-control" id="course_complications" name="course_complications" value="{{ @$patient_discharge_details->course_complications }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dischage_advice" class="form-label">Advice on Discharge<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="dischage_advice" name="dischage_advice" value="{{ @$patient_discharge_details->dischage_advice }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_status" class="form-label">Discharge Status</label>
                        <select name="discharge_status" class="form-control" id="discharge_status" required onchange="hide(this.value)">
                            <option value="">Select...</option>
                            @foreach (Config::get('static.discharge_type') as $lang => $dischargeType)
                            <option value="{{ $dischargeType }}" {{ $dischargeType == @$patient_discharge_details->discharge_status ? 'selected' : " "}}> {{ $dischargeType }}
                            </option>
                            @endforeach
                        </select>
                        @error('discharge_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if(isset($patient_discharge_details->refferal_hospital_name))
                    <div class="form-group col-md-4" style="display:none" id="referral_hospital">
                        <label for="refferal_hospital_name" class="form-label">Refferal Hospital Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="refferal_hospital_name" name="refferal_hospital_name" value="{{ @$patient_discharge_details->refferal_hospital_name }}" />
                    </div>
                    @endif
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Discharged Patient</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    function hide(val) {
        if (val == 'Refferal') {
            $('#referral_hospital').removeAttr('style', true);
        } else {
            $('#referral_hospital').attr('style', 'display:none !important', true);

        }
    }
</script>
@endsection