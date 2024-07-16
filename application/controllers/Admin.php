<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
		$this->load->model('User_model', 'users');
		$this->load->model('Guest_model', 'guest');

        if(!$this->session->userdata('user_id') || $this->session->userdata('role') == 1 ){
            redirect('login');
        }

    }

    public function index(){
        $data['title'] = 'Dashboard';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        //content
        $data['room_count'] = $this->admin->get_active_rooms_count();
        $data['specific_room_count'] = $this->admin->get_specific_rooms_count();
        $data['pending_reservations_count'] = $this->admin->get_pending_reservations_count();
        $data['cancel_reservations_count'] = $this->admin->get_cancel_reservations_count();
        $data['confirm_reservations_count'] = $this->admin->get_confirm_reservations_count();
        $data['guest_count'] = $this->admin->get_guest_count();
        $data['current_guest_count'] = $this->admin->get_current_guest_count();

        $this->load->view('admin/pages/dashboard', $data);
    }

    public function floor(){
        $data['title'] = 'Floor';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['floors'] = $this->admin->get_floors();
        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/maintenance/floors', $data);
    }

    public function managefloor() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('floorcode', 'Floor Code', 'required');
            $this->form_validation->set_rules('floorname', 'Floor Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            // Check if validation passes
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, return validation errors
                $response = [
                    'status' => 'error',
                    'errors' => validation_errors()
                ];
            } else {
                // If validation passes, proceed to save the data
                $data = array(
                    'floor_code' => $this->input->post('floorcode'),
                    'floor_name' => $this->input->post('floorname'),
                    'description' => $this->input->post('description')
                );
                
                $id = $this->input->post('id');

                if ($id) {
                    // Update existing category
                    if ($this->admin->update_floors($id, $data)) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Floor Updated Successfully',
                            'redirect' => site_url('floor')
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'errors' => 'Failed to Update Floor'
                        ];
                    }
                } else {
                    // Save data to database
                    $result = $this->admin->save_floors($data);
            
                    if ($result) {
                        // If data is saved successfully, return success message
                        $response = array(
                            'status' => 'success',
                            'message' => 'Floor Saved Successfully',
                            'redirect' => site_url('floor')
                        );
                    } else {
                        // If data is not saved, return error message
                        $response = array(
                            'status' => 'error',
                            'errors' => 'Failed to Save Floor'
                        );
                    }


                }
                
            }
        } 
        
        // Return JSON response
        echo json_encode($response);
    }
    
    public function deletefloor($id) {
        
        // Attempt to delete the room type from the database
        if ($this->admin->delete_floor($id)) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted Sucessfully',
                'redirect' => site_url('floor')
            );
        }else {
            $response = array(
                'status' => 'error',
                'errors' => 'Failed to Delete Floor',
            );
        }
        
        echo json_encode($response);
    }

 
    public function roomtype(){
        $data['title'] = 'Room Type';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['roomtypes'] = $this->admin->get_roomtypes();

        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/maintenance/roomtypes', $data);
    }

    public function manageroomtype() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('roomtypename', 'Room Type Name', 'required');

            // Check if validation passes
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, return validation errors
                $response = [
                    'status' => 'error',
                    'errors' => validation_errors()
                ];
            } else {
                // If validation passes, proceed to save the data
                $data = array(
                    'roomtype_name' => $this->input->post('roomtypename')
                );
                
                $id = $this->input->post('id');

                if ($id) {
                    // Update existing category
                    if ($this->admin->update_roomtypes($id, $data)) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Room Type Updated Successfully',
                            'redirect' => site_url('roomtypes')
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'errors' => 'Failed to Room Type'
                        ];
                    }
                } else {
                    // Save data to database
                    $result = $this->admin->save_roomtypes($data);
            
                    if ($result) {
                        // If data is saved successfully, return success message
                        $response = array(
                            'status' => 'success',
                            'message' => 'Room Type Saved Successfully',
                            'redirect' => site_url('roomtypes')
                        );
                    } else {
                        // If data is not saved, return error message
                        $response = array(
                            'status' => 'error',
                            'errors' => 'Failed to Save Room Type'
                        );
                    }


                }
                
            }
        } 
        
        // Return JSON response
        echo json_encode($response);
    }
    
    public function deleteroomtype($id) {
        
        // Attempt to delete the room type from the database
        if ($this->admin->delete_roomtypes($id)) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted Sucessfully',
                'redirect' => site_url('roomtypes')
            );
        }else {
            $response = array(
                'status' => 'error',
                'errors' => 'Failed to Delete Room Types',
            );
        }
        
        echo json_encode($response);
    }

    public function room(){
        $data['title'] = 'Room';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['rooms'] = $this->admin->get_rooms();
        $data['floors'] = $this->admin->get_floors();
        $data['roomtypes'] = $this->admin->get_roomtypes();

        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/maintenance/rooms', $data);
    }

    public function manageroom() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('roomname', 'Room Name', 'required');
            $this->form_validation->set_rules('roomprice', 'Room Price', 'required|numeric');
            $this->form_validation->set_rules('roomtype_id', 'Room Type', 'required');
            $this->form_validation->set_rules('floor_id', 'Floor', 'required');
            $this->form_validation->set_rules('amenities', 'Amenities', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
        
            // Check if validation passes
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, return validation errors
                $response = [
                    'status' => 'error',
                    'errors' => validation_errors()
                ];
            } else {
                // If validation passes, proceed to save the data
                $data = [
                    'room_name' => $this->input->post('roomname'),
                    'amenities' => $this->input->post('amenities'),
                    'roomtype_id' => $this->input->post('roomtype_id'),
                    'price' => $this->input->post('roomprice'),
                    'floor_id' => $this->input->post('floor_id'),
                    'status' => $this->input->post('status'),
                ];

                if (!empty($_FILES['image']['name'])) {
                    $config = [
                        'upload_path' => './uploads/rooms',
                        'allowed_types' => 'gif|jpg|jpeg|png',
                        'max_size' => 2048, // Increased max_size for better handling
                    ];
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('image')) {
                        $uploadData = $this->upload->data();
                        $data['image'] = $uploadData['file_name'];
                    } else {
                        $response = [
                            'status' => 'error',
                            'errors' => $this->upload->display_errors()
                        ];
                        echo json_encode($response);
                        return;
                    }
                }
                
                $id = $this->input->post('id');

                if ($id) {
                    // Update existing category
                    if ($this->admin->update_rooms($id, $data)) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Room Updated Successfully',
                            'redirect' => site_url('room')
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'errors' => 'Failed to Update Room'
                        ];
                    }
                } else {
                    // Save data to database
                    $result = $this->admin->save_rooms($data);
            
                    if ($result) {
                        // If data is saved successfully, return success message
                        $response = [
                            'status' => 'success',
                            'message' => 'Room Saved Successfully',
                            'redirect' => site_url('room')
                        ];
                    } else {
                        // If data is not saved, return error message
                        $response = [
                            'status' => 'error',
                            'errors' => 'Failed to Save Room'
                        ];
                    }
                }
            }
        } 
        
        // Return JSON response
        echo json_encode($response);
    } 

    public function deleteroom($id) {
        // Fetch the room type data
        $room = $this->admin->get($id);
        
        $filename = $room->image;
        
        $imagePath = './uploads/rooms/' . $filename;

        // Attempt to delete the room type from the database
        if ($this->admin->delete_rooms($id) && unlink($imagePath)) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted Sucessfully',
                'redirect' => site_url('room')
            );
        }else {
            $response = array(
                'status' => 'error',
                'errors' => 'Failed to Delete Room',
            );
        }
        
        echo json_encode($response);
    }

    public function checkin(){
        $data['title'] = 'Checkin';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['rooms'] = $this->admin->get_rooms();
        $data['floors'] = $this->admin->get_floors();
        $data['roomtypes'] = $this->admin->get_roomtypes();


        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/bookings/checkin', $data);
    }

    public function addcheckin() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('days', 'Days', 'required|numeric');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'required|numeric');
        $this->form_validation->set_rules('checkin', 'Check-in Date and Time', 'required');
        $this->form_validation->set_rules('room_id', 'Room', 'required');


        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => 'error',
                'errors' => validation_errors()
            ];
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contactno');
            $date_in = $this->input->post('checkin'); 
            $days = $this->input->post('days');
            $room_id = $this->input->post('room_id');

            $room_price = $this->admin->get_price($room_id);
            $total_price = $room_price * $days;

            // Calculate the date_out based on date_in and days
            $date_out = date('Y-m-d H:i:s', strtotime("$date_in +$days days"));

            // Prepare data array for database insertion
            $data = array(
                'name' => $name,
                'phone' => $contact_no,
                'email' => $email,
                'checkin' => $date_in,
                'checkout' => $date_out,
                'days' => $days,
                'payment' => $total_price,
                'status' => 1, // Assuming '1' indicates an active or checked-in status
                'room_id' => $room_id
            );

            if ($this->admin->insert_checkin($data)) {
                // Update room status to booked
                $room_id = $this->input->post('room_id');
                $this->admin->update_status($room_id);

                $response = [
                    'status' => 'success',
                    'message' => 'Check-in Successfully',
                    'redirect' => site_url('checkin')
                ];
                
            } else {
                $response = [
                    'status' => 'error',
                    'errors' => 'Failed to Check-in! Please Check',
                    'redirect' => site_url('checkin')
                ];

            }
        }

        echo json_encode($response);
    }

    public function checkout(){
        $data['title'] = 'Checkout';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');
        $data['rooms'] = $this->admin->get_rooms();
        $data['floors'] = $this->admin->get_floors();
        $data['roomtypes'] = $this->admin->get_roomtypes();
        $data['guests'] = $this->admin->get_guest();

        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/bookings/checkout', $data);
    }

    public function checkoutguest($guest_id) {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the room ID from the POST data
            $room_id = $this->input->post('room_id');
            
            // Perform the checkout operation
            $result = $this->admin->checkout($guest_id);
            
            // Update the room status to available
            $this->admin->update_room_status($room_id, '0');

            if ($result) {
                // Checkout successful
                $response = array(
                    'status' => 'success',
                    'message' => 'Checkout successful',
                    'redirect' => site_url('checkout') // Redirect to success page
                );
            } else {
                // Checkout failed
                $response = array(
                    'status' => 'error',
                    'errors' => 'Checkout failed!'
                );
            }
            // Send the response as JSON
            echo json_encode($response);
        }
        
    }

    public function users(){
        $data['title'] = 'Users';
        $data['users'] = $this->admin->get_users();
        $data['user_id'] = $this->session->userdata('user_id');

        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

        $this->load->view('admin/personnel/users', $data);
    }

    public function adduser() {
        // Initialize the response array
        $response = [];
    
        // Check if the form is submitted
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
        
            // Check if validation passes
            if ($this->form_validation->run() == FALSE) {
                // If validation fails, return validation errors
                $response = [
                    'status' => 'error',
                    'errors' => validation_errors()
                ];
            } else {
                // If validation passes, proceed to save the data
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role' => $this->input->post('role'),
                );
                
                if (!empty($_FILES['image']['name'])) {
                    $config = [
                        'upload_path' => './uploads/avatars',
                        'allowed_types' => 'gif|jpg|jpeg|png',
                        'max_size' => 2048, // Increased max_size for better handling
                    ];
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('image')) {
                        $uploadData = $this->upload->data();
                        $data['image'] = $uploadData['file_name'];
                    } else {
                        $response = [
                            'status' => 'error',
                            'errors' => $this->upload->display_errors()
                        ];
                        echo json_encode($response);
                        return;
                    }
                }
                
                $result = $this->admin->insert_user($data); // Save data to database
                
                // Debugging output
                if ($result) {
                    $response = [
                        'status' => 'success',
                        'message' => 'User Added Successfully',
                        'redirect' => site_url('users')
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'errors' => 'Failed to Add User'
                    ];
                }
            }
        } 
    
        // Return JSON response
        echo json_encode($response);
    }

    public function deleteuser($id) {
        // Fetch the room type data
        $users = $this->admin->getuser($id);
        
        $filename = $users->image;
        
        $imagePath = './uploads/avatars/' . $filename;

        // Attempt to delete the room type from the database
        if ($this->admin->delete_user($id) && unlink($imagePath)) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted Sucessfully',
                'redirect' => site_url('users')
            );
        }else {
            $response = array(
                'status' => 'error',
                'errors' => 'Failed to Delete User',
            );
        }
        
        echo json_encode($response);
    }

    public function reservation()
	{
		
		$data['title'] = 'Reservation List';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();
		$data['rooms'] = $this->admin->get_rooms();
        $data['floors'] = $this->admin->get_floors();
        $data['roomtypes'] = $this->admin->get_roomtypes();
		$data['guests'] = $this->guest->get_guest();
		
        $user_id = $this->session->userdata('user_id');
        $data['role'] = $this->admin->get_user_role($user_id);

		$this->load->view('admin/pages/reservationlist', $data);
	}

    public function cancelbookAdmin($guest_id) {
        // Get the room ID from the POST data
        $room_id = $this->input->post('room_id');
        
        // Perform the checkout operation
        $result = $this->guest->cancel($guest_id);
        
        // Update the room status to available
        $this->guest->update_room_status($room_id, '0');

        if ($result) {
            // Checkout successful
            $response = array(
                'status' => 'success',
                'message' => 'Cancel Successfully',
                'redirect' => site_url('reservation') // Redirect to success page
            );
        } else {
            // Checkout failed
            $response = array(
                'status' => 'error',
                'errors' => 'Failed to Cancel'
            );
        }
        // Send the response as JSON
        echo json_encode($response);
    
}


public function booked($guest_id) {
    // Get the room ID from the POST data
    $room_id = $this->input->post('room_id');
    
    // Perform the checkout operation
    $result = $this->admin->booked($guest_id);
    
    // Update the room status to available
    $this->admin->update_room_status($room_id, '1');

    if ($result) {
        // Checkout successful
        $response = array(
            'status' => 'success',
            'message' => 'Booked Successfully',
            'redirect' => site_url('reservation') // Redirect to success page
        );
    } else {
        // Checkout failed
        $response = array(
            'status' => 'error',
            'errors' => 'Failed to Booked'
        );
    }
    // Send the response as JSON
    echo json_encode($response);

}
public function reports()
{
    
    $data['title'] = 'Reports';
    $data['user_id'] = $this->session->userdata('user_id');
    $data['users'] = $this->users->get_users();
    $data['rooms'] = $this->admin->get_rooms();
    $data['floors'] = $this->admin->get_floors();
    $data['roomtypes'] = $this->admin->get_roomtypes();
    $data['guests'] = $this->guest->get_guest();
    
    $user_id = $this->session->userdata('user_id');
    $data['role'] = $this->admin->get_user_role($user_id);

    $this->load->view('admin/pages/reports', $data);
}
}
