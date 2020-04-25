<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
	}
	public function index()
	{
		$this->session->sess_destroy();
		$data['response'] = array(
			'statusCode' => 00,
			'message' => 'Anda Telah Keluar'
		);
		$this->load->view('Login/Index', $data);
	}
}

/* End of Login Controllername.php */
