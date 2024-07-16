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
              <a href="<?php echo site_url('rooms') ?>" class="nav-link">Rooms</a>
            </li>
            <?php foreach($users as $user): ?>
              <?php if($user_id == $user->user_id && $user->role == 1): ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('reservelist') ?>" class="nav-link active">My Reservation</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link ">Profile</a>
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
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
          <table class="table table-bordered" id="checkoutTable">
            <div id="messages"></div>
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Room Details</th>
                      <th>Name</th>
                      <th>Booking Details</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    <?php foreach ($guests as $guest): ?>
                      <?php if($guest->user_id == $user_id): ?>
                      <tr>
                          <td class="text-center"><?php echo $guest->guest_id; ?></td>
                          <input type="hidden" name="guest_id" value="<?php echo $guest->guest_id ?>">
                          <td>
                          <input type="hidden" name="room_id" value="<?php echo $guest->room_id ?>">
                              <?php
                                  $result1 = $result2 = $result3 = null; // Initialize variables

                                  foreach($rooms as $room) {
                                      if ($guest->room_id == $room->room_id) { // Only show available rooms 
                                          // Fetch the floor name based on the floor_id
                                          $query = $this->db->get_where('floors', array('floor_id' => $room->floor_id));
                                          $result1 = $query->row();

                                          // Fetch the room type name based on the type_id
                                          $query = $this->db->get_where('room_types', array('roomtype_id' => $room->roomtype_id));
                                          $result2 = $query->row();

                                          // Fetch the room name based on the room_id
                                          $query = $this->db->get_where('rooms', array('room_id' => $room->room_id));
                                          $result3 = $query->row();
                                      }
                                  }
                              ?>
                              <?php if ($result1 && $result2 && $result3): ?>
                                  <p><b>Floor Name:</b> <?php echo $result1->floor_name; ?></p>
                                  <p><b>Room Type:</b> <?php echo $result2->roomtype_name; ?></p>
                                  <p><b>Room:</b> <?php echo $result3->room_name; ?></p>
                              <?php else: ?>
                                  <p>Unknown</p>
                              <?php endif; ?>
                          </td>
                          <td>
                              <p><b>Name:</b> <?php echo $guest->name; ?></p>
                              <p><b>Contact Number:</b> <?php echo $guest->phone; ?></p>
                              <p><b>Email:</b> <?php echo $guest->email; ?></p>
                          </td>
                          <td>
                              <p><b>Start Date:</b> <?php echo $guest->checkin; ?></p>
                              <p><b>End Date:</b> <?php echo $guest->checkout; ?></p>
                              <p><b>Days:</b> <?php echo $guest->days; ?></p>
                              <p><b>Payment Price:</b> Php <?php echo $guest->payment; ?></p>
                          </td>
                          <td class="text-center">
                            <span class="badge <?php
                                if ($guest->status == 3) {
                                    echo 'btn-warning'; // Booked
                                } elseif ($guest->status == 4) {
                                    echo 'btn-danger'; // Cancelled
                                } elseif ($guest->status == 5) {
                                    echo 'btn-secondary'; // Pending
                                } ?>">
                                <?php
                                if ($guest->status == 3) {
                                    echo 'Booked';
                                } elseif ($guest->status == 4) {
                                    echo 'Cancelled';
                                } elseif ($guest->status == 5) {
                                    echo 'Pending';
                                }
                                ?>
                            </span>
                          </td>
                          
                          <td class="text-center">
                              <button class="btn btn-sm btn-danger cancel-button" onclick="cancelbooking('<?php echo site_url('list/cancel/'.$guest->guest_id) ?>')" type="button" id="cancel-button" data-guest-id="<?php echo $guest->guest_id; ?>" >Cancel</button>
                          </td>
                          </>
                      </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
          </table>
          </div></div></div></div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>

      $(document).ready(function() {
          $('#checkoutTable').DataTable({
              "paging": true,
              "searching": true,
              "filter": true,
              "pageLength": 5,
              "lengthMenu": [5, 10, 15],
          });
      });

      function cancelbooking(url) {
        if (confirm("Are you sure you want to cancel?")) {
            var room_id = $('input[name="room_id"]').val();
            var guest_id = $('input[name="guest_id"]').val();
            $.ajax({
                url: url,
                method: 'POST',
                data: { room_id: room_id }, // Pass room_id as data to the controller
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        $('#messages').html('<div class="alert alert-danger">' + response.error + '</div>');
                    } else if (response.status === 'success') {
                        $('#messages').html('<div class="alert alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr, status, error);
                    $('#messages').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        }
    }
     
    </script>

    <?php $this->load->view('includes/footer') ?>
  </div>
</body>
</html>
