

<style type="text/css">
    
 figure{
    margin-top: 10px;
    margin-bottom: 10px;
    margin-right: 10px;
    margin-left: 10px;
     
  }
  #imag{
     width :auto;
    height : 400px;
  }
  .subscribe_pack{
 

    width : auto;
    height : auto;

  }
.asterix {
    margin: 10px;
}
input
{
    font-size: 16px;
padding: 7px 12px;
width: 325px;
}


</style>

    <div class="container">

     		<div class="row">

     			<div class="col-md-4 col-sm-5 lg-screen-only">

     				<div class="subscribe_pack">
                        <figure>

     					<img src="<?php echo base_url();?>/assets/images/milk_bottle2.jpg" class="img-responsive" id="imag" alt="ssda">
                        </figure>
     				</div>

     			</div>

     			<div class="col-md-7 col-sm-6 col-xs-12">

                    <!--  -->

                    <div class="subscribe_form">

         			  <h3> Try our milk for a month.</h3>

						<p>Enjoy it with your family &amp; if you like it you can subscribe <br> with us for more!

						</p>

            
                        <form action="try-choose-plan.php" name="sub" method="post" onsubmit="return validateForm()">

    				<div class="subscribe_input">

    					<div class="form-group">
                <input type="hidden" name="" value="" />
                <input type="hidden" name="city" value="" class="city">
    						<p><input type="text" name="name"  placeholder="name" class="form-control" > *</p>

    					</div>

						<div class="form-group mobile-number">

   						    <p>              
                        <input type="text" name="mobile" class="input-medium bfh-phone" data-format="+91 (ddd) ddd-dddd">

                            </p>

    					</div>

    					<div class="form-group">

    						<p><input type="email" name="email" placeholder="e-mail" class="form-control" ><span class="asterix ">*</span></p>

    					</div>

    				</div>

    				<div class="address_input">

    					<h3>Address</h3>


                <div class="form-group">

                  <select name="city" id="city" class="form-control" >
                    <option value="">Select City</option>
                                       <option value="1">Pune</option> 
                                

                  </select>

              </div>

    					<div class="form-group">

                               <p><input type="text" name="flat" 
                                placeholder="flat no. &amp; building no." class="form-control" ><span class="asterix ">*</span></p>
                           </div>
                               <div class="form-group">

                            <p><input type="text"  name="society"  placeholder="society name" class="form-control" class="form-control" ><span class="asterix ">*</span></p>

    					</div>

    					<div class="form-group">

    						<p><input type="text"  name="area" placeholder="area" class="form-control"><span class="asterix ">*</span></p>

    					</div>

						<div class="form-group">

    						<p><input type="number" name="pincode" placeholder="pincode" class="form-control" ><span class="asterix ">*</span></p>

    					</div>

    				</div>

    				 

    				<button class="btn" type="submit">choose subscription</button>

    				  </form>


                     </div>

                    <!--  -->

     			</div>

     		</div>

     	</div>

     </div>
 </div>
    