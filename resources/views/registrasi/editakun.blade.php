@extends('layout/main') 
@section('title','Edit Akun') 
@section('container')

<body >
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-lg-5 col-12 col-sm-8 mt-5">
                <div class="card" style="border-radius: 15px;background-color:#F5F5F5">
                    <div class="card-body d-flex justify-content-center">
                            <h4>Edit Akun</h4>     
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <h5 style="margin-top: -25px;">Inventaris Kantor</h5>
                        </div>
                    <center>
                        <img src="{{ asset('img/inventori.png') }}" style="width: 20%; height: 20%; margin-bottom: 1px; margin-top: 10px;" alt="" />
                    </center>
                    <div class="col-12">
                        @if(session('success'))
                            @include('sweetalert::alert')
                        @endif
                        @if(session('warning'))
                            @include('sweetalert::alert')
                        @endif
                        <form method="post" action="/edit_akun">
                            @csrf
                            <div class="form-group">
                                <input name="id" type="text" class="form-control" id="id" placeholder=" {{ Session::get('id') }}" style="border-radius: 30px;display: none;" value="{{ Session::get('id') }}" />
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" id="username" placeholder=" {{ Session::get('username') }}" style="border-radius: 30px;" readonly="" />
                            </div>
                            <!-- <div class="form-group">
                                <label>Old Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Old Password" style="border-radius: 30px;" />
                            </div> -->
                            <div class="form-group">
                                <label>New Password</label>
                                <input name="new_password" type="password" class="form-control" id="new_password" placeholder="New Password" style="border-radius: 30px;" />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" style="border-radius: 30px;" />
                            </div>
                            <input type="checkbox" onclick="show()" />
                            <span style="font-size: 12px;">
                                Show Password
                            </span>
                            <div class="col-12">
                                <hr style="height: 2px; border-width: 0; background-color: grey; opacity: 0.5;" />
                            </div>
                            <div class="col-12" style="padding-bottom: 25px;">
                                <button type="submit" class="btn btn-lg btn-block" style="background-color: #2c53c6; color: white; border-radius: 30px;">Edit Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function show() {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        var y = document.getElementById("confirm_password");
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
</script>
@endsection
