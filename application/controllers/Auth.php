<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

 public function __construct()
 {
  parent::__construct();

  // Load Auth_model for all methods in this controller
  $this->load->model('Auth_model', 'auth');
  $this->load->model('Admin_model', 'admin');
 }

 // Allow access to login and validation methods without redirection
 private function check_login() {
  if(!$this->session->userdata('user_id')) {
   redirect('login');
  }
 }

 public function login()
 {
  // If the user is already logged in, redirect to home
  if($this->session->userdata('user_id')) {
   redirect('home');
  }

  $data['title'] = 'Login';
  $this->load->view('login', $data);
 }

 public function validation()
 {
     // Set form validation rules for email and password
     $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
     $this->form_validation->set_rules('password', 'Password', 'required');
 
     // Check if the form validation passed
     if ($this->form_validation->run()) 
     {
         // Attempt to log in using the provided email and password
         $result = $this->auth->can_login($this->input->post('email'), $this->input->post('password'));
 
         // Check if the login was successful
         if ($result === 'Login Successful') 
         {
             // Retrieve the user's role from the session
             $role = $this->session->userdata('role');
 
             // Determine the redirect URL based on the user's role
             if ($role == 3 || $role == 2) 
             {
                $response = [
                    'status' => 'success',
                    'message' => 'Login Successfully',
                    'redirect' => site_url('dashboard'),
                ];
                
             } 
             elseif ($role == 1) 
             {
                $response = [
                    'status' => 'success',
                    'message' => 'Login Successfully',
                    'redirect' => site_url('home'),
                ];
             } 
             else 
             {
                 $response = [
                     'status' => 'error',
                     'errors' => 'Failed to Log In Role',
                 ];
             }
         } 
         else 
         {
             // Login failed, return the error message from can_login
             $response = [
                 'status' => 'error',
                 'errors' => $result,
             ];
         }
     } 
     else 
     {
         // Form validation failed, return the validation errors
         $response = [
             'status' => 'error',
             'errors' => validation_errors(),
         ];
     }
 
     // Return the response as JSON
     echo json_encode($response);
 }

 public function logout() {
  // Destroy the entire session data
  $this->session->sess_destroy();

  // Redirect to login page
  redirect('login');
 }

 public function register()
 {
  $data['title'] = 'Register';
  $this->load->view('registration', $data);
 }

 public function registration() {
    // Initialize the response array
    $response = [];

    // Check if the form is submitted
    if ($this->input->post()) {
        // Set validation rules
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
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
                'role' => 3
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
                    'message' => 'Register Successfully',
                    'redirect' => site_url('login')
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'errors' => 'Failed to Register'
                ];
            }
        }
    } 

    // Return JSON response
    echo json_encode($response);
}
}
