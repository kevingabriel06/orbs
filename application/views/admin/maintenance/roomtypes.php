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
                            <h3 class="card-title">MANAGE ROOMTYPES</h3>
                        </div>
                        <div class="card-body">
                            <form id="roomtype-form" method="post">
                                <div id="messages2"></div>
                                <input type="hidden" name="id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="roomtypename" class="control-label">Room Type Name</label>
                                            <input type="text" name="roomtypename" id="roomtypename" class="form-control form-control-border" placeholder="Enter Room Type Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onclick="$('#roomtype-form').get(0).reset()">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="save-roomtype">Save changes</button>
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
                                            <th>Room Type Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($roomtypes as $roomtype): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $roomtype->roomtype_id; ?></td>
                                            <td class=""><p class="m-0 truncate-1"><?php echo $roomtype->roomtype_name ?></p></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    Action <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $roomtype->roomtype_id ?>" data-name="<?php echo $roomtype->roomtype_name; ?>" ><span class="fa fa-edit text-primary"></span> Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="javascript:void(0)"  onclick="confirmDelete('<?php echo site_url('roomtypes/delete/'.$roomtype->roomtype_id) ?>')"><span class="fa fa-trash text-danger"></span> Delete</a>
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
                $('#description').summernote({
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
                });

                // Handle form submission
                $('#roomtype-form').on('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    var formData = new FormData(this); // Create FormData object with form data

                    $.ajax({
                        url: '<?php echo site_url('roomtypes/manage'); ?>',
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

                    var floor = $('#roomtype-form');

                    // Populate form fields with data attributes
                    floor.find("[name='id']").val($(this).data('id'));
                    floor.find("[name='roomtypename']").val($(this).data('name'));
                });

            });

            function confirmDelete(url) {
                if (confirm("Are you sure you want to delete this Roomtype?")) {
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
