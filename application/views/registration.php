
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php $this->load->view('includes/header'); ?>
<body class="hold-transition ">
  <script>
    function start_loader() {
        $('body').append('<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div></div></div>');
    }
  </script>
  <style>
    html, body{
      height:calc(100%) !important;
      width:calc(100%) !important;
    }
    body{
      background-image: url('../images/11.jpg');
      background-size:cover;
      background-repeat:no-repeat;
    }
    .login-title{
      text-shadow: 2px 2px black
    }
    #login{
      flex-direction:column !important
    }
    #logo-img{
        height:150px;
        width:150px;
        object-fit:scale-down;
        object-position:center center;
        border-radius:100%;
    }
    #login .col-7,#login .col-5{
      width: 100% !important;
      max-width:unset !important
    }
  </style>
  <div class="h-100 d-flex align-items-center w-100" id="login">
    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
      <div class="w-100">
        <center><img src="../images/logo.jpg" alt="" id="logo-img"></center>
      </div>
      
    </div>
    <div class="col-5 h-100 bg-gradient">
      <div class="d-flex w-100 h-100 justify-content-center align-items-center">
        <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-primary rounded-0 shadow">
          <div class="card-header rounded-0">
            <h4 class="text-purple text-center"><b>Register</b></h4>
          </div>
          <div class="card-body rounded-0">
            <div id="messages"></div>
            <form id="register-frm" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <input type="text" class="form-control" autofocus name="firstname" placeholder="First Name" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="email" placeholder="Email" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-at"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div id="pass_match"></div>
              
              <style>
                  img#cimg {
                      height: 10vh;
                      width: 10vh;
                      object-fit: cover;
                      border-radius: 100% 100%;
                  }
              </style>

              <script>
                  $('[name="password"], [name="confirm_password"]').keyup(function() {
                      var pass = $('[name="password"]').val();
                      var cpass = $('[name="confirm_password"]').val();
                      if (cpass === '' || pass === '') {
                          $('#pass_match').attr('data-status', '');
                      } else {
                          if (cpass === pass) {
                              $('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>');
                          } else {
                              $('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>');
                          }
                      }
                  });

                  
                  function displayImg(input, _this) {
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function(e) {
                              $('#cimg').attr('src', e.target.result);
                          }

                          reader.readAsDataURL(input.files[0]);
                      }
                  }

              </script>

              <div class="input-group mb-3">
                <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" onchange="displayImg(this,$(this))">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-image"></span>
                  </div>
                </div>
              </div>
              <div class="form-group d-flex justify-content-center align-items-center">
                  <img src="" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">
              </div>
              <div class="row">
                <div class="col-8">
                  <a href="<?php echo site_url('home') ?>">Go to Website</a>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12 text-center">
                  <a href="<?php echo site_url('login') ?>">Click here to Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    function end_loader() {
        $('#preloader').fadeOut('fast', function() {
            $('#preloader').remove();
        });
    }
  })
</script>

<script>
    
    function end_loader() {
        $('#preloader').fadeOut('fast', function() {
            $('#preloader').remove();
        });
    }

    window.alert_toast = function(msg = 'TEST', bg = 'success', pos = 'top') {
        var Toast = Swal.mixin({
            toast: true,
            position: pos,
            showConfirmButton: false,
            timer: 3500
        });
        Toast.fire({
            icon: bg,
            title: msg
        });
    };

    $(document).ready(function() {
        $(document).ready(function(){
            $('#register-frm').on('submit', function(e){
                e.preventDefault();
                start_loader();

                var formData = new FormData(this);
                $.ajax({
                    url: '<?php echo site_url("registration/add"); ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        if (response.status == 'error') {
                            $('#messages').html('<div class="alert alert-danger">' + response.errors + '</div>');
                        } else if (response.status == 'success') {
                            $('#messages').html('<div class="alert alert-success">' + response.message + '</div>');
                            setTimeout(function(){
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                        end_loader();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the full error response
                        // Display a generic error message to the user
                        $('#messages').html('<div class="alert alert-danger">An unexpected error occurred. Please try again later.</div>');
                    }
                });
            });
        });
    });


</script>
</body>
</html>