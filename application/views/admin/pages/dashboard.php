<!DOCTYPE html>
<html lang="en" style="height: auto;">
<?php $this->load->view('admin/layout/header'); ?>
  <body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" style="height: auto;">
    <div class="wrapper">
      <?php $this->load->view('admin/layout/topbar'); ?>
      <?php $this->load->view('admin/layout/sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-3" style="min-height: 567.854px;">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <?php if($role == 3): ?>
            <h1>Welcome to the Admin Panel</h1>
            <?php else: ?>
            <h1>Welcome to the Desk Personnel Panel</h1>
            <?php endif; ?>
            <hr class="border-info">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-bed"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Active Room</span>
                    <span class="info-box-number text-right">
                      <?php echo $room_count; ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-bed"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Occupied Room</span>
                    <span class="info-box-number text-right">
                      <?php echo $specific_room_count; ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-table"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Pending Reservation</span>
                    <span class="info-box-number text-right">
                      <?php echo $pending_reservations_count; ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-table"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Confirmed Reservation</span>
                    <span class="info-box-number text-right">
                      <?php echo $confirm_reservations_count; ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-table"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Cancelled Reservation</span>
                    <span class="info-box-number text-right">
                      <?php echo $cancel_reservations_count; ?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Guest</span>
                    <span class="info-box-number text-right">
                      <?php echo $guest_count?>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="info-box bg-gradient-light shadow">
                  <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Current Guest</span>
                    <span class="info-box-number text-right">
                    <?php echo $current_guest_count; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php $this->load->view('admin/layout/footer.php'); ?>
    </div>
  </body>
</html>
