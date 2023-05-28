@extends('layouts.layout')

@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Charges List
                </div>
                @can('add charges')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a href="{{route('charges-add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Charges</a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
      @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Charges name</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                <th class="border-bottom-0">Standard Charges </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Description</th>
                                @can('delete charges','edit charges')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charges as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->charges_name}}</td>
                                <td>{{ @$item->charges_catagory->charges_catagories_name}}</td>
                                <td>{{ @$item->charges_sub_catagory->charges_sub_catagories_name}}</td>
                                <td>
                                    <?php
                                    $charge_with_type = DB::table('charges_with_charges_types')
                                    ->join('charge_types','charges_with_charges_types.charge_type_id','=','charge_types.id')
                                    ->where('charges_with_charges_types.charge_id',$item->id)
                                    ->get();
                                    if(@$charge_with_type[0]->charge_type_id != null){
                                        foreach($charge_with_type as $value){
                                            echo $value->charge_type_name." : ".$value->standard_charges." Rs<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>{{ @$item->date}}</td>
                                <td>{{ @$item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit charges')
                                            <a class="dropdown-item" href="{{ route('edit-charges-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete charges')
                                            <a class="dropdown-item" href="{{ route('delete-charges-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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