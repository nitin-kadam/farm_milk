<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {



    function __construct() {
         parent::__construct();
         $this->load->database();
    }
  
}