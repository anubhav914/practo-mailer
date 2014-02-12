<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct(){
		session_start();
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('curl');
		$patients = json_decode($this->curl->simple_get('http://patients.apiary.io/patients'), true);
		$this->load->view('header');
		$this->load->view('mail', array('patients' => $patients["items"]));
		$this->load->view('footer');
	}

	public function send_mail(){
		try{
			$this->load->model('email');
			$users = $this->input->post('users', TRUE);
			$text = $this->input->post('text', TRUE);
			$subject = $this->input->post('subject', TRUE);
			array_push($users, "anubhav914@gmail.com");
			$this->mail($users, $text, $subject, $_SESSION['email']);
			$this->email->saveSendMails($users, $text, $subject, $_SESSION['email']);
			$this->output->set_output(json_encode(array('status' => 'success')));
		}
		catch(Exception $e){
			$this->output->set_output(json_encode(array('status' => 'fail', 'message' => $e->getMessage())));
		}
	}

	public function mail($users, $message, $subject, $from){
		if(!count($users))
			return;
		$to = $users[0];
		array_shift($users);
		$headers = array();
		$headers[] = "From: "  . $from;
		// Cc: birthdayarchive@example.com
		foreach ($users as $user) {
			$headers[] = "Cc: " . $user;
		}

		mail($to, $subject, $message, implode("\r\n", $headers));
	}
}
