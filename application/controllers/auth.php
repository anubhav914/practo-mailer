<?php

class Auth extends CI_Controller {

	public function login(){
		log_message('info', "login enabled");
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function logout(){
		session_destroy();
		redirect('/');
	}

	public function loginSuccess(){
		// $this->output->set_output(json_encode(array('resp' => 'success')));
		// log_message('info', json_encode($_POST));
		if($this->input->post('name') && $this->input->post('email')){
			session_start(); 
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['email'] = $_POST['email'];
			log_message('info', json_encode($_SESSION));
			$this->output->set_output(json_encode(array('status' => 'success')));
		}
		else{
			$this->output->set_output(json_encode(array('status' => 'fail')));
		}
	}

}