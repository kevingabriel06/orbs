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
                            <h3 class="card-title">MANAGE USERS</h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="userForm">
                                <div id="messages"></div>
                                <input type="hidden" name="id" value="">
                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="form-group">
                                            <label for="" class="control-label">First Name</label>
                                            <input type="text" name="firstname" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Last Name</label>
                                            <input type="text" name="lastname" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="personnel">Personnel</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="">Select Type Personnel</option>
                                                <option value="2"> Desk Personnel </option>
                                                <option value="3">Admin</option>
                                            </select>                                      
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image" onchange="displayImg(this,$(this))">
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center">
                                            <img src="" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control form-control-sm" name="email">
                                            <small id="msg"></small>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control form-control-sm" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" class="form-control form-control-sm" name="cpass">
                                            <small id="pass_match" data-status=''></small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-12 text-right justify-content-center d-flex box-footer" >
                                    <button class="btn btn-primary mr-2" type="submit">Save</button>
                                    <button class="btn btn-danger" type="button" onclick="$('#userForm').get(0).reset()">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                    <style>
                        img#cimg {
                            height: 15vh;
                            width: 15vh;
                            object-fit: cover;
                            border-radius: 100% 100%;
                        }
                    </style>

                    <script>
                        $('[name="password"], [name="cpass"]').keyup(function() {
                            var pass = $('[name="password"]').val();
                            var cpass = $('[name="cpass"]').val();
                            if (cpass === '' || pass === '') {
                                $('#pass_match').attr('data-status', '');
                            } else {
                                if (cpass === pass) {
                                    $('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>');
                                } else {
                                    $('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>');
                                }
                            }
                        });

                        function displayImg(input, _this) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#cimg').attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                    </script>

                    <div class="box card card-outline card-primary rounded-0 shadow" id="tableFloor">
                        <div class="box-body card-body">
                            <div class="container-fluid">
                                <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $user->user_id; ?></td>
                                            <td><?php echo $user->firstname." ".$user->lastname; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php 
                                                switch ($user->role) {
                                                    case 1:
                                                        echo 'Guest';
                                                        break;
                                                    case 2:
                                                        echo 'Desk Personnel';
                                                        break;
                                                    case 3:
                                                        echo 'Admin';
                                                        break;
                                                    default:
                                                        echo 'Unknown Role';
                                                        break;
                                                }
                                            ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger delete_room" type="button"  onclick="confirmDelete('<?php echo site_url('users/delete/'.$user->user_id) ?>')" >Delete</button>
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
             $(document).ready(function(){
                $('#userForm').on('submit', function(e){
                    e.preventDefault();

                    var formData = new FormData(this);
                    $.ajax({
                        url: '<?php echo site_url("users/add"); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            if (response.status == 'error') {
                                $('#messages').html('<div class="alert alert-danger">' + response.errors + '</div>');
                            } else if (response.status == 'success') {
                                $('#messages').html('<div class="alert alert-success">' + response.message + '</div>');
                                setTimeout(function(){
                                    window.location.href = response.redirect;
                                }, 1000);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Log the full error response
                            // Display a generic error message to the user
                            $('#messages').html('<div class="alert alert-danger">An unexpected error occurred. Please try again later.</div>');
                        }
                    });
                });
            });

            function confirmDelete(url) {
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        dataType: 'json', // Ensure the response is treated as JSON
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
