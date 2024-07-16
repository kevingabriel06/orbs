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
                    <div class="box card card-outline card-primary rounded-0 shadow" >
                        <div class="box-body card-body">
                            <div id="messages"></div>
                            <div class="container-fluid">
                                <table class="table table-bordered table-hover table-striped" id="checkoutTable">
                                    <thead>
                                        <tr class="bg-gradient-primary text-light">
                                            <th>#</th>
                                            <th>Guest Information</th>
                                            <th>Room Details</th>
                                            <th>Booking Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($guests as $guest): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $guest->guest_id; ?></td>
                                            <td class="">
                                                <p class="m-0 truncate-1"><b>Name: </b><?php echo $guest->name ?></p>
                                                <p class="m-0 truncate-1"><b>Email: </b><?php echo $guest->email ?></p>
                                                <p class="m-0 truncate-1"><b>Phone: </b><?php echo $guest->phone ?></p>
                                            <td class="">
                                                <input type="hidden" name="room_id" value="<?php echo $guest->room_id ?>">
                                                <p class="m-0 truncate-1"><b>Floor Name: </b><?php 
                                                    // Fetch the room type name based on the type_id
                                                    $guest_id = $guest->guest_id; // Assuming you have the guest object

                                                    // Fetch the floor name using joins
                                                    $this->db->select('floors.floor_name');
                                                    $this->db->from('guest');
                                                    $this->db->join('rooms', 'guest.room_id = rooms.room_id');
                                                    $this->db->join('floors', 'rooms.floor_id = floors.floor_id');
                                                    $this->db->where('guest.guest_id', $guest_id);
                                                    $query = $this->db->get();
                                                    $result = $query->row();
                                                    
                                                    // Check if a matching floor name is found
                                                    if ($result) {
                                                        echo $result->floor_name;
                                                    } else {
                                                        echo 'Unknown';
                                                    }
                                                ?>
                                                </p>
                                                <p class="m-0 truncate-1"><b>Room Type Name: </b>
                                                    <?php
                                                        // Fetch the room type name based on the type_id
                                                        $guest_id = $guest->guest_id; // Assuming you have the guest object

                                                        // Fetch the floor name using joins
                                                        $this->db->select('room_types.roomtype_name');
                                                        $this->db->from('guest');
                                                        $this->db->join('rooms', 'guest.room_id = rooms.room_id');
                                                        $this->db->join('room_types', 'rooms.roomtype_id = room_types.roomtype_id');
                                                        $this->db->where('guest.guest_id', $guest_id);
                                                        $query = $this->db->get();
                                                        $result = $query->row();
                                                        
                                                        // Check if a matching floor name is found
                                                        if ($result) {
                                                            echo $result->roomtype_name;
                                                        } else {
                                                            echo 'Unknown';
                                                        }
                                                    ?>
                                                </p>
                                                <p class="m-0 truncate-1"><b>Room Name: </b>
                                                    <?php
                                                        // Fetch the room type name based on the type_id
                                                        $guest_id = $guest->guest_id; // Assuming you have the guest object

                                                        // Fetch the floor name using joins
                                                        $this->db->select('rooms.room_name');
                                                        $this->db->from('guest');
                                                        $this->db->join('rooms', 'guest.room_id = rooms.room_id');
                                                        $this->db->where('guest.guest_id', $guest_id);
                                                        $query = $this->db->get();
                                                        $result = $query->row();
                                                        
                                                        // Check if a matching floor name is found
                                                        if ($result) {
                                                            echo $result->room_name;
                                                        } else {
                                                            echo 'Unknown';
                                                        }
                                                    ?>
                                                </p>
                                            </td>
                                            <td class="text-center"><?php echo "Php " . number_format($guest->payment, 2); ?></td>
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
                                            <td align="center">
                                                <?php if ($guest): ?>
                                                    <?php if ($guest->status == 1): ?>
                                                        <button class="btn btn-sm btn-danger"  id="delete" onclick="checkout('<?php echo site_url('checkout/guest/'.$guest->guest_id) ?>')" type="button" >Check Out</button>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-primary view" type="button">View</button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
                    "order": [[0, "desc"]] 
                });
            });


            function checkout(url) {
                if (confirm("Confirm to Check-out!")) {
                    var room_id = $('input[name="room_id"]').val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: { room_id: room_id }, // Pass room_id as data to the controller
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'error') {
                                $('#messages').html('<div class="alert alert-danger">' + response.errors + '</div>');
                            } else if (response.status === 'success') {
                                $('#messages').html('<div class="alert alert-success">' + response.message + '</div>');
                                setTimeout(function() {
                                    window.location.href = response.redirect;
                                }, 1000);
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#messages').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                        }
                    });
                }
            }
        </script>

        <?php $this->load->view('admin/layout/footer.php'); ?>
    </div>
</body>
</html>
