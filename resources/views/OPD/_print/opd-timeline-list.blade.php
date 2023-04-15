@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Timeline </h4>
                    </div>
                    @can('OPD registation')
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> OPD Registaion</a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">OPD Id</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Gurdian Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($opd_registaion_list))
                            @foreach ($opd_registaion_list as $value)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a class="textlink" href="{{route('opd-profile',['id'=>base64_encode($value->id)])}}">{{ @$value->opd_prefix }}{{ @$value->id }}</a></td>
                                    <td>{{ @$value->patient->prefix }}{{ @$value->patient->first_name }}{{ @$value->patient->middle_name }}{{ @$value->patient->last_name }}({{ @$value->patient->id }})</td>
                                    <td>{{ @$value->patient->phone }}</td>
                                    <td>{{ @$value->patient->guardian_name }}</td>
                                    <td>{{ @$value->patient->gender }}</td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">

                                                <a class="dropdown-item"
                                                    href=""><i class="fa fa-eye"></i> View</a>
                                                @can('edit patient')
                                                    <a class="dropdown-item"
                                                        href="">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                @endcan
                                                @can('delete patient')
                                                    <a class="dropdown-item"
                                                        href=""><i
                                                            class="fa fa-trash"></i> Delete</a>
                                                @endcan
                                                @can('OPD registation')
                                                <a class="dropdown-item"
                                                    href=""><i
                                                        class="fa fa-file-alt"></i> OPD Registation</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="modaldemo2">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Select New / Old Patient</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('after-new-old')}}" method="post">
                @csrf
                <div class="modal-body">
                    <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="patient_type" value="new_patient">
						<span class="custom-control-label" Style="color:rgb(7, 73, 1);font-weight: 500;font-size: 14px;">New Patient</span>
					</label>
                    <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="patient_type" value="old_patient">
						<span class="custom-control-label" Style="color:brown;font-weight: 500;
                        font-size: 14px;">Old Patient</span>
					</label>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
