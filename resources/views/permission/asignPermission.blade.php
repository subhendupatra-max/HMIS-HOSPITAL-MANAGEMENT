@extends('layouts.layout')

@section('content')
  

<div class="card">
    <div class="card-header">
        <div class="card-title">Asign Permission To : {{ $role }} </div>
    </div>
    <div class="card-body">
         <ul class="list-group">
            @foreach ($all_permission as $item)
            <li class="list-group-item">
                {{ $item->name }}
                <div class="custom-control custom-switch pull-right ">
                    <input type="checkbox" class="permission custom-control-input form-control-lg" id="customSwitch1_{{$item->id}}" name="perm" data-id="{{ $item->name }}" data-role="{{ $role }}" @if($PermissionOfRole->contains($item->id)) checked @endif  type="checkbox" value="" id="flexCheckDefault_{{$item->id}}">
                    <label class="custom-control-label" for="customSwitch1_{{$item->id}}"></label>
                </div>
            </li>
            @endforeach 
        </ul>
    </div>
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <!-- Jquery js-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $(".permission").click(function (e) { 
            e.preventDefault();
            let role = $(this).data('role');
            let permission = $(this).data('id');

            if (role != "" && permission !="") {

                $.ajax({
                    type: "POST",
                    url: "{{ route('asignPermission') }}",
                    data: {
                            "_token":"{{ csrf_token() }}",
                            'role': role,
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