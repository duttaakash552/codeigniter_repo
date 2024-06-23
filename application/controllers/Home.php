<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->load->library('session');
        $this->load->model('user_model');
    }

	public function index()
	{
		$data['title'] = 'Home Page';
		
		$query = $this->user_model->get_user_list();
		
		// Store the result in a variable
        $data['results'] = $query->result();
		
		$this->load->view('layouts/header', $data);
		$this->load->view('home', $data);
		$this->load->view('layouts/footer');
	}
	
	public function insert() {
		$data['title'] = 'Home Page';
		
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload form
            $this->load->view('layouts/header', $data);
			$this->load->view('home');
			$this->load->view('layouts/footer');
        } else {
            // Validation succeeded, insert data into database
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone')
            );
            $insert_id = $this->user_model->insert_user($data); // Call the model method

            if ($insert_id) {
                // Set flashdata for success message
                $this->session->set_flashdata('message', 'User added successfully!');
                // Redirect to the form page
                redirect('/');
            } else {
                echo "Failed to add user.";
            }
        }
    }
	
	public function get_user_by_id() {
		$id = $this->input->post('id');
		$query = $this->user_model->get_user($id);
		
		$response = array('status' => 'success', 'result' => $query->row());
		
		// Send the response back to the client
        header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	public function update() {
		$id = $this->input->post('id');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone')
		);
		
		$query = $this->user_model->update_by_user_id($id, $data);
		if($query) {
			$this->session->set_flashdata('message', 'User updated successfully');
		}else {
			$this->session->set_flashdata('error', 'User update failed');
		}
		redirect('/');
	}
	
	public function delete() {
		$id = $this->input->post('id');
		$query = $this->user_model->delete_user($id);
		$this->session->set_flashdata('message', 'User deleted successfully');
		redirect('/');
	}
}
