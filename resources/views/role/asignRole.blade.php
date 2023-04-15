@extends('layouts.layout')

@section('content')
    @can('revoke roleToUser')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title  fs-3 fw-bolder" style="padding-left: 1%">Revoke Role</h5>
                <form action="{{ route('revokeRoleAction') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select User</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" id="revoke_role_user" name="revoke_role_user"
                                aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                @foreach ($userHaveRole as $userHaveRoles)
                                    <option value="{{ $userHaveRoles->id }}">
                                        {{ $userHaveRoles->name . '  (' . $userHaveRoles->email . ')' }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger roleOfEmployee fs-3 fw-bold"></small>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Revoke Role</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endcan
    @can('asign roleToUser')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fs-3 fw-bolder">Asign Role</h5>
                <form action="{{ route('asignRoleAction') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select User</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" name="user" aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                @foreach ($userDosentHaveRole as $userDosentHaveRoles)
                                    <option value="{{ $userDosentHaveRoles->id }}">
                                        {{ $userDosentHaveRoles->name . '  (' . $userDosentHaveRoles->email . ')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select Role</label>
                        <input type="hidden" name="hiddenRole" id="hiddenRole">
                        <div class="col-sm-10">
                            <select class="form-select form-control" name="role" aria-label="Default select example">
                                <option selected disabled>--Select--</option>
                                @foreach ($allRole as $allRoles)
                                    <option value="{{ $allRoles->name }}">{{ $allRoles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Asign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
@endsection
 
<!-- Jquery js-->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $("#revoke_role_user").change(function(e) {
            e.preventDefault();
            let user = $(this).val()

            $.ajax({
                type: "POST",
                url: "{{ route('getRole') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userId": user
                },
                success: function(response) {
                    console.log(response);

                    $.each(response, function(key, val) {
                        $(".roleOfEmployee").html("User Role Is :" + val);
                        $("#hiddenRole").val(val);
                    });

                }
            });
        });

    });
</script>
