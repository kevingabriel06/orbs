<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model', 'users');
		$this->load->model('Guest_model', 'guest');
        $this->load->model('Admin_model', 'admin');
        
		
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
}