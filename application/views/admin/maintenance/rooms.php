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
                            <h3 class="card-title">MANAGE ROOMS</h3>
                        </div>
                        <div class="card-body">
                            <form id="room-form" method="post">
                                <div id="messages2"></div>
                                <input type="hidden" name="id" value="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="roomname" class="control-label">Room Name</label>
                                            <input type="text" name="roomname" id="roomname" class="form-control form-control-border" placeholder="Enter Room Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="roomprice" class="control-label">Room Price</label>
                                            <input type="number" name="roomprice" id="roomprice" class="form-control form-control-border" placeholder="Enter Room Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                <option value="0">Available</option>
                                                <option value="1">Unavailable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floor">Floor</label>
                                            <select class="form-control" id="floor" name="floor_id">
                                                <option value="">Select Floor</option>
                                                <?php foreach ($floors as $floor): ?>
                                                    <option value="<?php echo $floor->floor_id;?>">
                                                        <?php echo $floor->floor_name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>                                      
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="roomtype">Room Type</label>
                                            <select class="form-control" id="roomtypeId" name="roomtype_id">
                                                <option value="">Select Room Type</option>
                                                <?php foreach ($roomtypes as $roomtype): ?>
                                                    <option value="<?php echo $roomtype->roomtype_id;?>">
                                                        <?php echo $roomtype->roomtype_name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">Amenities</label>
                                    <textarea rows="3" name="amenities" id="amenities" class="form-control form-control-border text-right summernote"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" onchange="displayImg(this,$(this))">
                                </div>
                                <div class="form-group">
                                    <img src="" alt="" id="cimg">
                                </div>

                                <style>
                                    img#cimg, .cimg {
                                        max-height: 10vh;
                                        max-width: 6vw;
                                    }
                                </style>

                                <script>
                                    function displayImg(input,_this) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#cimg').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>

                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onclick="$('#room-form').get(0).reset()">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="save-floor">Save changes</button>
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
                                            <th>Amenities</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rooms as $room): ?>
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
                                            </td>
                                            <td class=""><p class="m-0 truncate-1"><?php echo $room->amenities ?></p></td>
                                            <td class="text-center"><?php echo "Php " . number_format($room->price, 2); ?></td>
                                            <td class="text-center">
                                                <span class="badge <?php echo $room->status == 0 ? 'btn-success' : 'btn-danger'; ?>">
                                                    <?php echo $room->status == 0 ? 'Available' : 'Unavailable'; ?>
                                                </span>
                                            </td>
                                            <td align="center">
                                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    Action <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $room->room_id ?>" data-name="<?php echo $room->room_name; ?>" data-price="<?php echo $room->price; ?>" data-roomtype="<?php echo $room->roomtype_id; ?>" data-floor="<?php echo $room->floor_id ?>" data-amenities="<?php echo $room->amenities?>" data-status="<?php echo $room->status ?>" data-image="<?php echo $room->image; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="javascript:void(0)"  onclick="confirmDelete('<?php echo site_url('rooms/delete/'.$room->room_id) ?>')"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                </div>
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
                // Initialize Summernote when modal is shown
                $('#amenities').summernote({
                    placeholder: 'Write the Amenities here.',
                    height: '30vh',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ol', 'ul', 'paragraph', 'height']],
                        ['view', ['undo', 'redo']]
                    ]
                });

                // Handle form submission
                $('#room-form').on('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    var formData = new FormData(this); // Create FormData object with form data

                    $.ajax({
                        url: '<?php echo site_url('rooms/manage'); ?>',
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


                $('.edit_data').click(function(){

                var room = $('#room-form');

                // Populate form fields with data attributes
                room.find("[name='id']").val($(this).data('id'));
                room.find("[name='roomname']").val($(this).data('name'));
                room.find("[name='roomprice']").val($(this).data('price'));
                room.find("[name='roomtype_id']").val($(this).data('roomtype'));
                room.find("[name='floor_id']").val($(this).data('floor'));
                room.find("[name='status']").val($(this).data('status'));
                room.find("#cimg").attr('src','<?php echo base_url('uploads/rooms/'); ?>'+$(this).attr('data-image'));

                // Fetch the description value from data attribute
                var descriptionValue = $(this).data('amenities');
                
                $('#amenities').summernote({
                    placeholder: 'Write the Floor Description here.',
                    height: '30vh',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ol', 'ul', 'paragraph', 'height']],
                        ['view', ['undo', 'redo']]
                    ]
                }).summernote('code', descriptionValue);
              });
            });

            function confirmDelete(url) {
                if (confirm("Are you sure you want to delete this Room?")) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        dataType: 'json', // Ensure the response is treated as JSON
                        success: function(response) {
                            if (response.status === 'error') {
                                $('#messages2').html('<div class="alert alert-danger">' + response.errors + '</div>');
                            } else if (response.status === 'success') {
                                $('#messages2').html('<div class="alert alert-success">' + response.message + '</div>');
                                setTimeout(function() {
                                    window.location.href = response.redirect;
                                }, 1000);
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#messages2').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                        }
                    });
                }
            }
        </script>
        <!-- End Modal -->

        <?php $this->load->view('admin/layout/footer.php'); ?>
    </div>
</body>
</html>
