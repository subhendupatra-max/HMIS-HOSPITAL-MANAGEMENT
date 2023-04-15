@extends('layouts.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">Asign Permission To : {{ $userInfo->name }} </div>
    </div>
    <div class="card-body">
         <ul class="list-group">
            @foreach ($all_permission as $item)
            <li class="list-group-item">
                {{ $item->name }}
                <div class="custom-control custom-switch pull-right ">
                    <input type="checkbox" class="permission custom-control-input form-control-lg" id="customSwitch1_{{$item->id}}" name="perm" data-id="{{ $item->id }}" data-user="{{ $userInfo->id }}" @if($PermissionOfUser->contains($item->id)) checked @endif>
                    <label class="custom-control-label" for="customSwitch1_{{$item->id}}"></label>
                </div>
            </li>
            @endforeach 
        </ul>
    </div>
</div>

@endsection
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- Jquery js-->
   <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $(".permission").click(function (e) { 
            e.preventDefault();
            let userData = $(this).data('user');
            let permission = $(this).data('id');

            if (userData != "" && permission !="") {
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('PermissionAsignToUserAction') }}",
                    data: {
                            "_token":"{{ csrf_token() }}",
                            'Id': userData,
                            'permission': permission,            
                        },
                    success: function (response) {
                        if(response === "1"){
                            swal("Good job!", "Permission Asigned ", "success");
                            window.location.reload(2000);
                        }else{
                            swal("Good job!", "Permission Revoked ", "success");
                            window.location.reload(2000);
                        }
                    }
                });

            }else{
                swal("Something Went Wrong");
            }

        });
    });
</script>