@extends('layouts.layout')
@section('content')




<!-- ================================ vendor quatation details========================= -->

<div class="modal" id="modaldemo3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Vendor/Quatation</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php if (@$requisition_details->status >= 3 &&  @$requisition_details->status <= 9) { ?>
                <form method="POST" action="{{route('add-vender-for-quatation')}}">
                    @csrf
                    <input type="hidden" name="req_id" value="{{$requisition_details->id}}">
                    <div class="row">
                        <div class="col-md-8">
                            @if(isset($vendor_details))
                            <select name="vendor_name[]" multiple="multiple" class="multi-select select2-show-search">
                                <option>Select Vendor</option>
                                @foreach($vendor_details as $value)
                                <option value="{{$value->id}}">
                                    {{$value->vendor_name}},{{$value->vendor_address}},{{$value->vendor_gst}}</option>
                                @endforeach
                            </select>
                            @endif
                            @error('vendor_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-envelope"></i> Send For
                                RFQ</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Vendor Details</th>
                                <th>Quatation</th>
                                <th>Select Quatation</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sl_vender))
                            @foreach($sl_vender as $value)
                            <tr>
                                <td>{{$value->sl_vendors_join->vendor_name}}
                                    <br>
                                    @if($value['status'] == 1)
                                    <a class="btn btn-pill btn-secondary btn-sm" href="#" type="button">Selected</a>
                                    @endif
                                    @if($value['status'] == 2)
                                    <a class="btn btn-pill btn-warning btn-sm" href="#" type="button">Hold</a>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{route('add-vendor-quatation')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="vender_name" value="{{$value->vendor_id}}">
                                        <input type="hidden" name="req_id" value="{{$requisition_details->id}}">
                                        <input type="file" style="width: 61%;" <?php if (@$value['status']==1) {
                                            echo "disabled" ; } ?>
                                        name="vendor_quatation" required>
                                        <button class="btn btn-indigo btn-sm" style="margin-left: 20px;" <?php if
                                            (@$value['status']==1) { echo "disabled" ; } ?> type="submit"><i
                                                class="fa fa-file"></i>
                                            Save</button>
                                    </form>
                                    @if($value->vendor_quatation != null)
                                    <a style="color:blue"
                                        href="{{ asset('public/quatation/') }}/{{@$value->vendor_quatation}}"
                                        target="_blank"><i class="fa fa-eye"></i> View Quatation</a>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{route('vendor-select-for-po')}}">
                                        @csrf
                                        <label>Note</label>
                                        <textarea name="note" <?php if (@$value['status']==1) { echo "readonly" ; }
                                            ?> class="form-control">{{@$value->comment}}</textarea>
                                        <br>
                                        <select name="selection" <?php if (@$value['status']==1) { echo "disabled" ; }
                                            ?> class="form-control" required>
                                            <option value="">Select One</option>
                                            <option value="1" <?php if ($value['status']==1) { echo "Selected" ; } ?>
                                                >Selected</option>
                                            <option value="2" <?php if ($value['status']==2) { echo "Selected" ; } ?>
                                                >Hold</option>
                                        </select>
                                        <br>
                                        <!--       <select name="item_quataion" required class="select2-show-search" class="form-control">
                                            <option value="0" selected>All Item</option>
                                            @if(isset($requisition_item) && $requisition_item != '')
                                            @foreach($requisition_item as $requisition)
                                            <option value="{{$requisition->requisition_details_id}}">{{@$requisition->item_name}}<br>({{@$requisition->item_description}})</option>
                                            @endforeach
                                            @endif
                                        </select> -->

                                        <input type="hidden" name="vendor_id" value="{{$value->vendor_id}}">
                                        <input type="hidden" name="req_no" value="{{$requisition_details->id}}">
                                        <button type="submit" <?php if (@$value['status']==1) { echo "disabled" ; } ?>
                                            class="btn btn-success btn-sm"><i class="fa fa-check"></i> Select</button>
                                        <br>
                                    </form>
                                </td>
                                <!--             <td>
                                    <a href="{{ url('/vendor-remove') }}/{{$value->vendor_id}}/{{$requisition_details->req_no}}"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip-primary" data-placement="top"
                                        title="Delete"><i
                                        class="fa fa-trash"></i> Delete</a>
                                </td> -->
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================================ vendor quatation details========================= -->
<div class="modal" id="modaldemo2">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Approval</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('give-approval-vendor')}}">
                    @csrf
                    <div class="col-md-12">
                        <select name="permission" class="form-control" required <?php if
                            (@$permisison_status_own_vendor->status == 'Approved' ||
                            @$permisison_status_own_vendor->status == 'Rejected') {
                            echo "disabled";
                            } ?>>
                            <option value="" disabled>Select One</option>
                            <option value="Pending" disabled <?php if (@$permisison_status_own_vendor->status ==
                                'Pending') {
                                echo "selected";
                                } ?>>Pending</option>
                            <option value="Approved" <?php if (@$permisison_status_own_vendor->status == 'Approved') {
                                echo "selected";
                                } ?>>Approved</option>
                            <option value="Need Clarification" <?php if (@$permisison_status_own_vendor->status == 'Need
                                Clarification') {
                                echo "selected";
                                } ?>>Need Clarification</option>
                            <option value="Rejected" <?php if (@$permisison_status_own_vendor->status == 'Rejected') {
                                echo "selected";
                                } ?>>Rejected</option>
                        </select>
                        <input type="hidden" name="requisition_id" value="{{$requisition_details->id}}">
                    </div>
                    <div class="col-md-12">
                        Comment:
                        <textarea name="comment" <?php if
                            (@$permisison_status_own_vendor->status == 'Approved' || @$permisison_status_own_vendor->status == 'Rejected') {
                                                        echo "readonly";
                                                    } ?> class="form-control">{{@$permisison_status_own_vendor->comment}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" <?php if (@$permisison_status_own_vendor->status == 'Approved' ||
                            @$permisison_status_own_vendor->status == 'Rejected') {
                            echo "disabled";
                            } ?> type="submit"><i class="fa fa-file"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
<!-- =================================Permission For Selected Vendor=================== -->

<div class="modal" id="modaldemoadd_rfq_vendor">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> Quatation Approval</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('add-vendor-permission')}}">
                    @csrf
                    <div class="col-md-12">
                        <label class="form-label">Permission Authority<span class="required"> *</span></label></label>
                        <select name="permission_authority[]" multiple="multiple"
                            class="multi-select select2-show-search" required>
                            <option value="">Select One</option>
                            @if($user_list)
                            @foreach($user_list as $value)
                            <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-12 permissionadd">
                        <label>Permission Type<span class="required"> *</span></label>
                        <select name="permission_type" required class="select2-show-search">
                            <option value="" disabled>Select One</option>
                            <option value="Parallal" selected>Parallal</option>
                            <option value="Sequential" disabled>Sequential</option>
                        </select>
                    </div>
                    <input type="hidden" name="req_id" value="{{@$requisition_details->id}}">
                    <br>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- =================================Permission For Selected Vendor=================== -->
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Requisition Details
                    </div>

                    @can('print medicine requisition')
                    <a href="{{ route('print-requisition',['id'=>$requisition_details->id]) }}"
                        class="btn btn-primary btn-sm allbtndemo"><i class="fa fa-print"> Print</i></a>
                    @endcan

                    @if(!empty($requisition_details->status > 2))
                    <a class="btn btn-primary btn-sm  allbtndemooo" data-target="#modaldemo3" data-toggle="modal"
                        href="#"><i class="fa fa-list"></i> Vendors/Quatations</a>
                    @endif
                </div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="requisition_header">Requisition No : </span><span
                                            class="requisition_text">{{@$requisition_details->requisition_prefix}}{{@$requisition_details->id}}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="requisition_header">Requisition Date : </span><span
                                            class="requisition_text">
                                            <?= date('d-m-Y h:i', strtotime($requisition_details->date)); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="requisition_header">Generated By : </span><span
                                            class="requisition_text">{{@$requisition_details->generate_by_name->first_name}}
                                            {{@$requisition_details->generate_by_name->last_name}}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="requisition_text ">
                                            {!!@$requisition_details->working_status->status!!}
                                        </span>
                                    </div>
                                    <hr>
                                    @if(!empty($vendor_selected_quataion))
                                    @foreach($vendor_selected_quataion as $value)
                                    <div class="col-md-6">
                                        <span class="requisition_header">Selected Vendor Details : </span><br><span
                                            class="requisition_text">{{$value->sl_vendors_join->vendor_name}},{{$value->sl_vendors_join->vendor_address}},{{$value->sl_vendors_join->vendor_gst}}</span><br>
                                        @if(!empty($value->comment))
                                        <span style="color:blue;cursor: pointer;" data-placement="top"
                                            data-toggle="tooltip" title="{{$value->comment}}"><i class="fa fa-eye"></i>
                                            View Note</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <span class="requisition_header">Selected Vendor Quatation : </span><br><span
                                            class="requisition_text"><a
                                                href="{{ asset('public/quatation/') }}/{{@$value->vendor_quatation}}"
                                                target="_blank"><span style="color:blue;cursor: pointer;"
                                                    data-placement="top" data-toggle="tooltip" title="View Quatation"><i
                                                        class="fa fa-eye"></i> View
                                                    Quatation</span></a></span>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($requisition_details->status == 5 || $requisition_details->status == 6)
                                    <div class="col-md-6">
                                        <span class="requisition_header"> <a class="btn btn-primary"
                                                data-target="#modaldemoadd_rfq_vendor" data-toggle="modal" href=""><i
                                                    class="fa fa-user"></i> Permission For Selected Vendor</a></span>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-4">
                                @if(count($permisison_users_vendor) > 0)
                                        <div class=" scrollbar3" style="height:35px !importment" id="scrollbar3">
                                            <ul class="timeline mb-0">
                                                @if(isset($permisison_users_vendor) && $permisison_users_vendor != '')
                                                @foreach($permisison_users_vendor as $user)
                                                <li class="mt-0">
                                                    <div class="d-flex"><span
                                                            class="time-data"><i class="fa fa-circle text-danger"></i> {{@$user->permisison_users_vendor->first_name}}
                                                            {{@$user->permisison_users_vendor->last_name}}</span><span
                                                            class="ml-auto text-muted fs-11">
                                                            <?php if ($user->date != '' && $user->date != null) 
                                                            { echo date('d-m-Y h:i', strtotime($user->date)); } ?>
                                                        </span></div>
                                                    <p class="text-muted fs-12">
                                                        <span class="text-info">
                                                            @if($user->user_id == Auth::id() && ( $user->permission_type
                                                            == 'Parallal' ||
                                                            @$show_for_permission_vendor->user_id == Auth::id()))
                                                            <td><a class="btn btn-pill btn-info btn-sm"
                                                                    data-target="#modaldemo2" data-toggle="modal"
                                                                    type="button">{{$user->status}}</a></td>
                                                            @else
                                                            <td><a class="btn btn-pill btn-info btn-sm"
                                                                    type="button">{{$user->status}}</a>
                                                            </td>
                                                            @endif
                                                        </span>
                                                    </p>
                                                    @if(!empty($user->comment))
                                                    <p class="text-muted fs-12"><span
                                                            style="color:blue;cursor: pointer;" data-placement="top"
                                                            data-toggle="tooltip" title="{{$user->comment}}"><i
                                                                class="fa fa-eye"></i> View Note</span></p>
                                                    @endif
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine Name</th>
                                <th>Medicine Unit</th>
                                <th>Quantity</th>
                                <th>PO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($requisition_item) && $requisition_item != '')
                            @foreach($requisition_item as $requisition)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{@$requisition->fetch_medicine_name->medicine_name}}({{@$requisition->fetch_medicine_name->catagory_name->medicine_catagory_name}})
                                </td>
                                <td>{{@$requisition->fetch_medicine_unit->medicine_unit_name}}</td>
                                <td>{{@$requisition->quantity}}</td>
                                <td>
                                    <?php if ($requisition->po_status == 1) {
                                            echo '<a style="color:blue" data-toggle="modal" type="button"><i class="fa fa-check"></i></a>';
                                        }

                                        ?>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- bd -->
            </div>

        </div>
    </div>
</div>
</div>
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Change Status</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{route('given-approval')}}">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <select name="permission" <?php if (@$permisison_status_own->status == 'Approved' ||
                            @$permisison_status_own->status == 'Rejected') {
                            echo "disabled";
                            } ?> class="form-control" required>
                            <option value="" disabled>Select One</option>
                            <option value="Pending" disabled <?php if (@$permisison_status_own->status == 'Pending') {
                                echo "selected";
                                } ?>>Pending</option>
                            <option value="Approved" <?php if (@$permisison_status_own->status == 'Approved') {
                                echo "selected";
                                } ?>>Approved</option>
                            <option value="Need Clarification" <?php if (@$permisison_status_own->status == 'Need
                                Clarification') {
                                echo "selected";
                                } ?>>Need Clarification</option>
                            <option value="Rejected" <?php if (@$permisison_status_own->status == 'Rejected') {
                                echo "selected";
                                } ?>>Rejected</option>
                        </select>
                        <input type="hidden" name="requisition_id" value="{{@$requisition_details->id}}">
                    </div>
                    <div class="col-md-12">
                        Comment:
                        <textarea name="comment" <?php if
                            (@$permisison_status_own->status == 'Approved' || @$permisison_status_own->status == 'Rejected') {
                                                        echo "readonly";
                                                    } ?> class="form-control">{{@$permisison_status_own->comment}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" type="submit" <?php if (@$permisison_status_own->status ==
                            'Approved' || @$permisison_status_own->status == 'Rejected') {
                            echo "disabled";
                            } ?>><i class="fa fa-file"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection