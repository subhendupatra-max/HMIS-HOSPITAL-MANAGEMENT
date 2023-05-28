@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <span class="head_name">Test Name</span> : <span
                            class="value_name">{{ @$pathologyTest->test_name }}</span>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            @can('edit pathology test')
                                <a class="btn btn-primary btn-sm mb-2" href="{{ route('edit-pathology-test-details',['id'=> base64_encode($pathologyTest->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                            @endcan                       
                                                    
                            @can('delete pathology test')
                                <a class="btn btn-primary btn-sm ml-2 mb-2" href="{{ route('delete-pathology-test-details',['id'=> base64_encode($pathologyTest->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <hr class="ipd_header_border">
                <div class="row">
                    <div class="col-md-4">
                        <span class="head_name">Test Type</span> : <span
                            class="value_name">{{ @$pathologyTest->test_type }}</span>
                    </div>

                    <div class="col-md-4">
                        <span class="head_name">Category</span> : <span
                            class="value_name">{{ @$pathologyTest->pathology_catagory->catagory_name }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name"> Sub Catagory</span> : <span
                            class="value_name">{{ @$pathologyTest->sub_catagory }}</span>
                    </div>



                    <div class="col-md-4">
                        <span class="head_name">Method</span> : <span
                            class="value_name">{{ @$pathologyTest->method }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Report Days</span> : <span
                            class="value_name">{{ @$pathologyTest->report_days }}</span>
                    </div>


                    <div class="col-md-4">
                        <span class="head_name">Charges Catagory </span> : <span
                            class="value_name">{{ @$pathologyTest->charges_catagory->charges_catagories_name }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="head_name">Charges Sub Catagory</span> : <span
                            class="value_name">{{ @$pathologyTest->charges_sub_catagory->charges_sub_catagories_name }}</span>
                    </div>


                    <div class="col-md-4">
                        <span class="head_name">Charges</span> : <span
                            class="value_name">{{ @$pathologyTest->charges->charges_name }}</span>
                    </div>
        
                    <div class="col-md-4">
                        <span class="head_name">Charge Amount</span> :<br> <span
                            class="value_name"> <?php
                            $charge_with_type = DB::table('charges_with_charges_types')
                            ->join('charge_types','charges_with_charges_types.charge_type_id','=','charge_types.id')
                            ->where('charges_with_charges_types.charge_id',$pathologyTest->charge)
                            ->get();
                            if(@$charge_with_type[0]->charge_type_id != null){
                                foreach($charge_with_type as $value){
                                    echo $value->charge_type_name." : ".$value->standard_charges." Rs<br>";
                                }
                            }
                            ?></span>
                    </div>
           
                </div>
                <hr class="ipd_header_border ">
                <div class="row">
                    {!! @$pathologyTest->description !!}
                </div>
                <hr class="ipd_header_border ">
                @if (isset($pathologyParameter[0]->parameter_name))
                <div class="table-responsive mt-5">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Test Parameter Name</th>
                                <th scope="col">Reference Range</th>
                                <th scope="col">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pathologyParameter as $value)
                          
                                <tr>
                                    <td>{{ @$value->parameter_name }}</td>
                                    <td>{!! @$value->reference_range !!}</td>
                                    <td>{!! @$value->unit_name !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    
@endsection
