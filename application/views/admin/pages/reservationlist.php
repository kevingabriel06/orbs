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
                        <th>Receipt</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($guests as $guest): ?>
                        <?php if($guest->status == 5): ?>
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
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item edit_data" href="javascript:void(0)"  onclick="booking('<?php echo site_url('reservation/booked/'.$guest->guest_id) ?>')"><span class="btn btn-warning">Booked</span> </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)"  onclick="cancelbooking('<?php echo site_url('reservation/cancel/'.$guest->guest_id) ?>')"><span class="btn btn-danger">Cancel</span></a>
                                </div>
                            </td>
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
      <?php $this->load->view('admin/layout/footer.php'); ?>
    </div>
  </body>
</html>
