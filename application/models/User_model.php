<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {



    function __construct() {
         parent::__construct();
         $this->load->database();
    }
 public function get_data($table_name,$where,$id)
   {
        $sql=$this->db->where($where,$id)
                      ->get($table_name)
                      ->row();

            return $sql;
          
   }
    public function all_get_data($table_name,$where,$id)
   {
        $sql=$this->db->where($where,$id)
                      ->get($table_name)
                      ->result();

            return $sql;
          
   }
   public function put($table_name,$data){

   // Inserting in Table(students) of Database(college)
    $q=$this->db->insert($table_name,$data);
     
    if($q){

      
      
          return TRUE;
      }else
          return FALSE;
      
 }
 public function put_batch($table_name,$data){

   // Inserting in Table(students) of Database(college)
    $q=$this->db->insert_batch  ($table_name,$data);
     
    if($q){

      
      
          return TRUE;
      }else
          return FALSE;
      
 }


 public function add($data){

   // Inserting in Table(students) of Database(college)
    $q=$this->db->insert('users_register',$data);
     
    if($q){

      
      
          return TRUE;
      }else
          return FALSE;
      
 }



 // for contact us section 

 public function add_contact($contactdata){

    $qry=$this->db->insert('contact_us',$contactdata);

    if($qry){

        return TRUE;
    }else{
        return FALSE;
    }
 }

//this query for subscribe users adding
public function sub_plan($data){

   $query=$this->db->insert('users_subscribe',$data);
    
   if($query){
       return TRUE;
   }else{
       return FALSE;
   }

}


// login process 

public function validate($log){
    // grab user input
    $email = $log['user_email'];
    $password = $log['user_password'];
    
  
    // Prep the query
    $query =$this->db->where('user_email', $email); 
    $query =$this->db->where('user_password', $password);   
    
    // Run the query
    $query = $this->db->get('users_register');
    // Let's check if there are any results
    // var_dump($query->row());
    // exit();
     
    if($query->num_rows() == 1)
    {
        // If there is a user, then create session data
        $row = $query->row();
       
        $data = array(
                  
                 'user_id'    =>$row->user_id,
                 'user_name'  =>$row->user_name,
                 'user_email' =>$row->user_email

                
                );
        // var_dump($data);
        // exit;
        $this->session->set_userdata($data);
        return TRUE;
    }
    // If the previous process did not validate
    // then return false.
    else{
    return FALSE;}
}

//starting forget password section 

public function get_email($email)
{
    $this->db->select('user_email');
    $this->db->from('users_register');
    $this->db->where('user_email',$email);
    $query=$this->db->get();
    return $query->row_array();
}


public function send_otp($data)
{
        $email = $data['user_email'];
        $query1=$this->db->query("SELECT *  from user_register where user_email = '".$email."' ");
        $row=$query1->result_array();

        if ($query1->num_rows()>0)
      
   {
        $passwordplain = "";
        $passwordplain  = rand(999999,999999);
        $newpass['password'] = md5($passwordplain);
        $this->db->where('user_email', $email);
        $this->db->update('user_register', $newpass); 
        $mail_message='Dear '.$row[0]['user_name'].','. "\r\n";
        $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
        $mail_message.='<br>Please Update your password.';
        $mail_message.='<br>Thanks & Regards';
        $mail_message.='<br>Wired2Technologies';        
        date_default_timezone_set('Etc/UTC');
        require FCPATH.'assets/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = "tls"; 
        $mail->Debugoutput = 'html';
        $mail->Host = "yooursmtp";
        $mail->Port = 587;
        $mail->SMTPAuth = true;   
        $mail->Username = "your@email.com";    
        $mail->Password = "password";
        $mail->setFrom('admin@site', 'admin');
        $mail->IsHTML(true);
        $mail->addAddress($email);
        $mail->Subject = 'OTP from company';
        $mail->Body    = $mail_message;
        $mail->AltBody = $mail_message;



     }

  }

}//end user model function 



