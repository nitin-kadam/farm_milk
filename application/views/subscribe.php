

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>

$(document).ready(function(){
   
    $(".trigger_popup_fricc").click(function(){
       $('.hover_bkgr_fricc').show();
    });
   
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $(".trigger_popup_fricc2").click(function(){
       $('.hover_bkgr_fricc2').show();
    });
   
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc2').hide();
    });


});
</script>

<style type="text/css">
  
  #headline{
    margin-top: 20px;
    margin-bottom: 20px;
    color: maroon;
    font-size: 20%;
  }
  figure{
    margin-top: 10px;
    margin-bottom: 20px;
    /*margin-right: 20px;*/
    /*margin-left: 20px;*/
    border: 1px solid #000;
    padding: 5px;

     
  }
  #imag{
     width : 330px;
    height : 250px;
  }





/* Popup box BEGIN */
.hover_bkgr_fricc,.hover_bkgr_fricc2 {
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
     overflow: scroll;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc2 .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}

.hover_bkgr_fricc2 > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc,.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}
/* Popup box BEGIN */





</style>


                      <?php 
						$p['page']='Subscribe';
						$p['page_id']='p';
						$this->session->set_userdata($p);?>
						<a href="<?php echo base_url().'User_controller/registration'?>">kjhk</a>
<div class="container">
    <!-- heading of page -->
   		<div class="row">
   			<div class="col-md-12 text-center" id="headline">
   				<div class="page_breadcrumb">
   					<h3><b>What's your type?
            </b></h3>
   				</div>
   			</div>
   		</div>
    <!-- end heading of page -->
    
  <section id="section-products">
 
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h3>Regular Cow Milk</h3><br>
        <figure>

            <img src= "https://i2-prod.mirror.co.uk/incoming/article9456387.ece/ALTERNATES/s615/Holstein-dairy-cow-at-Bega-NSW.jpg" class="img-rounded" id="imag" style="height:300px; width:525px;">

        </figure>
        
        <a href="<?php echo base_url();?>User_controller/register" class="btn btn-warning" role="button"> <b>Try it for  week</b></a>
    &nbsp OR &nbsp       <a href="<?php echo base_url();?>User_controller/register" class="btn btn-warning" role="button"> Try it for  month</a>
    
        <br><br>
       
          
          
       <!--  </div> -->
      </div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <h3>Desi Cow Milk</h3><br> 
    <figure><img src= "https://qph.fs.quoracdn.net/main-qimg-3e3d90ef21d1fb31fae64a26ac646c91-c" class="img-rounded" id="imag" style="height:300px; width:525px;">
    </figure>
    <a href="<?php echo base_url();?>User_controller/register" class="btn btn-warning" role="button"> Try it for  week</a>
    &nbsp OR &nbsp    <a href="<?php echo base_url();?>User_controller/register" class="btn btn-warning" role="button"> Try it for  month</a>
    <br><br>
   
  
<!-- display box by click the link regular milk -->
<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
        <div class="popupCloseButton">X</div>
       
      <h3> Try Our Reguler Milk </h3>

            <p>Enjoy it with your family &amp; if you like it you can subscribe <br><br>

            </p>


            <form action="<?php echo base_url();?>User_controller/subscribe" name="sub" method="post" onsubmit="return validateForm()">

                      

                          <select class="form-control" name="city">
                            <option>Choose City</option>
                            <option>Pune</option>
                            </select><br><br>
           
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
                          <br><br>
                     
                          <div class="input-group">
                            
                            <input  type="mobile"  id="addres" class="form-control" name="address" placeholder="Enter address" >
                             </div><br><br>
                             <table>

                              <td> <input type="radio" name="rd" value="1">try for week  </td>
                              <td> <input type="radio" name="rd" value="3" >try for 3 month</td>
                              <td><input type="radio" name="rd" value="6">try for 6 month</td>
                              <td><input type="radio" name="rd" value="12" >try for 1 year</td>
                              </table> <br><br>
                             <button class="trigger_popup_fricc btn-primary" type="submit">Choose Subscription</button> 

              </form>
 </div>




    </div>
    <!-- end dispaly box reguler milk -->


    <!-- display box desi milk -->
    <div class="hover_bkgr_fricc2">
    <span class="helper"></span>
    <div>
        <div class="popupCloseButton">X</div>
       
<h3> Try our Desi milk </h3><br>

            <p>Enjoy it with your family &amp; if you like it you can subscribe <br> <br>

            </p>

           <form action="<?php echo base_url();?>User_controller/subscribe" name="sub" method="post" onsubmit="return validateForm()">

        
   
                          <select class="form-control"   name="city">
                            <option >Choose City</option>
                            <option  >Pune</option>
                         
                           </select>
                          <br><br>


                           <select class="form-control" name="area" >
                            <option>Choose Area</option>
            

                             <option>  Hadapsar </option> 
                             <option>   Baner</option> 
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
                                <option> Model colony</option> 
                                <option> Mohammadwadi</option> 
                                <option>Mukund Nagar</option> 
                                <option>Mundhwa</option> 
                                <option> Nagar Road</option> 
                                <option>Narayan peth</option> 
                                <option> Padmavati</option> 
                                <option> Parvati Darshan</option> 
                                <option>Parvati Gaon</option> 
                                <option>Paud Road</option> 
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
                                <option> Sangamvadi
                                </option> 
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
                          <br><br>




                     
                          <div class="input-group">

                              <input  type="text"  id="mobileno" class="form-control" name="address" placeholder="Enter address" >
                             </div> <br><br>
                             <table>

                             
                              <td> <input type="radio" name="rd" value="1">try for week  </td>
                              <td> <input type="radio" name="rd" value="3" >try for 3 month</td>
                              <td><input type="radio" name="rd" value="6">try for 6 month</td>
                              <td><input type="radio" name="rd" value="12" >try for 1 year</td>
                              </table>

                               <br><br>

                                <button class="btn btn-primary" type="submit">Choose Subscription </button>

              </form>
 </div>




    </div>
    <!-- ebd display box desi milk -->
</div>

</section>
