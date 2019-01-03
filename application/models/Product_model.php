<?php
class Product_model extends CI_Model{

	function get_all_product(){
		$result=$this->db->get('product');
		return $result;
	}
	public function getdata($tableName,$id,$conCol)
	{
		return $result=$this->db->where($conCol,$id)->get($tableName)->result();
	}
	
}