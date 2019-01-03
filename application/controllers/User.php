<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	 $this->load->library(['form_validation', 'encryption','session']);
	 $this->load->model('User_model');
	
	 
 
}
// declare functoins--------------------//
	public function is_user()
	{
		if($this->session->userdata('user_id') !== "")
		{
			return TRUE;

		}
		else
		{
			return FALSE;
		}
	}
	public function get_user()
	{
		if($this->is_user() == TRUE)
		{
			return $this->session->userdata('user_id');
		}
		else
		{
			return FALSE;
		}	
	}

	// public function insert($table_name,$put_record)
	// {
	// 	 return $this->User_model->put($table_name,$put_record);
	// }


	// public function get_userproduct_data($value='')
	// {
		
	// }



// end decleare function-----------------//

	public function index()
	{

		 if($this->session->userdata('user_id') !=''){

			$this->load->view('usr/header');
			$this->load->view('offers');
			$this->load->view('usr/main');

			
			$this->load->view('usr/footer');
		 }
		else{
			redirect(base_url());
		}
	}
	public function delivery($id)
	{
		if(is_numeric($id)){
			$table_name="product";
		$where="product_id";
		
		
		$data['result']=$this->User_model->get_data($table_name,$where,$id);
			$this->load->view('usr/header');
	   $this->load->view('usr/delivery',$data);
	   $this->load->view('usr/footer');

		}
		elseif (!is_numeric($id) && $id=="checkout") {

$i=$this->cart->contents();
	// 		$table_name="product";
	// 	$where="product_id";
	// 	foreach ($i as $key) {
	// var_dump($key['id']);		}
		
	// 	$data['result']=$this->User_model->get_data($table_name,$where,$id);
			$this->load->view('usr/header');
	   $this->load->view('checkout');
	   $this->load->view('usr/footer');
			# code...
		}
	
	}
	// start delivery of product insert into database
	public function delivery_process()
	{
		if ($this->input->post('address') == "yes") {
			$id=$this->get_user();
			$table="users_register";
			$where="user_id";
			$get=$this->User_model->get_data($table,$where,$id);
			// echo $get->user_city;

			$put_record = array(
					 // delivery address details
				'city' =>$get->user_city,
				'area' =>$get->user_area,
				'address' =>$get->user_address,
				'pincode' =>$get->user_pincode,
				// end delivery address
				'user_id'=>$this->get_user(),// get user id
				'mobile' =>$get->user_mobile,
				// 'mobile' =>8685985658,
				// get product details
				'product_id' => $this->input->post('product_id'),
				'product_name' =>$this->input->post('product_name'),
				'product_quantity' =>$this->input->post('product_qty'),
				// 'product_quantity' =>2,
				'product_price' => $this->input->post('product_price'),
				'product_total' =>$this->input->post('product_total')
				// 'product_total' =>89
			);
			 $table_name="user_buy";
			$insert=$this->User_model->put($table_name,$put_record);
			if ($insert== TRUE) {
				echo "order succesfully inserted";
				# code...
			}
			else
			{
				echo "order succesfully not inserted";
			}
			
		}
		

		if ($this->input->post('address') == "no") {

			 $table_name="user_buy";
			$put_data=array(
				// delivery address details
				'city' =>$this->input->post('city'),
				'area' =>$this->input->post('area'),
				'address' =>$this->input->post('address1'),
				'pincode' =>$this->input->post('pincode'),
				// end delivery address
				'user_id'=>$this->get_user(),// get user id
				'mobile' =>$this->input->post('mob'),
				// 'mobile' =>8685985658,
				// get product details
				'product_id' => $this->input->post('product_id'),
				'product_name' =>$this->input->post('product_name'),
				'product_quantity' =>$this->input->post('product_qty'),
				// 'product_quantity' =>2,
				'product_price' => $this->input->post('product_price'),
				'product_total' =>$this->input->post('product_total')
				// 'product_total' =>89


				);
			$insert=$this->User_model->put($table_name,$put_data);
			if ($insert== TRUE) {
				echo "order succesfully inserted";
				# code...
			}
			else
			{
				echo "order succesfully not inserted";
			}
			

		}
		else{
			$put_data=array(
				// delivery address details
				'city' =>$this->input->post('city'),
				'area' =>$this->input->post('area'),
				'address' =>$this->input->post('address1'),
				'pincode' =>$this->input->post('pincode'),
				// end delivery address
				'user_id'=>$this->get_user(),// get user id
				'mobile' =>$this->input->post('mob'),
				// 'mobile' =>8685985658,
				// get product details
				'product_id' => $this->input->post('product_id'),
				'product_name' =>$this->input->post('product_name'),
				'product_quantity' =>$this->input->post('product_qty'),
				// 'product_quantity' =>2,
				'product_price' => $this->input->post('product_price'),
				'product_total' =>$this->input->post('product_total')
				// 'product_total' =>89


				);
			echo "<pre>";
			print_r($put_data);
			echo "</pre>";



		}	
	}
	// end delivery insert process


public function check_order()
{
	$put_record=array();
	$len=count($this->input->post('product_id'));
	if ($this->input->post('address') == "yes") 
	{
			
		$id=$this->get_user();
		$table="users_register";
		$where="user_id";
		$get=$this->User_model->get_data($table,$where,$id);

		for ($i=0; $i < $len ; $i++) 
		{ 
			
			$city[$i] =$get->user_city;
			$area[$i] =$get->user_area;
			$address[$i]=$get->user_address;
			$pincode[$i] =$get->user_pincode;
			// end delivery address
			$user_id[$i]=$this->get_user();// get user id
			$mobile[$i]=$get->user_mobile;

		}
	}
	if ($this->input->post('address') == "no")
	{
		for ($i=0; $i < $len ; $i++) 
				{ 
								
					$city[$i] =$this->input->post('city');
					$area[$i] =$this->input->post('area');
					$address[$i]=$this->input->post('address1');
					$pincode[$i] =$this->input->post('pincode');
					// end delivery address
					$user_id[$i]=$this->get_user();// get user id
					$mobile[$i]=$this->input->post('mob');

				}

	}


	for ($j=0; $j < $len; $j++)
	{ 
		$put_record[$j] = array(
					 // delivery address details
				'city' =>$city[$j],
				'area' =>$area[$j],
				'address' =>$address[$j],
				'pincode' =>$pincode[$j],
				// end delivery address
				'user_id'=>$user_id[$j],// get user id
				'mobile' =>$mobile[$j],
				// 'mobile' =>8685985658,
				// get product details
				'product_id' => $this->input->post('product_id')[$j],
				'product_name' =>$this->input->post('product_name')[$j],
				'product_quantity' =>$this->input->post('product_qty')[$j],
				// 'product_quantity' =>2,
				'product_price' => $this->input->post('product_price')[$j],
				'product_total' =>$this->input->post('product_total')[$j]
				// 'product_total' =>89
			);
	
	}

     		 $table_name="user_buy";
			$insert=$this->User_model->put_batch($table_name,$put_record);
			if ($insert== TRUE) {
				echo "order succesfully inserted";
				# code...
			}
			else
			{
				echo "order succesfully not inserted";
			}
			
		
		
	
}














public function profile()
	{
		$table_name="users_register";
		$where="user_id";
		$user_id=$this->session->userdata('user_id');
		
		$data['result']=$this->User_model->get_data($table_name,$where,$user_id);
		$this->load->view('usr/header');
	   $this->load->view('usr/profile',$data);
	   $this->load->view('usr/footer');
	
   }
	public function dashboard()
	{

	$this->load->view('usr/dashboard');
	
   }

	public function pay_bill()
	{
		$this->load->view('usr/header');
		$this->load->view('usr/Pay_table');
		$this->load->view('usr/footer');
		
	}
	
	
	public function order()
	{
		$table_name="user_buy";
		$where="user_id";
		$user_id=$this->get_user();
		
		$data['result']=$this->User_model->all_get_data($table_name,$where,$user_id);
		$this->load->view('usr/header');
		$this->load->view('usr/order',$data);
		$this->load->view('usr/footer');
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
	
		// redirect('User_controller/registration');
	}

} //end user function 


// ------redirect registration page------//
	public function registration()
	{
		$registration=TRUE;

		if($registration==TRUE)
		{
			 $page=$this->session->userdata('page');
			 $page_id=$this->session->userdata('page_id');
			 
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


// ------ end redirect registration page------//


//for subscribe plan function 

 public function subscribe(){
 	 $table_name="users_subscribe";
    $id=$this->get_user();
    $where="user_id";
    $data=$this->User_model->all_get_data($table_name,$where,$id);

foreach ($data as $item) {
      $fromDay=$item->from_today;
      $plan=$item->plan;

    $endDay=$item->from_till;
    # code...
}
$advert = array(
        'plan' => $plan,
        'startDay' => $fromDay,
        'endDay' => $endDay,
     );
    echo json_encode($advert);

    
         
}









// buy section start here 

public function user_buy(){

 if($this->session->userdata('user_id') !=''){

		$this->load->view('buy_user');
	   
		}else{

     	redirect('User/register');
	
	
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

			redirect('User/contact');

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



 // users updating section start here 



public function user_edit(){

    $id=$this->input->post('id');
     $set = array(

        'user_name' =>$this->input->post('username'),       
        'user_mobile' =>$this->input->post('')    

    );


}

	// public function subscribe($value='')
	// {
	// 	# code...
	// }


	
}//end controller function  