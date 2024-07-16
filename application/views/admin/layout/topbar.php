<style>
  .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
  }
  .btn-rounded{
        border-radius: 50px;
  }
</style>
<!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark border  border-info border-top-0  border-left-0 border-right-0 text-sm shadow-sm bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <?php if($role == 3): ?>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"><b>Hotel - Admin</b></a>
          </li>
          <?php else : ?>
            <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"><b>Hotel - Desk Personnel</b></a>
          </li>
          <?php endif ; ?>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li> -->
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <div class="btn-group nav-link">
            <?php if($this->session->has_userdata('user_id')): ?>
            <?php foreach ($users as $user): ?>
                <?php if ($user_id == $user->user_id): ?>
                  <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span><img src="<?php echo base_url('uploads/avatars/') . $user->image; ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                    <span class="ml-3"><?php echo  $user->firstname ; ?></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="#"><span class="fa fa-user"></span> My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url('logout') ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                  </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
              </div>
          </li>
          <li class="nav-item">
            
          </li>
         <!--  <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.navbar -->