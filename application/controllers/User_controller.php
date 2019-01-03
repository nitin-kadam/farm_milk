<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

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



function __construct() {
	parent::__construct();

	 $this->load->database();
	 $this->load->helper(['form', 'url', 'security']);

	 $this->load->library(['form_validation', 'encryption','session','user_agent']);
	 $this->load->model('User_model');
	
}


public function index()

   {

		 if($this->session->userdata('user_id') !=''){

			$this->load->view('usr/index');
		 }
		else{
			redirect(base_url());
		}
	}


	public function dashboard()
	{

	$this->load->view('usr/dashboard');
	
   }

	
	
	public function home()
	{
		$this->load->view('usr/home');
	}
	
	public function order()
	{
		$this->load->view('usr/order');
	}
	
   //user register section

	public function register(){

	
        $this->load->view('header');
		$this->load->view('register_user');
        $this->load->view('footer');

 }
    public function user_add(){

	$password=SHA1($this->input->post('password'));

	 
	$data = array(

		'user_name' => $this->input->post('name'),
		'user_email '=> $this->input->post('email'),
		'user_password' => $password,
		'user_mobile'=> $this->input->post('mobile'),
		'user_city'=> $this->input->post('city'),
		'user_address'=>$this->input->post('address'),
		'user_area'=>$this->input->post('area'),
		'user_pincode'=>$this->input->post('pincode')

  	);

	$query=$this->User_model->add($data);
	
	if($query == FALSE)
	{
		echo "failed insert value";

	}
	else{
	
		$this->registration();
	}

} //end user function 


// ------redirect registration page------//
	public function registration()
	{
		$registration=TRUE;

		if($registration==TRUE)
		{
			 $page=$this->session->userdata('page');
			 
			 
			switch($page)
			{
				case "Guest":
				echo "<scritp> alert('registration is sccessfully..!')";
				$this->session->unset_userdata('page');
				$this->session->unset_userdata('page_id');
				redirect(base_url()."Main_controller/index");
				break;

				case "Product":
				echo "<scritp> alert('registration is sccessfully..!')";
				$this->session->unset_userdata('page');
				$this->session->unset_userdata('page_id');
				redirect(base_url()."Main_controller/view_product");
				break;
			   
				case "Subscribe":

				echo "<scritp> alert('registration is sccessfully..!')";
				$this->session->unset_userdata('page');
				$this->session->unset_userdata('page_id');
				redirect(base_url()."Main_controller/subscribe");
				break;

				default:
				echo "switch case failed!";
			}			
		}

	}



//user login process
public function process(){
	
  $log = array(
	
	'user_email'    => $this->input->post('email'),
	'user_password' => sha1($this->input->post('password'))
   );
 
   
	// Validate the user can login
	$result = $this->User_model->validate($log);


	// Now we verify the result
	if($result== FALSE){
		// If user did not validate, then show them login page again

	
		   
		$msg = '<font color=red>Invalid username and/or password.</font><br />';
		echo $msg;
		
		 redirect($this->agent->referrer());
	}else{
		// If user did validate, 
		// Send them to members area
		redirect(base_url().'User/index');
	return TRUE;
	}        
}
 


// buy section start here 

public function user_buy(){

 if($this->session->userdata('user_id') !=''){

		$this->load->view('buy_user');
	   
		}else{

     	redirect('User_controller/register');
	
	
	}
	   
}	  // contact us 
	  
 public function contact()
    {  
  
		$contactdata = array(


					'contact_name'=>$this->input->post('name'),
					'contact_telephone'=>$this->input->post('telephone'),
					'contact_email'=>$this->input->post('email'),
					'contact_subject'=>$this->input->post('subject'),
					'contact_message'=>$this->input->post('message')
			  );
			  
		  $query=$this->User_model->add_contact($contactdata);	  

		   if($query == FALSE)
		   {
            echo "something is wrong";
		   }
		   else{

			redirect('User_controller/contact');

		   }
}

function logout()
{
   

	 $this->session->unset_userdata('user_id');
	 $this->session->unset_userdata('user_name');
	 $this->session->unset_userdata('user_email');
	 
  
// var_dump($this->session->userdata());
     redirect(base_url());
}
// login process start

public function login_process(){
	
  $log = array(
	
	'user_email'    => $this->input->post('email'),
	'user_password' => sha1($this->input->post('password'))
   );
 
   
	// Validate the user can login
	$result = $this->User_model->validate($log);


	// Now we verify the result
	if($result== FALSE){
		// If user did not validate, then show them login page again
		
			return FALSE;   
		
	//  redirect(base_url());
	}else{
		// If user did validate, 
		// Send them to members area
		// redirect('user_controller/');
	return TRUE;
	}        
}


// user are login via buying product
	public function product_login()
	{
		$product_id=$this->input->post('product_id');
		$check_login=$this->login_process();
		if($check_login == FALSE)
		{
			$msg = '<font color=red>Invalid username and/or password.</font><br />';
			echo $msg;

		}
		else
		{
			redirect(base_url().'User/delivery/'.$product_id);
		
			

		}

	}
// end product login

	// User are login via checkout product

	public function checkout_login()
	{
		$checkout_id=$this->input->post('checkout_id');
		$check_login=$this->login_process();
		if($check_login == FALSE)
		{
			$msg = '<font color=red>Invalid username and/or password.</font><br />';
			echo $msg;

		}
		else
		{
			redirect(base_url().'User/delivery/'.$checkout_id);
		
			

		}
	}


	// end checkout login



	
}//end controller function  	