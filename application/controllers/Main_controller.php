<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

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
	public function index()
	{
		$this->load->view('index');
	}
	// includeing header and footer
	public function show($page)
	  {

			  $this->load->view('header');
			  $this->load->view($page);
			  $this->load->view('footer');
		
	
	       }


	// end show funtion

	public function gallary()
	{
		$this->show('gallery');
	}

	public function about()
	{
		$this->show('about');
	}

	public function contact()
	{
		$this->show('contact');
	}

	public function product()
	{
		$this->get_product();
	}

	
	public function view_product()
	{
		// echo "string";
		// $data = array('quanity' =>$this->input->post('product_quantity')  );
		// var_dump($data);
		// echo "string";
		$table_name="product";
		$where="product_id";
		$product_id= $this->input->post('product_id');
		$data['result']=$this->User_model->get_data($table_name,$where,$product_id);
		 $this->load->view('header');
		 $this->load->view('view_product',$data);
		 $this->load->view('footer');
	}

	public function subscribe()
	{
		$this->show('subscribe');
	}

	public function pay_bill()
	{
		$this->show('paybill_login');
	}
	
	public function agroturism()
	{
		$bs=base_url();

			redirect($bs.'ComingSoonBundle/Coming%20Soon/06-comming-soon.html');



	}

	 public function register(){

		 $this->show('register_user');
	 }



// ----add to cart-----//


  	function get_product(){

			$this->load->model('Product');
			$data['data']=$this->Product->get_all_product();
			$this->load->view('header');
	    	$this->load->view('show_products',$data);
            $this->load->view('footer');
		
		}

	function add_to_cart(){ 
	
		$data = array(
						'id' => $this->input->post('product_id'), 
						'name' => $this->input->post('product_name'), 
						'price' => $this->input->post('product_price'), 
						'qty' => $this->input->post('quantity')
						// 'image' => $this->input->post('image')

			           );
		
					 $this->cart->insert($data);
					  // echo $this->input->post('image');

	              	 echo $this->show_cart();

            	}

	function show_cart(){ 
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
			
		         <tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>

					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
				</tr>
			';
			 
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rs '.number_format($this->cart->total()).'</th>
			</tr>
			
		';
		return $output;
		
	}

	function load_cart(){ 
		echo $this->show_cart();
	}

	function delete_cart(){ 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

	public function checkout()
	{
		var_dump($this->cart->contents());

		// /echo $this->show_cart();
		// $this->show('checkout');
	}

	public function check_checkout()
	{
			$data = array(
 
						'name' => $this->input->post('n')
			           );
		
					 $this->cart->insert($data);
	              	$this->show('checkout');
	
	}
	public function checkout_init()
	{
		$this->show('checkout_init');
	}



	// ----/add to cart--//

	
// start section forget password
public function forget(){

	$email=$this->input->post('email');
	$q=$this->User_model->get_email($email);

	if($q ==FALSE){
		
		$this->User_model->send_otp($q);
		$this->load->view('usr/forget_password');
	
	}else{
	
		 redirect(base_url());
		echo "you enter the  valid email  address";
	}
	
}


public function otp(){

	$this->load->view('usr/otp');
}

public function pass(){

	$this->load->view('usr/new_password');
}


}// end main controller here 
