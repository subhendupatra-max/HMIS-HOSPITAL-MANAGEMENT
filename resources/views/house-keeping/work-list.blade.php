@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Work List </h4>
                </div>
                @can('add new house keeping work')
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" href="{{ route('add-new-house-keeping-work') }}"><i class="fa fa-plus"></i> Add </a>
                    </div>
                </div>
                @endcan
            </div>
        </div>

        <!-- ================================ Alert Message===================================== -->
        @include('message.notification')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="example">
                    <thead class="bg-primary text-white">
                        <tr class="border-left">
                            <th class="text-white">Work Id</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Work Details</th>
                            <th class="text-white">House Keeper Name</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (@$house_keeping_work[0]->id != null)
                        @foreach ($house_keeping_work as $value)
                        <?php $house_keeper = DB::table('house_keeping_users')->join('users','users.id','=','house_keeping_users.user_id')->where('house_keeping_id',$value->id)->get(); ?>
                        <tr>
                            <td>{{ @$value->id }}</td>
                            <td>
                                @if(isset($value->date))
                                {{ date('d-m-Y h:i A',strtotime($value->date)) }}
                                @endif
                            </td>
                            <td>
                                {{ @$value->working_details	 }}
                            </td>
                            <td>
                                @if (auth()->user()->can('work status change')) 
                                    @if(@$house_keeper[0]->id != null)
                                    @foreach ($house_keeper as $house_keep)
                                    {{ @$house_keep->first_name }} {{ @$house_keep->last_name }}<br>
                                    @endforeach 
                                    @else
                                    <span class="badge badge-success" >Assign House Keeper</span>
                                    @endif
                                @else
                                    @if(@$house_keeper[0]->id != null)
                                    @foreach ($house_keeper as $house_keep)
                                    {{ @$house_keep->first_name }} {{ @$house_keep->last_name }}<br>
                                    @endforeach 
                                    @else
                                    <span class="badge badge-success">Assign House Keeper</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->can('work status change'))    

                                    @if($value->status == 'incomplete')
                                    <a href="{{ route('change-status-houseing-allowence',
                                    ['status'=>'complete','work_id'=>$value->id ]) }}"><span class="badge badge-danger">{{ @$value->status }}</span></a>
                                    @else
                                    <a href="{{ route('change-status-houseing-allowence',
                                    ['status'=>'incomplete','work_id'=>$value->id ]) }}"><span class="badge badge-info">{{ @$value->status }}</span></a>
                                    @endif

                                @else

                                    @if($value->status == 'incomplete')
                                    <a href="#"><span class="badge badge-danger">{{ @$value->status }}</span></a>
                                    @else
                                    <a href="#"><span class="badge badge-info">{{ @$value->status }}</span></a>
                                    @endif

                                @endif

                            
                            </td>
                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                
                                        @can('edit work details')
                                        <a class="dropdown-item" href="{{ route('edit-new-house-keeping-work',base64_encode($value->id)) }}">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('delete work details')
                                        <a class="dropdown-item" href="{{ route('delete-new-house-keeping-work',base64_encode($value->id)) }}"><i class="fa fa-trash"></i> Delete</a>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" style="text-align: center;">
                                <img src="{{ asset('public/no_found_data/no_data.png') }}" alt="loader" width="400px"
                                height="160px">
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
        
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add House Keeper</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div> 
        <form action="{{ route('assign-house-keeper') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="work_id" id="work_id" />
                <div class="form-group col-md-12">
                    <select name="house_keeper[]" multiple="multiple"
                        class="form-control multi-select select2-show-search">
                        <option value="">Select House Keeper ....</option>
                        @if ($user_list)

                            @foreach ($user_list as $value)
                                <option value="{{ $value->id }}">{{ $value->first_name }}
                                    {{ $value->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo11211">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add House Keeper</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div> 
        <form action="{{ route('assign-house-keeper') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="work_id" id="work_id" />
                <div class="form-group col-md-12">
                    <select name="house_keeper[]" multiple="multiple"
                        class="form-control multi-select select2-show-search">
                        <option value="">Select House Keeper ....</option>
                        @if ($user_list)

                            @foreach ($user_list as $value)
                                <option value="{{ $value->id }}">{{ $value->first_name }}
                                    {{ $value->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>

    function assign_house_keeper(work_id)
    {
        $('#work_id').val(work_id);                                                                 
        $('#modaldemo1').modal('show');
    }
</script>
<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection