<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<body style="background-color: #79bd9a;">
    @if(session('warning'))
        @include('sweetalert::alert')
    @endif
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-12 col-sm-8 mt-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body d-flex justify-content-center">
                        <h4>Inventaris Kantor</h4>
                    </div>
                    <center>
                        <img style="width: 20%; height: 20%; margin-bottom: 17px; margin-top: -10px;"
                            src="{{ asset('img/paper.png') }}" />
                    </center>
                    <center>
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </center>
                    <div class="col-12">
                        <form method="post" action="{{ url('/cek_login') }}">
                            @csrf
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" id="username"
                                    placeholder="Username" style="border-radius: 30px;" />
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Password" style="border-radius: 30px;" />
                            </div>
                            <input type="checkbox" onclick="show()" />
                            <span style="font-size: 12px;">
                                Show Password
                            </span>

                    </div>
                    <div class="col-12">
                        <hr style="height: 2px; border-width: 0; background-color: grey; opacity: 0.5;" />
                    </div>
                    <div class="col-12" style="padding-bottom: 25px;">
                        <button type="submit" class="btn btn-lg btn-block"
                            style="background-color: #2c53c6; color: white; border-radius: 30px;">Login</button>
                    </div>
                    
                    </form>
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

</html>
