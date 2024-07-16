<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

<style>
  #top-Nav a.nav-link.active {
      color: #343a40;
      font-weight: 900;
      position: relative;
  }
  #top-Nav a.nav-link.active:before {
    content: "";
    position: absolute;
    border-bottom: 2px solid #343a40;
    width: 33.33%;
    left: 33.33%;
    bottom: 0;
  }
</style>

<?php $this->load->view('includes/header');?>

<body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
  <div class="wrapper">

    <!-- topbar -->
    <style>
      .user-img {
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
      }
      .btn-rounded {
        border-radius: 50px;
      }
    </style>

    <!-- Navbar -->
    <style>
      #login-nav {
        position: fixed !important;
        top: 0 !important;
        z-index: 1037;
        padding: 0.3em 2.5em !important;
      }
      #top-Nav {
        top: 2.3em;
      }
      .text-sm .layout-navbar-fixed .wrapper .main-header ~ .content-wrapper,
      .layout-navbar-fixed .wrapper .main-header.text-sm ~ .content-wrapper {
        margin-top: calc(3.6) !important;
        padding-top: calc(3.2em) !important;
      }
    </style>

    <nav class="w-100 px-2 py-1 position-fixed top-0 bg-dark text-light" id="login-nav">
      <div class="d-flex justify-content-between w-100">
        <div></div>
        <div>
        <?php if($this->session->has_userdata('user_id')): ?>
          <?php foreach ($users as $user): ?>
            <?php if ($user_id == $user->user_id): ?>
              <span class="mx-1">
                <img src="<?php echo base_url('uploads/avatars/') . $user->image; ?>" alt="User Avatar" id="student-img-avatar">
              </span>
              <span class="mx-3">Welcome, <?php echo $user->firstname ?></span>
              <span class="mx-1">
                <a href="<?php echo site_url('logout'); ?>"><i class="fa fa-power-off"></i></a>
              </span>
            <?php endif;?>
            <?php endforeach; ?>
            <?php else: ?>
              <a href="<?php echo site_url('login'); ?>" class="mx-2 text-light">Login</a>
            <?php endif; ?>
        </div>
      </div>
    </nav>

    <nav class="main-header navbar navbar-expand navbar-light border-0 text-sm bg-gradient-light" id='top-Nav'>
      <div class="container">
        <a href="<?php echo site_url('home') ?>" class="navbar-brand">
          <img src="<?php echo base_url('images/logo.jpg') ?>" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span>Hotel</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?php echo site_url('home') ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('rooms') ?>" class="nav-link active">Rooms</a>
            </li>
            <?php foreach($users as $user): ?>
              <?php if($user_id == $user->user_id && $user->role == 1): ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('reservelist') ?>" class="nav-link">My Reservation</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Profile</a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Right navbar links -->
        <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto"></div>
      </div>
    </nav>

    <!-- /.navbar -->
    <script>
      $(function(){
        // your script here
      });
    </script>
    <!-- end topbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-5">
      <!-- Main content -->
      <section class="content">
      <div class="container">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Reservation Form</h5>
            </div>
            <div class="card-body">
              <div id="messages2"></div>
              <form id="reserve-form" enctype="multipart/form-data" method="post" action="<?php echo site_url('reservation/submit'); ?>">
                <input type="hidden" name="id">
                <input type="hidden" name="room_id" value="<?php echo $room->room_id?>">
                
                <fieldset>
                  <legend class="text-muted">Reservation Date</legend>
                  <div class="row mb-3">
                    <div class="row mb-5">
                      <div class="col-md-5">
                        <label for="check_in" class="form-label">Check-in Date and Time</label>
                        <input type="datetime-local" name="check_in" id="check_in" min="<?= date('Y-m-d\TH:i', strtotime(date('Y-m-d H:i')." +1 day")) ?>" class="form-control form-control-sm" required>
                      </div>
                      <div class="col-md-2">
                        <label for="days" class="form-label">Days</label>
                        <input type="text" name="days" id="days" class="form-control form-control-sm" placeholder="Enter Days" >
                      </div>
                      <div class="col-md-5">
                        <label for="check_out" class="form-label">Check-out Date and Time</label>
                        <input type="datetime-local" name="check_out" id="check_out" class="form-control form-control-sm" disabled>
                      </div>
                    </div>

                </fieldset>
                <script>
                    document.getElementById('days').addEventListener('input', function() {
                      var checkIn = document.getElementById('check_in').value;
                      var days = parseInt(document.getElementById('days').value);

                      if (!isNaN(days) && checkIn) {
                        var checkInDate = new Date(checkIn);
                        checkInDate.setDate(checkInDate.getDate() + days);
                        
                        var checkOut = checkInDate.toISOString().slice(0, 16);
                        document.getElementById('check_out').value = checkOut;
                        document.getElementById('check_out').disabled = true;
                      }
                    });

                    document.getElementById('check_in').addEventListener('input', function() {
                      var days = parseInt(document.getElementById('days').value);
                      var checkIn = document.getElementById('check_in').value;

                      if (!isNaN(days) && checkIn) {
                        var checkInDate = new Date(checkIn);
                        checkInDate.setDate(checkInDate.getDate() + days);

                        var checkOut = checkInDate.toISOString().slice(0, 16);
                        document.getElementById('check_out').value = checkOut;
                        document.getElementById('check_out').disabled = true;
                      }
                    });
                  </script>

                <fieldset>
                  <legend class="text-muted">Reservor Details</legend>
                  <div class="row mb-3">
                    <div class="col-md-8">
                      <label for="fullname" class="form-label">Fullname</label>
                      <input type="text" name="fullname" id="fullname" class="form-control form-control-sm" placeholder="John D Smith" >
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="contact" class="form-label">Contact #</label>
                      <input type="text" name="contact" id="contact" class="form-control form-control-sm" placeholder="09xxxxxxxxxxx" >
                    </div>
                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="jsmith@sample.com" >
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <legend class="text-muted">Payment Details</legend>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <h5>Gcash Number: <strong>09xxxxxxxxxxx</strong></h5>
                    </div>
                    <div class="col-md-6">
                      <h5>Gcash Name: <strong>Anonymous</strong></h5>
                    </div>
                  </div>
                  <div class="row mb-3 justify-content-center">
                    <div class="col-md-12">
                      <label class="form-label">QR Code:</label>
                      <img src="<?php echo base_url('images/sample.png') ?>" alt="QR Code" class="img-thumbnail bg-gradient-dark" id="banner-img">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-12">
                      <label for="image" class="form-label">Upload Receipt for Payment</label>
                      <input type="file" name="image" id="image" class="form-control form-control-sm" accept=".jpg, .jpeg, .png, .pdf" >
                    </div>
                  </div>
                </fieldset>

                <div class="container mb-3">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="note-container bg-light p-3 border rounded">
                        <p class="note-text mb-0">Please make the payment and upload the proof of payment before submitting your reservation.</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group text-end">
                  <a class="btn btn-danger btn-sm" type="submit" href="<?php echo site_url('rooms')?>">Go Back</a>
                  <button class="btn btn-primary btn-sm" type="submit">Submit Reservation</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <style>
          .note-container {
            background-color: #f8d7da; /* Red background color, you can change this to any color you prefer */
            border: 1px solid #f5c6cb; /* Red border color, you can change this to match the background color */
            padding: 10px;
            border-radius: 5px;
          }

          .note-text {
            margin-bottom: 0; /* Remove default margin for paragraph inside the note container */
          }
        </style>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
          // Handle form submission
          $('#reserve-form').on('submit', function(e) {
              e.preventDefault(); // Prevent default form submission

              var formData = new FormData(this); // Create FormData object with form data

              $.ajax({
                  url: '<?php echo site_url('guest/reserve'); ?>',
                  type: 'POST',
                  data: formData,
                  contentType: false, // Important for FormData
                  processData: false, // Important for FormData
                  dataType: 'json', // Expected data type from the server
                  success: function(response) {
                      if (response.status == 'error') {
                          $('#messages2').html('<div class="alert alert-danger">' + response.errors + '</div>');
                      } else if (response.status == 'success') {
                          $('#messages2').html('<div class="alert alert-success">' + response.message + '</div>');
                          setTimeout(function() {
                              window.location.href = response.redirect; // Redirect after success
                          }, 1000);
                      }
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText); // Log the full error response to console
                      $('#messages2').html('<div class="alert alert-danger">An unexpected error occurred. Please try again later.</div>'); // Display a generic error message
                  }
              });
          }); 
      });
    </script>
    <?php $this->load->view('includes/footer') ?>
  </div>
</body>
</html>
