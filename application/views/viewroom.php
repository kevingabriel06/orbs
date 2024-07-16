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
          <style>
            #banner-img {
              object-fit: scale-down;
              object-position: center center;
            }
          </style>

          <div class="card card-outline card-primary rounded-0 shadow mb-5">
            <div class="card-header">
              <h4 class="card-title"><b>Room Details</b></h4>
              <div class="card-tools">
                <?php if($this->session->userdata('user_id')): ?>
                  <a href="<?php echo site_url('guest/reserveroom/'.$room->room_id)?>" class="btn btn-primary btn-sm btn-flat" type="button" id="reservationModalButton" data-room="<?php echo $room->room_id ?>">
                    <i class="fa fa-edit" ></i> Reserve
                </a>
                <?php else: ?>
                  <a class="btn btn-primary btn-sm btn-flat" href="<?php echo site_url('login'); ?>">
                    <i class="fa fa-edit"></i> Reserve
                  </a>
                <?php endif; ?>
                <a class="btn btn-light border btn-sm btn-flat" href="<?php echo site_url('rooms')?>">
                  <i class="fa fa-angle-left"></i> Back to List
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="row justify-content-center">
                  <div class="col-md-8 col-sm-12">
                    <img src="<?php echo base_url('uploads/rooms/') . $room->image; ?>" alt="Room Image" class="img-thumbnail bg-gradient-dark" id="banner-img">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <dl>
                      <dt class="text-muted">Room Name</dt>
                      <dd class='pl-4 fs-4 fw-bold'><?php echo $room->room_name?></dd>
                      <dt class="text-muted">Room Floor and Type</dt>
                      <dd class='pl-4 fs-4 fw-bold'>
                        <?php // Fetch the room type name based on the type_id
                            $floor_id = $room->floor_id;
                            $query = $this->db->get_where('floors', array('floor_id' => $floor_id));
                            $result = $query->row();

                            // Check if a matching room type is found
                            if ($result) {
                                echo $result->floor_name;
                            } else {
                                echo 'Unknown';
                            }
                          ?> | <?php
                          // Fetch the room type name based on the type_id
                          $roomtype_id = $room->roomtype_id;
                          $query = $this->db->get_where('room_types', array('roomtype_id' => $roomtype_id));
                          $result = $query->row();

                          // Check if a matching room type is found
                          if ($result) {
                              echo $result->roomtype_name;
                          } else {
                              echo 'Unknown';
                          }
                        ?></dd>
                    </dl>
                  </div>
                  <div class="col-md-6">
                    <dl>
                      <dt class="text-muted">Price</dt>
                      <dd class='pl-4 fs-4 fw-bold'><?php echo "Php " . number_format($room->price, 2); ?></dd>
                      <dt class="text-muted">Status</dt>
                      <dd class='pl-4 fs-4 fw-bold'>
                        <?php 
                          if ($room->status == 0) {
                            echo '<span class="px-4 badge badge-success rounded-pill">Active</span>';
                          } else {
                            echo '<span class="px-4 badge badge-danger rounded-pill">Inactive</span>';
                          }
                        ?>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <dt class="text-muted">Description</dt>
                    <div><?php echo $room->amenities ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('includes/footer') ?>
  </div>
</body>
</html>
