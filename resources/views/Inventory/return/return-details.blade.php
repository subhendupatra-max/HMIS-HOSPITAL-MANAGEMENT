@extends('layouts.layout')
@section('content')

@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp



<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Rejection Item Details
            </div>
        </div>

        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="requisition_header">Workshop : </span><span class="requisition_text">{{ @$rejection_list->workshop_name }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Rejection Date : </span><span class="requisition_text"><?= date('d-m-Y h:i', strtotime(@$rejection_list->rejection_date)); ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Rejection No. : </span><span class="requisition_text">{{@$rejection_list->return_prefix}}{{ @$rejection_list->return_id }}</span>
                            </div>

                            <div class="col-md-6">
                                <span class="requisition_header">Generated By : </span><span class="requisition_text">{{@$rejection_list->name}}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="requisition_header">Materials Rec. Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i', strtotime(@$rejection_list->material_rec_date)) ?></span>
                            </div>
                            @isset($rejection_list->bill_rec_date)
                            <div class="col-md-6">
                                <span class="requisition_header">Bill Rec. Date : </span><span class="requisition_text"><?php echo date('d-m-Y h:i', strtotime(@$rejection_list->bill_rec_date)) ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->challan_no)
                            <div class="col-md-6">
                                <span class="requisition_header">Challan No. : </span><span class="requisition_text"><?php echo @$rejection_list->challan_no; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->challan_date)
                            <div class="col-md-6">
                                <span class="requisition_header">Challan Date : </span><span class="requisition_text"><?php echo $rejection_list->challan_date; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->invoice_date)
                            <div class="col-md-6">
                                <span class="requisition_header">Invoice Date : </span><span class="requisition_text"><?php echo $rejection_list->invoice_date; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->invoice_no)
                            <div class="col-md-6">
                                <span class="requisition_header">Invoice No : </span><span class="requisition_text"><?php echo @$rejection_list->invoice_no; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->invoice_value)
                            <div class="col-md-6">
                                <span class="requisition_header">Invoice Value : </span><span class="requisition_text"><?php echo @$rejection_list->invoice_value; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->po_value)
                            <div class="col-md-6">
                                <span class="requisition_header">PO. Value : </span><span class="requisition_text"><?php echo @$rejection_list->po_value; ?></span>
                            </div>
                            @endisset
                            @isset($rejection_list->note)
                            <div class="col-md-12">
                                <span class="requisition_header">Note : </span><span class="requisition_text">{{@$rejection_list->note}}</span>
                            </div>
                            @endisset

                        </div>


                    </div>
                    <?php $qr_details = 'GRM No. - ' . @$rejection_list->return_prefix . '' . @$rejection_list->return_id . ' , GRM Date - ' . date('d-m-Y h:i', strtotime(@$rejection_list->rejection_date)) . ' , Generated By - ' . @$rejection_list->name; ?>
                    <div class="col-md-4">
                        <div class="col-md-6">
                            {!! QrCode::size(100)->generate($qr_details) !!}
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
                            <th>Req No.</th>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Manufacturer</th>
                            <th>Quantity</th>
                            <th>GST</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($rejection_item) && $rejection_item != '')
                        @foreach($rejection_item as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{@$item->req_id}}</td>
                            <td>{{@$item->item_name}}<br>({{@$item->item_description}})</td>
                            <td>{{@$item->item_brand_name}}</td>
                            <td>{{@$item->manufacture_name}}</td>
                            <td>{{@$item->quantity}} {{@$item->units}}</td>
                            <td>{{@$item->gst}}</td>
                            <td>{{@$item->rate}}</td>
                            <td>{{@$item->amount}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <hr>

            </div><!-- bd -->
        </div>
    </div>
</div>











@endsection