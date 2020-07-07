@extends('layout/main') 
@section('title','Tambah Akun') 
@section('container')

<!-- <center>
    <h2 style="margin-top: 40px;">Registrasi</h2>
</center> -->
<!-- style="background: linear-gradient(to bottom, #76daa1 0%, #8e94f7 100%);" -->
<body >
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-lg-5 col-12 col-sm-8 mt-5">
                <div class="card" style="border-radius: 15px;background-color:#F5F5F5">
                    <div class="card-body d-flex justify-content-center">
                            <h4>Registrasi</h4>     
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <h5 style="margin-top: -20px;">Inventaris Kantor</h5>
                        </div>
                    <center>
                        <img src="{{ asset('img/inventori.png') }}" style="width: 20%; height: 20%; margin-bottom: 17px; margin-top: 10px;" alt="" />
                    </center>
                    <div class="col-12">
                        @if(session('success'))
                            @include('sweetalert::alert')
                        @endif
                        @if(session('warning'))
                            @include('sweetalert::alert')
                        @endif
                        <form method="post" action="/addAdmin">
                            @csrf
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" id="username" placeholder="Username" style="border-radius: 30px;" />
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" id="password" placeholder="Password" style="border-radius: 30px;" />
                            </div>
                            <input type="checkbox" onclick="show()" />
                            <span style="font-size: 12px;">
                                Show Password
                            </span>
                            <div class="col-12">
                                <hr style="height: 2px; border-width: 0; background-color: grey; opacity: 0.5;" />
                            </div>
                            <div class="col-12" style="padding-bottom: 25px;">
                                <button type="submit" class="btn btn-lg btn-block" style="background-color: #2c53c6; color: white; border-radius: 30px;">Registrasi</button>
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
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
