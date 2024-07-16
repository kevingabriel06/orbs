<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model', 'users');
		$this->load->model('Guest_model', 'guest');
        $this->load->model('Admin_model', 'admin');
        
		if(!$this->session->userdata('user_id') || $this->session->userdata('role') == 3 || $this->session->userdata('role') == 2  ){
            redirect('login');
        }
    }
	public function index()
	{
		
		$data['title'] = 'Home';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();

		$this->load->view('index', $data);
	}

	public function rooms()
	{
		
		$data['title'] = 'Rooms';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();

		$data['rooms'] = $this->users->get_rooms();
		$data['roomtypes'] = $this->users->get_roomtypes();

		$this->load->view('rooms', $data);
	}

	public function viewroom($id)
	{
		
		$data['title'] = 'View Room';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();
		
		$data['room'] = $this->users->getroom($id);

		$this->load->view('viewroom', $data);
	}

	public function reservelist()
	{
		
		$data['title'] = 'Reservation List';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();
		$data['rooms'] = $this->admin->get_rooms();
        $data['floors'] = $this->admin->get_floors();
        $data['roomtypes'] = $this->admin->get_roomtypes();
		$data['guests'] = $this->guest->get_guest();
		

		$this->load->view('reservelist', $data);
	}

	public function roomreserve($id)
	{
		
		$data['title'] = 'Room Reservation';
		$data['user_id'] = $this->session->userdata('user_id');
		$data['users'] = $this->users->get_users();
		$data['room'] = $this->users->getroom($id);
		

		$this->load->view('reserve', $data);
	}
	public function reserve() {
        $this->form_validation->set_rules('fullname', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('days', 'Days', 'required|numeric');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric');
        $this->form_validation->set_rules('check_in', 'Check-in Date and Time', 'required');
        $this->form_validation->set_rules('room_id', 'Room', 'required');


        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => 'error',
                'errors' => validation_errors()
            ];
        } else {
            $name = $this->input->post('fullname');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact');
            $date_in = $this->input->post('check_in'); 
            $days = $this->input->post('days');
            $room_id = $this->input->post('room_id');

            $room_price = $this->guest->get_price($room_id);
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
                'status' => 5, // Assuming '1' indicates an active or checked-in status
                'room_id' => $room_id,
				'user_id' => $this->session->userdata('user_id')
            );

			if (!empty($_FILES['image']['name'])) {
				$config = [
					'upload_path' => './uploads/receipt',
					'allowed_types' => 'gif|jpg|jpeg|png',
					'max_size' => 2048, // Increased max_size for better handling
				];
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$uploadData = $this->upload->data();
					$data['receipt'] = $uploadData['file_name'];
				} else {
					$response = [
						'status' => 'error',
						'errors' => $this->upload->display_errors()
					];
					echo json_encode($response);
					return;
				}
			}

            if ($this->guest->insert_checkin($data)) {
                // Update room status to booked
                $room_id = $this->input->post('room_id');
                $this->guest->update_status($room_id);

                $response = [
                    'status' => 'success',
                    'message' => 'Check-in Successfully',
                    'redirect' => site_url('rooms')
                ];
                
            } else {
                $response = [
                    'status' => 'error',
                    'errors' => 'Failed to Check-in! Please Check',
                ];

            }
        }

        echo json_encode($response);
    }
	
	public function cancelbook($guest_id) {
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
				   'redirect' => site_url('reservelist') // Redirect to success page
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
}
