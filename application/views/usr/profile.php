
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  
  .card{  
    border: 2px solid orange;
    padding: 1px;
    border-radius: 20px 20px;
    }


</style>

<div class="row">
    <div class="col-lg-4">
        <div class="card" >
        <div class="card-body">
                <img src="<?php echo base_url().'assets/images/'.$result->user_img;?>" alt="user avatar"  height="40" width="100%"/>
                <h3><?php echo $result->user_name; ?></h3>
                <hr>
                <div class="row">
                    <div class="col">User Name :</div>
                    <div class="col"><?php echo $result->user_name; ?></div>
                </div><br>
                <div class="row">
                    <div class="col">User Mail Id :</div>
                    <div class="col"> <?php echo $result->user_email; ?></div>
                </div><br>
                <div class="row">
                    <div class="col">User Mobile No :</div>
                    <div class="col"> <?php echo $result->user_mobile; ?></div>
                </div>
                <!-- <div class="row">
                    <div class="col">User Name</div>
                    <div class="col"> Goutam palkar</div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-lg-8">
       
         <div class="row">

             <div class="col-lg-12">
       
            <div class="card">
              <div class="card-header">
            About Me
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#!" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
         </div> 
         </div>  

    

    <div class="row">
         <div class="col-lg-12">
       
        <div class="card">
              <div class="card-header">
             
              </div>
              <div class="card-body">
                <h3 class="card-title"> Registration details</h3>
                <p class="card-text">
                    
                    <table>
                        <tr>
                            <td>Registration Date  </td><td>:<?php echo $result->created_on; ?></td><br></tr>
                            <tr><td>Registration City  </td><td>: <?php echo $result->user_city; ?></td><br></tr>
                           
                            <tr><td>Registration Flat </td><td>:<?php echo $result->user_address; ?></td><br></tr>
                             <tr>
                            <td>Registration Area </td><td>:<?php echo $result->user_area; ?></td><br> 
                           </tr>
                        </tr>


                    </table>

                </p>
                <a href="#!" class="btn btn-primary">Go somewhere</a>
              </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="card">
  <div class="card-body">
 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
    <li><a data-toggle="tab" href="#password">Password</a></li>
    <li><a data-toggle="tab" href="#address">Address</a></li>
     <li><a data-toggle="tab" href="#profile">Profile</a></li>
   
  </ul>

  <div class="tab-content">
    <div id="details" class="tab-pane fade in active">
      
      <h3>Details</h3>
        <form action="<?php echo base_url();?>User/user_edit" method="POST">
  
         <input type="hidden" name="id" value="<?php echo $result->user_id; ?>">
            <div class="form-group">
              <label >User Name</label>
              <input type="text" class="form-control"  name="username" value="<?php echo $result->user_name; ?>" id="nm">
            </div>
            <div class="form-group">
              <label>User Email ID :</label>
              <input type="text" class="form-control" value="goutampalkar@gmail.com" disabled>
            </div>
            <div class="form-group">
              <label >User Mobile Number :</label>
              <input type="text" class="form-control" name="mobile" value="<?php echo $result->user_mobile; ?>" id="mob">
            </div>
            
            <input name="details" type="submit" class="btn btn-primary" value="change">
        </form>
    </div>
    <div id="password" class="tab-pane fade">
      <h3>Change Password</h3>
     
        <form action="<?php echo base_url();?>User/update" method="POST">
            <div class="form-group">
              <label >
                Current Password :
              </label>
              <input type="password" class="form-control" name="password" id="current_pass">
              <?php  echo validation_errors();?>
            </div>
            <div class="form-group">
              <label >
                New Password :
              </label>
              <input type="password" class="form-control" name="newpass" id="new_pass">
              <?php  echo validation_errors();?>
            </div>
           <div class="form-group">
              <label >
                Confirm Password :
              </label>
              <input type="password"  class="form-control"  name="confpassword" id="re_pass">
              <?php echo validation_errors();?>
            </div>
            
            <button type="submit" name="Change_Password" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div id="address" class="tab-pane fade">
      <h3>Change Registerd Address </h3>
      <form action="<?php echo base_url();?>User/user_edit" method="POST">

       <input type="hidden" name="id" value="<?php echo $result->user_id; ?>">
            <div class="form-group">
              <label >Registerd Flat No.</label>
              <input type="text"  name="address"class="form-control" id="nm" value="<?php echo $result->user_address; ?>">
            </div>
            <div class="form-group">
              <label>Registerd Area/Lane :</label>
              <input type="text" name="area" class="form-control" value="<?php echo $result->user_area; ?>">
            </div>
            <div class="form-group">
              <label >Registerd pincode :</label>
              <input type="text" class="form-control" id="mob" name="pin" value="<?php echo $result->user_pincode; ?>">
            </div>
            
            <input type="submit" name="add" class="btn btn-primary" value="change"/>
        </form>
    </div>
    <div id="profile" class="tab-pane fade">
      <h3>Change Profile :</h3>
     <form action="" method="POST">
            <div class="form-group">
              <label>Upload profile pic :</label>
              <input type="file" class="form-control" id="nm">
            </div>
           
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
</div>
</div>