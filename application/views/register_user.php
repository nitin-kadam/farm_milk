


<div class="container">
  <div class="row">

 <div class="col-sm-6 col-sm-offset-2">

<h2>Sign Up</h2><br>
<form action="<?php echo base_url();?>User_controller/user_add" method="POST">
<div class="input-group">

<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input  type="text"id="uname" class="form-control" name="name"  placeholder="Enter your name" >
</div> <br>

  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input  type="email"  id="email" class="form-control" name="email" placeholder="Enter your email" >
  </div><br>


<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input  type="password"  id="pwd" class="form-control" name="password" placeholder=" Enter your password" >
</div><br>

<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input  type="password"  id="pwd" class="form-control" name="conpassword" placeholder="Enter Conform assword" >
</div><br>

 
<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input  type="text"  id="phone" class="form-control" name="mobile" placeholder="Enter your mobile" >
</div><br>

<h4>Enter Your  Address </h4><br>
   <select class="form-control" name="city">
                            <option>Choose City</option>
                            <option>Pune</option>
                            </select><br>

<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input  type="text"  id="address" class="form-control" name="address" placeholder="Enter flat no & bulding no & society name" >
</div><br>
 

                      <select class="form-control" name="area" >
                            <option>Choose Area</option>
                             <option>   Pimpri</option> 
                             <option>  Dhanori</option> 
                             <option>  Wakad</option> 
                             <option>  Dhayari</option> 
                             <option>  NIBM</option> 
                             <option>  Salisbury Park</option> 
                             <option>   Bhosale Nagar</option> 
                             <option>  Aundh</option> 
                             <option>  Pashan</option> 
                             <option>  Kothrud</option>
                             <option>  Shivajinagar</option> 
                             <option>   Deccan Gymkhana</option> 
                             <option>  Law College Road</option> 
                            <option>  Pisoli</option> 
                            <option> Akurdi</option> 
                            <option>  Anand Nagar</option> 
                            <option>  Ashok Nagar</option> 
                            <option>   Aundh Road</option> 
                            <option>  Bajirao Road</option> 
                            <option>  Balaji Nagar</option> 
                            <option>Bavdhan</option> 
                            <option>Bhawani Peth</option> 
                            <option>Bhekrai Nagar</option> 
                            <option>Bhugaon</option> 
                            <option>  Bhukum</option> 
                            <option>   Boat Club Road</option> 
                            <option>Bopodi</option> 
                            <option> Budhwar Peth</option> 
                            <option>Bund Garden Road</option> 
                            <option>Camp</option> 
                            <option>  Chandan Nagar</option> 
                            <option>  Chandani Chowk</option> 
                            <option> Dhankawadi</option> 
                            <option> Erandwane</option> 
                            <option>FC Road</option> 
                            <option>Ganesh Nagar</option> 
                            <option>Ganesh Peth</option> 
                            <option> Ganeshkhind</option> 
                            <option>Gokhale Nagar</option> 
                            <option>Guru Nanak Nagar</option> 
                            <option> Guruwar Peth</option>                       
                          <option>Hingne Khurd</option> 
                          <option>Indira Nagar</option> 
                          <option> Kalewadi</option> 
                          <option> Kalyani Nagar</option> 
                          <option> Karvenagar</option> 
                          <option> Karve Road</option> 
                          <option>  Kasba peth</option> 
                          <option> Katraj</option> 
                          <option> Kondhwa</option> 
                          <option>Kondhwa Budruk</option> 
                          <option> Lavale</option> 
                          <option> Lulla Nagar</option> 
                          <option> Mahrashi Nagar</option> 
                          <option> Market yard</option> 
                          <option>Model colony</option> 
                          <option>Mohammadwadi</option> 
                          <option>Mukund Nagar</option> 
                          <option>Mundhwa</option> 
                          <option>Nagar Road</option> 
                          <option>Narayan peth</option> 
                          <option>Padmavati</option> 
                          <option>Parvati Darshan </option>
                          <option>Fursungi</option> 
                          <option>Pirangut</option> 
                          <option> Prabhat Road</option> 
                          <option>Pune Cantonment</option> 
                          <option>Range Hills</option> 
                          <option> Rasta Peth</option> 
                          <option> Revenue Colony</option> 
                          <option> Sadashiv peth</option> 
                          <option> Sahakar Nagar</option> 
                          <option>Salunke Vihar</option> 
                          <option>  Sangamvadi</option> 
                          <option> Sangamvadi </option>
                          <option>Satara Road</option> 
                          <option> Shaniwar Peth</option> 
                          <option> Shastri Nagar</option> 
                          <option> Shukrawar Peth</option> 
                          <option>  Sinhagad</option> 
                          <option>  Somwar Peth</option> 
                          <option>Swargate</option> 
                          <option>Thergaon</option> 
                          <option> Tilak Road</option> 
                          <option>Vadgaon Maval</option> 
                           </select>
                          <br>


<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input  type="number"  id="pin" class="form-control" name="pincode" placeholder="Enter your area pincode" >
</div><br>
 



 
  <button type="submit" class="btn btn-primary">Sign Up </button><br><br>

  <a href="#" class="btn btn-success " role="button">Sign Up With Fecebook</a>
  <a href="#" class="btn btn-success " role="button">Sign Up With Gmail</a>
  <a href="#" class="btn btn-success " role="button">Sign Up With Instagram</a>

</form><br><br>
</div>
 </div>
