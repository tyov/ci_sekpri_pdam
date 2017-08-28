<?php

session_start(); //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_database');
	}

	// Show login page
	public function index() {
		$this->load->view('login_form');
	}

	// Check for user login process
	public function user_login_process() {
		// echo "string";
		// exit;

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$username=$this->input->post('username');
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'));
		

			//$result = $this->login_database->login($data);
		$result=array();
		$result['error']="true";
			$loginData = $this->login_database->read_user_information($username);
			//print_r(count($loginData));
			//print_r($loginData);
			//exit;
			if(!$loginData==false && count($loginData[0])>0){
				$session_data = array(
					'username' => $loginData[0]['user_name'],
					'email' => $loginData[0]['user_email'],
					);
				$this->session->set_userdata('logged_in', $session_data);
				$result['error']="false";
				$result['message']='Login berhasil';
			}else{

				$result['message']='Login gagal';
			}
			//print_r($result);exit;
			echo json_encode($result);
		}
	

	// Logout from admin page
	public function logout() {

		// Removing session data
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}

}

?>