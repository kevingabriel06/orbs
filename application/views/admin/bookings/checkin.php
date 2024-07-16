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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CHECKIN FORM</h3>
                        </div>
                        <div class="card-body">
                            <form id="checkin-form" method="post">
                                <div id="messages2"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name</label>
                                            <input type="text" name="name" id="roomname" class="form-control form-control-border" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contactno" class="control-label">Contact Number</label>
                                            <input type="number" name="contactno" id="contactno" class="form-control form-control-border" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email Address</label>
                                            <input type="text" name="email" id="email" class="form-control form-control-border" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_in">Check-in Date and Time</label>
                                            <input type="datetime-local" name="checkin" id="checkin" class="form-control" 
                                                value="<?php echo isset($meta['date_in']) ? date('Y-m-d\TH:i', strtotime($meta['date_in'])) : date('Y-m-d\TH:i'); ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="days" class="control-label">Days</label>
                                            <input type="number" name="days" id="days" class="form-control form-control-border" placeholder="Enter Days">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="room">Rooms</label>
                                            <select class="form-control" id="room" name="room_id">
                                                <option value="">Select Room</option>
                                                <?php foreach ($rooms as $room): ?>
                                                    <?php if ($room->status == 0): ?>
                                                        <option value="<?php echo $room->room_id;?>">
                                                            <?php echo $room->room_name; ?>
                                                        </option>
                                                        <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>                                      
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onclick="$('#checkin-form').get(0).reset()">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="save-floor">Check In</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box card card-outline card-primary rounded-0 shadow" id="tableFloor">
                        <div class="box-body card-body">
                            <div class="container-fluid">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr class="bg-gradient-primary text-light">
                                            <th>#</th>
                                            <th>Room Image</th>
                                            <th>Room Details</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rooms as $room): ?>
                                        <?php if($room->status == 0): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $room->room_id; ?></td>
                                            <td class="text-center">
                                                <img src="<?php echo base_url('uploads/rooms/') . $room->image; ?>" alt="" id="cimg"></td>
                                            <td class="">
                                                <p class="m-0 truncate-1"><b>Floor Name: </b><?php 
                                                    // Fetch the room type name based on the type_id
                                                    $floor_id = $room->floor_id;
                                                    $query = $this->db->get_where('floors', array('floor_id' => $floor_id));
                                                    $result = $query->row();

                                                    // Check if a matching room type is found
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
                                                        $roomtype_id = $room->roomtype_id;
                                                        $query = $this->db->get_where('room_types', array('roomtype_id' => $roomtype_id));
                                                        $result = $query->row();

                                                        // Check if a matching room type is found
                                                        if ($result) {
                                                            echo $result->roomtype_name;
                                                        } else {
                                                            echo 'Unknown';
                                                        }
                                                    ?>
                                                </p>
                                                <p class="m-0 truncate-1"><b>Room Name: </b><?php echo $room->room_name ?></p>
                                                <p class="m-0 truncate-1"><b>Amenities: </b><?php echo $room->amenities ?></p>
                                            </td>
                                            <td class="text-center"><?php echo "Php " . number_format($room->price, 2); ?></td>
                                            <td class="text-center">
                                                <span class="badge <?php echo $room->status == 0 ? 'btn-success' : 'btn-danger'; ?>">
                                                    <?php echo $room->status == 0 ? 'Available' : 'Unavailable'; ?>
                                                </span>
                                            </td>
                                            <td align="center">
                                                <button type="button" class="btn btn-sm btn-primary checkin_data" data-id ="<?php echo $room->room_id ?>" > Check-in
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <style>
                                    img#cimg, .cimg {
                                        max-height: 10vh;
                                        max-width: 6vw;
                                    }
                                </style>

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
                // Handle form submission
                $('#checkin-form').on('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    var formData = new FormData(this); // Create FormData object with form data

                    $.ajax({
                        url: '<?php echo site_url('checkin/guest'); ?>',
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


                $('.checkin_data').click(function(){

                var room = $('#checkin-form');

                // Populate form fields with data attributes
                room.find("[name='room_id']").val($(this).data('id'));

              });
            });

            
        </script>
        <!-- End Modal -->

        <?php $this->load->view('admin/layout/footer.php'); ?>
    </div>
</body>
</html>
