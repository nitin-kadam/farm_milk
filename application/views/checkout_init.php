<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#login").click(function(){
        $("#login_info").toggle("slow");
    });
    $("#delivary").click(function(){
    	 $("#login_info").hide("slow");
        $("#delivary_info").toggle("slow");
    });

$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

 $("#yes").click(function(){
        $("#new_addres").hide();
    });

  $("#no").click(function(){
        $("#new_addres").show();
    });







});
</script>
 
<style> 
#login ,#delivary {
    padding: 15px; 
    color: #ED0F67;
    font-family: Charcuterie Serif ;
    font-size: 22px;
   
    border: solid 1px #c3c3c3;
}

#login_info ,#delivary_info{
    padding: 50px;
    background-color:#ECF1E1;
    display: none;
}
</style>

 <div class="container">
<div id="login" style=" background-color:#16B9CB;">Login or sign up</div>
<div id="login_info"><div class="signin-form profile">
						
						<div class="login-form">
							<form action="User_controller/process" method="post">

								<input type="email" name="email" placeholder="E-mail" required>
								<input type="password" name="password" placeholder="Password" required>
								<div class="tp">
								<input type="submit" value="Sign In">

								</div>
							</form>
						</div>
						<div class="login-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
						<p><a href="#" > Don't have an account?</a></p>
					</div>


</div>

<!-- ------------ -->
<div id="delivary" style=" background-color:#16B9CB;">Delivary</div>
<div id="delivary_info"><div >you want to dilevery at same as registered address:<input type="checkbox" class="radio" name="address" value="yes" id="yes"> Yes <input type="checkbox" class="radio" name="address" value="no" id="no"> No </div>
<div id="new_addres">
	<h4>Enter Your  Address </h4><br>
                                <select class="form-control" name="city">
                                <option>Choose City</option>
                                <option>Pune</option>
                               </select><br>
							   <input  type="text"  id="address" class="form-control" name="address" placeholder="Enter flat no & bulding no & society name" >
                               <br>
				      <select class="form-control" name="area" >
                            <option>Choose Area</option>
                             <option>   Pimpri</option> 
                             <option >  Dhanori</option> 
                             <option disabled>  Wakad</option> 
                             <option>  Dhayari</option> 
                             <option>  NIBM</option> 
                             <option disabled>  Salisbury Park</option> 
                             <option>   Bhosale Nagar</option> 
                             <option disabled>  Aundh</option> 
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
                              </select><br>
			    		 <input type="text" name="pincode" placeholder="Enter your pincode" required=""><br>
					
				


								<input type="submit" value="Sign Up" ><br><br>  <br>


								<a href="#" class="btn btn-success " role="button">Sign Up With Fecebook</a>
								<a href="#" class="btn btn-success " role="button">Sign Up With Gmail</a>
								<a href="#" class="btn btn-success " role="button">Sign Up With Instagram</a>
							</form>
						</div>
						<p><a href="#"> By clicking register, I agree to your terms</a></p>
					</div>
				</div>

</div>
</div>
<!-- ------------- -->
