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
<div class="row">
  <div class="col-lg-4" >
      <div class="card" >
        <div class="card-body">
           <img src="<?php echo base_url();?>assets/images/<?php echo $result->product_image;?>" alt="user avatar" height="100%" width="100%"/>
                <h3></h3>
                <hr>
                <div class="row">
                    <div class="col">product Name :</div>
                    <div class="col"><?php echo $result->product_name;?></div>
                </div>
                <div class="row">
                    <div class="col">product rating:</div>
                    <div class="col"> <?php echo $result->product_name;?></div>
                </div>
                <div class="row">
                    <div class="col">product pack date :</div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col">product expiry date :</div>
                    <div class="col"> </div>
                </div>
                <div class="row">
                    <div class="col">product price :</div>
                    <div class="col"> <input id="price" value="<?php echo $result->product_price;?>"></div>
                </div>
                <hr>
                 <div class="row">
                    <div class="col">
                <div class="inc button">+</div><input type="text" name="french-hens" id="french-hens" value="1" style="display: inline-block; size: 10%;"><div class="dec button">-</div>
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
                <td><form action="<?php echo base_url();?>User/delivery_process" method="POST">
                  <input type="checkbox" class="radio" name="address" value="yes" id="yes">
                </td>
                <td>
                Yes
                </td>
              </tr>
              <tr>
                <td> 
                  <input type="checkbox" class="radio" name="address" value="no" id="no">
                </td>
                <td>
                No
                </td>
              </tr>
            </table> 
          </div>
        <div id="new_addres">
         <h4>Enter Your Mobile Number </h4><br>
          <input  type="text"  id="mob" class="form-control" name="mob" placeholder="Enter mobile number" required="" ><br>
	         <h4>Enter Your  Address </h4><br>
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


                <input type="hidden" name="product_id" value="<?php echo $result->product_id;?>">
                <input type="hidden" name="product_qty" id="qty1">
                <input type="hidden" name="product_name" value="<?php echo $result->product_name;?>">
                <input type="hidden" name="product_price" value="<?php echo $result->product_price;?>">
               <input type="hidden" name="product_total" id="total">
                


                <!-- //hidden details -->

					
											
						</div>
            <input type="submit" class="form-control" value="Order" ><br><br>  <br>


                
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
