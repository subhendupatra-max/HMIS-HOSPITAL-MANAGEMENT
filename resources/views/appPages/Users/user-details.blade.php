@extends('layouts.layout')
@section('content')
<!-- ================================ Alert Message===================================== -->
            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif
<!-- ================================ Alert Message===================================== -->
	<div class="col-xl-4 col-lg-3 col-md-12">
		<div class="card box-widget widget-user">
			<div class="widget-user-image mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="{{ asset('public/profile_picture') }}/{{$login_details->profile_image}}" style="height: 100px;width: 117px;"></div>
			<div class="card-body text-center">
				<div class="pro-user">
					<h4 class="pro-user-username text-dark mb-1 font-weight-bold">{{$login_details->name}}</h4>
					<h6 class="pro-user-desc text-muted">{{$login_details->role_as}}</h6>

                @can('user active deactive')
                @if($login_details->id != Auth::id())
                    @if($login_details->is_active == '1')
					<a href="{{route('user-enable-disable',base64_encode($login_details->id))}}"  class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Disabled"><i class="fa fa-user"></i></a>
                    @endif

                    @if($login_details->is_active == '0')
					<a href="{{route('user-enable-disable',base64_encode($login_details->id))}}"  class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Enabled"><i class="fa fa-user-alt-slash"></i></a>
                    @endif
                @endif
                @endcan
              	@if(auth()->user()->can('user edit') || $login_details->id == Auth::id())
					<a href="{{route('user-edit',base64_encode($login_details->id))}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-edit"></i></a>	
                @endif

                @if($login_details->id == Auth::id())
					<a href="{{route('change-password')}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
                @endif
                @can('user delete')
                @if($login_details->id != Auth::id())
					<a href="{{route('user-delete',base64_encode($login_details->id))}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
				@endif
				@endcan
				</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Personal Details</h4>
				<div class="table-responsive">
					<table class="table mb-0">
						<tbody>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Name </span>
								</td>
								<td class="py-2 px-0">{{$login_details->first_name}} {{$login_details->middle_name}} {{$login_details->last_name}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Gender </span>
								</td>
								<td class="py-2 px-0">{{$login_details->gender}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Age </span>
								</td>
								<td class="py-2 px-0">{{date('d-m-Y',strtotime($login_details->date_of_birth))}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Father's Name </span>
								</td>
								<td class="py-2 px-0">{{$login_details->father_name}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Mother's Name </span>
								</td>
								<td class="py-2 px-0">{{$login_details->mother_name}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Metrial Status </span>
								</td>
								<td class="py-2 px-0">{{$login_details->marital_status}}</td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Phone </span>
								</td>
								<td class="py-2 px-0">{{$login_details->phone_no}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	
		</div>
	</div>

	<?php

	if($login_details->workshop != 0)
	{
		$workshop_na = DB::table('workshops')->where('id',$login_details->workshop)->first();
        $workshop_name = $workshop_na->name;
	}
	else
	{
	    $workshop_name = 'All Workshop';	
	}

	  ?>
	<div class="col-xl-8 col-lg-9 col-md-12">
		<div class="main-content-body main-content-body-profile card">
			<div class="main-profile-body">
				<div class="card-body border-top">
					<h5 class="font-weight-bold">Work & Education</h5>
					<div class="main-profile-contact-list d-lg-flex">
						<div class="media mr-5">
							<div class="media-icon bg-success text-white mr-4">
								<i class="fa fa-user-circle"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Whatsapp to <br>
									<a class="text-info" href="https://api.whatsapp.com/send?phone=+91{{$login_details->whatapps_no}}&amp;text=Hi%20{{$login_details->name}}" target="_blank">{{$login_details->whatsapp_no}}</a>

							</div>
						</div>
						<div class="media mr-5">
							<div class="media-icon bg-danger text-white mr-4">
								<i class="fa fa-briefcase"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Highest Qualification</h6>
								<span></span>
								<p>{!!$login_details->qualification!!}</p>
							</div>
						</div>
						<div class="media mr-5">
							<div class="media-icon bg-info text-white mr-4">
								<i class="fa fa-home"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Workshop</h6>
								<span></span>
								<p>{{@$workshop_name}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body border-top">
					<h5 class="font-weight-bold">Contact</h5>
					<div class="main-profile-contact-list d-lg-flex">
						<div class="media mr-4">
							<div class="media-icon bg-primary text-white  mr-3 mt-1">
								<i class="fa fa-phone"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Mobile</small>
								<div class="font-weight-normal1">
									<a href="tel:{{$login_details->phone_no}}">{{$login_details->phone_no}}</a> / 
									<a href="tel:{{$login_details->emg_phone_no}}">{{$login_details->emg_phone_no}}</a>
								
								</div>
							</div>
						</div>
						<div class="media mr-4">
							<div class="media-icon bg-warning text-white mr-3 mt-1">
								<i class="fa fa-mail-bulk"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Mail</small>
								<div class="font-weight-normal1">
									<a href="mailto:{{$login_details->email}}">{{$login_details->email}}</a>
								</div>
							</div>
						</div>
						
					</div><!-- main-profile-contact-list -->
				</div>
				<div class="card-body border-top">
					<h5 class="font-weight-bold"> Address</h5>
					<div class="main-profile-contact-list d-lg-flex">
						
						<div class="media">
							<div class="media-icon bg-info text-white mr-3 mt-1">
								<i class="fa fa-map"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Current Address</small>
								<div class="font-weight-normal1">
									{!!$login_details->current_address!!} 
								</div>
							</div>
						</div>
					</div><!-- main-profile-contact-list -->
				</div>
				<div class="card-body border-top">
					<h5 class="font-weight-bold">Permanent Address</h5>
					<div class="main-profile-contact-list d-lg-flex">
						
						<div class="media">
							<div class="media-icon bg-info text-white mr-3 mt-1">
								<i class="fa fa-map"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Permanent Address</small>
								<div class="font-weight-normal1">
									{!!$login_details->permanent_address!!} 
								</div>
							</div>
						</div>
					</div><!-- main-profile-contact-list -->
				</div>
			</div>
		</div>
	</div>


@endsection