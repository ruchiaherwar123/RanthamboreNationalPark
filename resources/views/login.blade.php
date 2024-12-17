<html>
<head>
@include('backend_views.layouts.head')
<!-- <style>
  .fa-eye{
  position: absolute;
  top: 60%;
  right: 40%;
  cursor: pointer;
  color: black;
}
.fa-eye-slash{
  position: absolute;
  top: 60%;
  right: 40%;
  cursor: pointer;
  color: black;
}
</style> -->
</head>
<body>
  <div class="login-wrapper">
    <!-- @if (session('message'))
    <div class="alert alert-success d-flex justify-content-around mx-auto" style="position:absolute; margin-left:25%;">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times" style="color:black;" aria-hidden="true"></i></button>
    </div>
    @endif -->
    @if (session('error'))
    <div class="alert alert-danger d-flex justify-content-around mx-auto" style="position:absolute; margin-left:40%;">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times" style="color:black;" aria-hidden="true"></i></button>
    </div>
    @endif
        <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                    
                        <form action="{{url('login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="email">Email Address</label>
                                <input type="text" placeholder="Enter you registered email" name="email" class="form-control">
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" placeholder="Enter your password" name="password" id="passwordInputID" class="form-control">
                                <!-- <span ><i id="eyeChangeId" class="fa fa-eye" onclick="eyeEnableDisable()"></i></span> -->
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <button class="btn float-right btn-add">Login</button>
                                <!-- OR
  
                                <a class="btn btn-add" href="{{url('email')}}">
                                    Login with OTP
                                </a> -->

                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
				        <!-- <div class="d-flex justify-content-center">
                         Forgot your password?<a href="">Reset Password</a>
				         </div> -->
			        </div>
                </div>
                </div>
            </div>
            
        </div>
        @include('Includes.script')
    </body>
    <script>
    setTimeout(function() {
        var alertElements = document.querySelectorAll('.text-danger');

        alertElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }, 20000); // Adjust the timeout value (in milliseconds) as needed
    </script>
    <!-- <script type="text/javascript">
	function eyeEnableDisable() 
	{
	  var x = document.getElementById("passwordInputID"); 
	  var y = document.getElementById("eyeChangeId"); 
	  if (x.type === "password") 
	  {
	    x.type = "text";
	    y.classList.remove("fa-eye");
	    y.classList.add("fa-eye-slash");
	  } 
	  else 
	  {
		x.type = "password";
	    y.classList.remove("fa-eye-slash");
	    y.classList.add("fa-eye");
	  }
	}
</script> -->
</html>