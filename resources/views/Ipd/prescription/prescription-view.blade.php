@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">

                </div>
                <div class="col-md-2">
                    <div class="row">
                        @can('edit pathology test')
                        <a class="btn btn-primary btn-sm mb-2" href="{{ route('edit-pathology-test-details',['id'=> base64_encode($ipd_id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                        @endcan

                        @can('delete pathology test')
                        <a class="btn btn-primary btn-sm ml-2 mb-2" href="{{ route('delete-pathology-test-details',['id'=> base64_encode($ipd_id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
            <hr class="ipd_header_border">
            <div class="row">

                <div class="col-md-4">
                    <span class="head_name">Date</span> : <span class="value_name">{{ @$ipdPrescription->prescription_date }}</span>
                </div>

                <div class="col-md-4">
                    <span class="head_name">Note</span> : <span class="value_name">{{ @$ipdPrescription->note}}</span>
                </div>

            </div>

            <hr class="ipd_header_border ">
            @if (isset($EPrescriptionMedicine[0]->medicine_id))
            <div class="table-responsive mt-5">
                <table class="table table-striped card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Medicine Catagory</th>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Dose Interval</th>
                            <th scope="col">Dose Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($EPrescriptionMedicine as $value)

                        <tr>
                            <td>{{ @$value->medicine_details->catagory_name->medicine_catagory_name }}</td>
                            <td>{!! @$value->medicine_details->medicine_name !!}</td>
                            <td>{!! @$value->dose !!}</td>
                            <td>{!! @$value->interval !!}</td>
                            <td>{!! @$value->duration !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <hr class="ipd_header_border ">
            <div class="row com-md-12">

                <div class="col-md-6">
                    <h5> Pathology Tests:</h5>
                    @if (isset($EPresPathologyTest[0]->test_id))
                    <div class="table-responsive mt-5">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($EPresPathologyTest as $value)

                                <tr>

                                    <td>{!! @$value->test_details->test_name !!}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <h5> Radiology Tests: </h5>
                    @if (isset($EPresRadiologyTest[0]->test_id))
                    <div class="table-responsive mt-5">
                        <table class="table table-striped card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($EPresRadiologyTest as $value)

                                <tr>

                                    <td>{!! @$value->test_details_radiology->test_name !!}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection