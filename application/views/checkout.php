<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style type="text/css">
	 input {
 
 display:inline-block;
 width:40px;
  text-align: center;

}
#addres_div{
display: none;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){
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
  $("#checkout").click(function(){
alert("im in");
		  $('#addres_div').toggle();
  });



	});


</script>




<div class="container">
			<h4>Shopping Cart</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Items</th>
						<th>Price</th>
						<th>Qty</th>

						<th>Total</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="detail_cart">
					<form action="<?php echo base_url();?>User/check_order" method="POST">
<?php

$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {

			$no++;
			$output .='
			
		         <tr>
					<td>
					<input type="hidden" value="'.$items['id'].'" name="product_id[]">

					<input type="hidden" name="product_name[]" value="'.$items['name'].'">'.$items['name'].'</td>
					<td><input type="hidden" name="product_price[]" value="'.number_format($items['price']).'">'.number_format($items['price']).'</td>
					<td><input type="text" name="product_qty[]" value="'.$items['qty'].'"></td>
					
					
					<td><input type="hidden" name="product_total[]" value="'.number_format($items['subtotal']).'">'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
				</tr>
			';
			
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rs '.number_format($this->cart->total()).'</th>
			</tr>
			<tr>
				<th colspan="3"><button id="checkout">checkout</button></th>
				<th colspan="2"></th>
			</tr>
		';
		echo $output;


?>
				</tbody>
				
			</table>
			<div>
				

			</div>
		</div>



<!-- ------------ -->

<div id="addres_div">
<div class="col-lg-8" >
  <div class="card" >
    <div class="card-body">
        <div id="delivary" style=" background-color:#16B9CB;">Delivary</div>
          <div id="delivary_info"><div >you want to dilevery at same as registered address:
            <table>
              <tr>
                <td>
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
</div>
<!-- ------------- -->