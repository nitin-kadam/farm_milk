<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
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

  if($('#yes').is(':checked') == true)
  {
      $('#new_addres').find('input:text, select').each(function() {
      $(this).prop('disabled', true);
      });
      
   } 
    // $("#new_addres").hide();
 });

  $("#no").click(function(){

     if($('#no').is(':checked') == true)
  {
      $('#new_addres').find('input:text, select').each(function() {
      $(this).prop('disabled', false);
      });
      
   } 

        // $("#new_addres").show();
    });

  $(".button").on("click", function() {
  var price= $("#price").val(); 
  var main_price=40;
  var $button = $(this);
  var oldValue = $button.parent().find("input").val();

  if ($button.text() == "+") {
    var newVal = parseFloat(oldValue) + 1;
     newprice= newVal*main_price;
     price=newprice;

  } 
  else {
   // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
       price-= main_price;
    } else {
      newVal = 0;
    }
  }

  $button.parent().find("input").val(newVal);
  $("#price").val(price);
  $("#total").val(price);
  $("#qty1").val(newVal);
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



<form action="<?php echo base_url();?>User/add_sub" method="POST">
<div class="row">

  <div class="col-lg-4" >
      <div class="card" >
        <div class="card-body">
           <img src="<?php echo base_url();?>assets/images/A2milk4.jpg" alt="user avatar" height="100%" width="100%"/>
                <h3></h3>
                <hr>

               <div class="row">               
                <select class="form-control" name="type">
                <option>Choose Milk Type</option>
                <option>Regular Milk</option>
                <option>Desi Milk</option>
               </select>
                </div><br>



              <div class="row"> 
              <select class="form-control" name="plan">
             <option>Choose Plan</option>
             <option value="7">7 Days </option>
             <option value="30">1 Months </option>
             <option value="90">3 Months </option>
             <option value="180">6 Months</option>
             <option value="365">1 Year </option>
           </select>
           </div><br>

                <div class="row">
                <select class="form-control" name="liter">
                <option>Choose Liter</option>
                <option value="1">1 Liter </option>
                <option value="2">2 Liter </option>
                <option value="3">3 Liter </option>
                <option value="4">4 Liter </option>
                <option value="5">5 Liter </option>
               
             </select>
                </div><br>
                
                <div class="row">
                <h5>From Today </h5>
                 <input type="date" name="today" class="form-control" placeholder="" required="">
            
                </div><br>
                <div class="row">
                <h5>From Till</h5>
                 <input type="date" name="till" class="form-control" placeholder="" required="">
                </div><br>
                <!-- <div class="row">
                    <div class="col">plan price :</div>
                    <div class="col"> <input id="price" value=""></div>
                </div> -->
                <hr>
                 <div class="row">
                    <div class="col">
                <!-- <div class="inc button">+</div><input type="text" name="french-hens" id="french-hens" value="0" style="display: inline-block; size: 10%;"><div class="dec button">-</div> -->
              </div>
            </div>

        </div>
      </div>   
  </div>

<!-- ------------ -->


<div class="col-lg-8" >
  <div class="card" >
    <div class="card-body">
        <div id="delivary" style=" background-color:#16B9CB;">Delivary</div>
          <div id="delivary_info"><div >you want to dilevery at same as registered address:
            <table>
              <tr>
                <td><form action="" method="POST">
                  <input type="checkbox" class="radio" name="address" value="yes" id="yes">
                </td>
                <td>
                Yes
                </td>
              </tr>
              <tr>
                <td> 
                  <input type="checkbox" class="radio" name="address" value="no" id="no"><br>
                </td>
                <td>
                No
                </td>
              </tr>
            </table> 
          </div>
        <div id="new_addres">
    
         <h5>Enter Your Mobile Number </h5>
          <input  type="text"  id="mob" class="form-control" name="mobile" placeholder="Enter mobile number" required="" ><br>
	         <h5>Enter Your  Address </h5>
              <select class="form-control" name="city">
                <option>Choose City</option>
                <option>Pune</option>
             </select><br><br>
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
                 <input  type="text"  id="address" class="form-control" name="address1" placeholder="Enter flat no & bulding no & society name" required="" ><br>
                 <input type="text" name="pincode" class="form-control" placeholder="Enter your pincode" required=""><br>



                <!-- hidden details -->


                <!-- <input type="hidden" name="product_id" value="">
                <input type="hidden" name="product_qty" id="qty1">
                <input type="hidden" name="product_name" value="">
                <input type="hidden" name="product_price" value="">
               <input type="hidden" name="product_total" id="total">
                 -->


                <!-- //hidden details -->

					
											
						</div>
            <input type="submit" class="form-control" value="Subscribe Now" ><br><br>  <br>


                
              </form>
						
					</div>
				</div>

</div>
</div>
</div>
</div>
</div>
</div>
<!-- ------------- -->
