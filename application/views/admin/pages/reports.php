<!DOCTYPE html>
<html lang="en" style="height: auto;">

<head>
  <style>
    :root{
      --base_url: <?php echo base_url(); ?>;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?> | ORBS</title>
  <link rel="icon" href="" />
  
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/jqvmap/jqvmap.min.css'); ?>">
  
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/fullcalendar/main.css'); ?>">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/custom.css'); ?>">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
  
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/summernote/summernote-bs4.min.css'); ?>">
  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  
  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99;
      }
      to {
        opacity: 1;
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms;
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1;
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0;
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0;
    }
  </style>

  <!-- jQuery -->
  <script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
  
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
  
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url('plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
  
  <!-- Toastr -->
  <script src="<?php echo base_url('plugins/toastr/toastr.min.js'); ?>"></script>
  
  <script>
    var _base_url_ = '<?php echo base_url(); ?>';
  </script>
  
  <script src="<?php echo base_url('dist/js/script.js'); ?>"></script>


</head>

  <body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" style="height: auto;">
    <div class="wrapper">
      <?php $this->load->view('admin/layout/topbar'); ?>
      <?php $this->load->view('admin/layout/sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-3" style="min-height: 567.854px;">
        <!-- Main content -->
        <section class="content">
        <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <style>
                        #show-print{
                            display:none !important;
                        }
                    </style>
                        <div id="pdf"></div>
            <table class="table table-bordered" id="checkoutTable">
                <div id="messages"></div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Room Details</th>
                        <th>Name</th>
                        <th>Booking Details</th>
                        <th>Receipt</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($guests as $guest): ?>
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
                            
                            <style>
                                img#cimg, .cimg {
                                    max-height: 10vh;
                                    max-width: 6vw;
                                }
                            </style>

                            <td class="text-center">
                                <img src="<?php echo base_url('uploads/receipt/') . $guest->receipt; ?>" alt="" id="cimg"></td>
                            <td class="text-center">
                            <span class="badge 
                                <?php 
                                    switch ($guest->status) {
                                        case 1:
                                            echo 'badge-success';  // Check-in
                                            break;
                                        case 2:
                                            echo 'badge-info';  // Check-out
                                            break;
                                        case 3:
                                            echo 'badge-warning';  // Booked
                                            break;
                                        case 4:
                                            echo 'badge-danger';  // Cancelled
                                            break;
                                        default:
                                            echo 'badge-secondary';  // Default case
                                            break;
                                    }
                                ?>">
                                <?php 
                                    switch ($guest->status) {
                                        case 1:
                                            echo 'Check-in';
                                            break;
                                        case 2:
                                            echo 'Check-out';
                                            break;
                                        case 3:
                                            echo 'Booked';
                                            break;
                                        case 4:
                                            echo 'Cancelled';
                                            break;
                                        default:
                                            echo 'Pending';
                                            break;
                                    }
                                ?>
                            </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div></div></div></div>
            </div>
        </section>
        <!-- /.content -->
      </div>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<!-- JSZip for Excel export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfmake for PDF export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Buttons JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#checkoutTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "filter": true,
                    "pageLength": 5,
                    "lengthMenu": [5, 10, 15],
                    "dom": 'lBftrip',
                    "buttons": ['pdf'],
                    "columnDefs": [{
                        "targets": [2, 3, 5], // Targets the columns for Room Details, Name, Booking Details
                        "searchable": true,
                        "orderable": true,
                        "visible": true
                    }]
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

            function booking(url) {
                if (confirm("Are you sure you want to Booked?")) {
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
      <!-- /.content-wrapper -->
      <script>
  $(document).ready(function(){
    window.viewer_modal = function($src = ''){
      start_loader();
      var t = $src.split('.');
      t = t[1];
      if(t =='mp4'){
        var view = $("<video src='"+$src+"' controls autoplay></video>");
      }else{
        var view = $("<img src='"+$src+"' />");
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove();
      $('#viewer_modal .modal-content').append(view);
      $('#viewer_modal').modal({
        show:true,
        backdrop:'static',
        keyboard:false,
        focus:true
      });
      end_loader();
    };

    window.uni_modal = function($title = '' , $url='',$size=""){
      start_loader();
      $.ajax({
        url:$url,
        error:err=>{
          console.log();
          alert("An error occurred");
        },
        success:function(resp){
          if(resp){
            $('#uni_modal .modal-title').html($title);
            $('#uni_modal .modal-body').html(resp);
            if($size != ''){
              $('#uni_modal .modal-dialog').addClass($size+' modal-dialog-centered');
            }else{
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered");
            }
            $('#uni_modal').modal({
              show:true,
              backdrop:'static',
              keyboard:false,
              focus:true
            });
            end_loader();
          }
        }
      });
    };

    window._conf = function($msg='',$func='',$params = []){
      $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")");
      $('#confirm_modal .modal-body').html($msg);
      $('#confirm_modal').modal('show');
    };
  });
</script>

</div>
<!-- ./wrapper -->
<div id="libraries">
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url('plugins/sparklines/sparkline.js'); ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url('plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
  <script src="<?php echo base_url('plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('plugins/moment/moment.min.js'); ?>"></script>
  <script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
  <!-- FullCalendar -->
  <script src="<?php echo base_url('plugins/fullcalendar/main.js'); ?>"></script>
  <!-- overlayScrollbars -->
  <!-- <script src="<?php echo base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script> -->
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('dist/js/adminlte.js'); ?>"></script>
</div>
<div class="daterangepicker ltr show-ranges opensright">
  <div class="ranges">
    <ul>
      <li data-range-key="Today">Today</li>
      <li data-range-key="Yesterday">Yesterday</li>
      <li data-range-key="Last 7 Days">Last 7 Days</li>
      <li data-range-key="Last 30 Days">Last 30 Days</li>
      <li data-range-key="This Month">This Month</li>
      <li data-range-key="Last Month">Last Month</li>
      <li data-range-key="Custom Range">Custom Range</li>
    </ul>
  </div>
  <div class="drp-calendar left">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-calendar right">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-buttons">
    <span class="drp-selected"></span>
    <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button>
    <button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button>
  </div>
</div>
<div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>

    </div>
  </body>
</html>
