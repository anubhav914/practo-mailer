<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		session_start();
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('email');
		$result = array();
		if(isset($_SESSION['email']))
			$result = $this->email->getSentEmails($_SESSION['email']);
		$this->load->view('header');
		$this->load->view('home', array('emails'=>$result, 'user' => $_SESSION['email']));
		$this->load->view('footer');
	}

}