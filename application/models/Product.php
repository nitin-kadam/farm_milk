
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {

	function get_all_product()
	{

		$result=$this->db->get('product');
		return $result;
	}
}