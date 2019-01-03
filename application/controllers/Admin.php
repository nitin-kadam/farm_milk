<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	//$page="usr/index";



public function __construct() {

	parent::__construct();

	 $this->load->database();
	 $this->load->helper(['form', 'url', 'security']);
	 $this->load->library(['form_validation', 'encryption','session']);
	 $this->load->model('User_model');
 
}


public function dash(){

    $this->load->view('admin/dashboard');

}


public function order(){

    $this->load->view('admin/product_order');

}

public function users(){

    $this->load->view('admin/users_details');

}


public function profit(){

    $this->load->view('admin/profit');

}









}//end admin controller function 