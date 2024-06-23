<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
		$this->load->helper('my_helper');
    }
	
	public function about()
	{
		$data['title'] = 'About Page';
		
		// Use the helper function
        $greeting = greet_user('John');
        // Pass the greeting to the view
		$data['greeting'] = $greeting;
		
		$this->load->view('layouts/header', $data);
		$this->load->view('about', $data);
		$this->load->view('layouts/footer');
	}
}
