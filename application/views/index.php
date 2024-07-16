
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

<style>
  #header {
    height: 70vh;
    width: calc(100%);
    position: relative;
    top: -1em;
  }
  #header:before {
    content: "";
    position: absolute;
    height: calc(100%);
    width: calc(100%);
    background-image: url('../images/11.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
  #header > div {
    position: absolute;
    height: calc(100%);
    width: calc(100%);
    z-index: 2;
  }

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
    <?php // $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>

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
        <a href="./" class="navbar-brand">
          <img src="../images/logo.jpg" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span>Hotel</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?php echo site_url('home') ?>" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('rooms') ?>" class="nav-link">Rooms</a>
            </li>
            <?php foreach($users as $user): ?>
              <?php if($user_id == $user->user_id && $user->role == 1): ?>
                <li class="nav-item">
                    <a href="<?php echo site_url('reservelist') ?>" class="nav-link ">My Reservation</a>
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
      $(function() {
        // your script here
      });
    </script>
    <!-- end topbar -->

    <?php //if($_settings->chk_flashdata('success')): ?>
    <script>
      alert_toast("<?php //echo $_settings->flashdata('success') ?>", 'success');
    </script>
    <?php //endif; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-5" style="">
      <?php //if($page == "home" || $page == "about_us"): ?>
      <div id="header" class="shadow mb-4">
        <div class="d-flex justify-content-center h-100 w-100 align-items-center flex-column px-3">
          <h1 class="w-100 text-center site-title px-5"><?php //echo $_settings->info('name') ?></h1>
          <!-- <h3 class="w-100 text-center px-5 site-subtitle"><?php //echo $_settings->info('name') ?></h3> -->
        </div>
      </div>
      <?php //endif; ?>

      <!-- Main content -->
      <section class="content">
        <div class="container">
          <div class="col-lg-12 py-5">
            <div class="contain-fluid">
              <div class="card card-outline card-dark shadow rounded-0">
                <div class="card-body rounded-0">
                  <div class="container-fluid">
                    <h3 class="text-center">Welcome</h3>
                    <hr>
                    <div class="welcome-content">
                      <?php $this->load->view('home') ?>
                    </div>
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
