
<style type="text/css">
.card{
	  margin-bottom :10px;
    margin-right :10px;
    margin-top: 10px;
    margin-left: 10px;
    
   
}
.checked {
    color: orange;
}
/*image hover effect*/
.hvrbox * {
  box-sizing: border-box;
}
.hvrbox {
  position: relative;
  display: inline-block;
  overflow: hidden;
  max-width: 100%;
  height: auto;
}
.hvrbox img {
  max-width: 100%;
}
.hvrbox .hvrbox-layer_bottom {
  display: block;
}
.hvrbox .hvrbox-layer_top {
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  color: #fff;
  padding: 5px;
  -moz-transition: all 0.4s ease-in-out 0s;
  -webkit-transition: all 0.4s ease-in-out 0s;
  -ms-transition: all 0.4s ease-in-out 0s;
  transition: all 0.4s ease-in-out 0s;
}
.hvrbox:hover .hvrbox-layer_top,
.hvrbox.active .hvrbox-layer_top {
  opacity: 1;
}
.hvrbox .hvrbox-text {
  text-align: center;
  font-size: 18px;
  display: inline-block;
  position: absolute;
  top: 50%;
  left: 50%;
  -moz-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.hvrbox .hvrbox-text_mobile {
  font-size: 15px;
  border-top: 1px solid rgb(179, 179, 179); /* for old browsers */
  border-top: 1px solid rgba(179, 179, 179, 0.7);
  margin-top: 5px;
  padding-top: 2px;
  display: none;
}
.hvrbox.active .hvrbox-text_mobile {
  display: block;
}
.hvrbox .hvrbox-layer_scale {
  border-radius: 50%;
  -moz-transform: scale(0);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
}
.hvrbox:hover .hvrbox-layer_scale,
.hvrbox.active .hvrbox-layer_scale {
  border-radius: 0%;
  -moz-transform: scale(1);
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

/*/image hover effect*/

</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        var boxHeight = $("#im").width();
        $(".card").mouseenter(function(){
            $(this).animate({
                height: "600px"
            });
        }).mouseleave(function(){
            $(this).animate({
                height: boxHeight
            });
        });
    });
</script>
 --><div data-ng-app="" data-ng-init="quantity=1;price=100">
<div class="container" style="background-color: #fcfcf2;">

 <div class="panel panel-default" style="margin-top: 5px">
 	 <div class="panel-body">
  <h2>Our Special Products</h2>
  <br>
  <p> Try our delicious new  extra milk Protein & Calcium Products</p></div></div>
  <div class="row">
  	<div class="col">
	  <div class="card">
  
<div class="hvrbox">
	    <img class="hvrbox-layer_bottom" src="<?php echo base_url();?>/assets/images/7.jpg" alt="Card image" width="100%" height="300px">
        <div class="hvrbox-layer_top hvrbox-layer_scale">
    <div class="hvrbox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor ligula porttitor, lacinia sapien non.<br>
<a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">View More</a>

    </div></div>
  </div>
	    <div class="card-body">
	      <h4 class="card-title">Reguler Milk</h4>
	       <h6><b>Product Rating</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked "></span>
<span class="fa fa-star checked"></span></h6>

 MRP : RS /{{quantity * weight }}
          
	      <table><tr><td>
    <!-- <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>: 

    <select id="quantity">            
        <option value="5"> 5</option>
        <option value="10"> 10</option>
        <option value="15">15</option>            
    </select>         -->
  <!-- <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>:  -->

    <!-- <select  ng-model="quantity" id="quantity" value="kjhsdkh" >   
      
    <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
          
    </select>  -->
  <input type="number" placeholder="Quantity" ng-model="quantity"> 
  <input type="number" placeholder="Weight" ng-model="weight"> 

       

</td>
</tr>
<tr>
  <td>
    <!-- <strong>Weight&nbsp;&nbsp;&nbsp; </strong> </td><td>
      :<select id="weight">
        <option value="1" selected>none</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>         -->
</td>
</tr>

</table>
	      <a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">Buy</a>
	    </div>
	  </div>
	</div>


 <div class="col">
  <div class="card">
<div class="hvrbox">
    <img class="hvrbox-layer_bottom" src="<?php echo base_url();?>/assets/images/A2milk3.jpg" alt="Card image" width="100%" height="300px">
<div class="hvrbox-layer_top hvrbox-layer_scale">
    <div class="hvrbox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor ligula porttitor, lacinia sapien non.<br>

<a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">View More</a>
    </div></div>
  </div>

    <div class="card-body">
      <h4 class="card-title">A2 (Gir) Milk</h4>
      <h6><b>Product Rating</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span></h6>
MRP : RS 25 /-
      <table><tr><td>
    <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>: 

    <select id="quantity">            
        <option value="5"> 5</option>
        <option value="10"> 10</option>
        <option value="15">15</option>            
    </select>        
</td>
</tr>
<tr>
  <td>
    <strong>Weight&nbsp;&nbsp;&nbsp; </strong> </td><td>
      :<select id="weight">
        <option value="1" selected>none</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>        
</td>
</tr>

</table>
      <a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">Buy </a>
    </div>
  </div>
</div>

<div class="col">
<div class="card">
  <div class="hvrbox">
    <img class="hvrbox-layer_bottom" src="<?php echo base_url();?>/assets/images/paneer2.jpg" alt="Card image" width="100%" height="300px">
<div class="hvrbox-layer_top hvrbox-layer_scale">
    <div class="hvrbox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor ligula porttitor, lacinia sapien non.<br>

<a href="<?php echo base_url();?>Main_controller/view_product" class="btn btn-primary">View More</a>
    </div></div>
  </div>

    <div class="card-body">
      <h4 class="card-title">Paneer</h4>
       <h6><b>Product Rating</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span></h6>
MRP : RS 25 /-
      
  <table><tr><td>
    <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>: 

    <select id="quantity">            
        <option value="5"> 5</option>
        <option value="10"> 10</option>
        <option value="15">15</option>            
    </select>        
</td>
</tr>
<tr>
  <td>
    <strong>Weight&nbsp;&nbsp;&nbsp; </strong> </td><td>
      :<select id="weight">
        <option value="1" selected>none</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>        
</td>
</tr>

</table>
      <a href="<?php echo base_url();?>Main_controller/view_product" class="btn btn-primary">Buy</a>
    </div>
  </div>
</div>
</div>

<div class="row">
<div class="col">
  <div class="card">
    <div class="hvrbox">
    <img class="hvrbox-layer_bottom" src="<?php echo base_url();?>/assets/images/curd1.jpg" alt="Card image" width="100%" height="300px">

    <div class="hvrbox-layer_top hvrbox-layer_scale">
    <div class="hvrbox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor ligula porttitor, lacinia sapien non.<br>

<a href="<?php echo base_url();?>Main_controller/view_product" class="btn btn-primary">View More</a>

    </div></div>
  </div>
    <div class="card-body">
      <h4 class="card-title">curd</h4>
       <h6><b>Product Rating</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked "></span></h6>
MRP : RS 25 /-
      
    <table><tr><td>
    <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>: 

    <select id="quantity">            
        <option value="5"> 5</option>
        <option value="10"> 10</option>
        <option value="15">15</option>            
    </select>        
</td>
</tr>
<tr>
  <td>
    <strong>Weight&nbsp;&nbsp;&nbsp; </strong> </td><td>
      :<select id="weight">
        <option value="1" selected>none</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>        
</td>
</tr>

</table>
      <a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">Buy</a>
    </div>
  </div>
</div>


<div class="col">
	 <div class="card">
    <div class="hvrbox">
    <img class="hvrbox-layer_bottom" src="<?php echo base_url();?>/assets/images/8.jpg" alt="Card image" width="100%" height="300px">
    <div class="hvrbox-layer_top hvrbox-layer_scale">
    <div class="hvrbox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor ligula porttitor, lacinia sapien non.<br>

<a href="<?php echo base_url();?>Main_controller/view_product" class="btn btn-primary">View More</a>

    </div></div>
  </div>
    <div class="card-body">
      <h4 class="card-title">Butter</h4>
       <h6><b>Product Rating</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span></h6>
MRP : RS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="butter_price"></span> /-
     
  
<table><tr><td>
    <strong>Quantity&nbsp;&nbsp;&nbsp; </strong></td><td>: 

    <select id="quantity">            
        <option value="5"> 5</option>
        <option value="10"> 10</option>
        <option value="15">15</option>            
    </select>        
</td>
</tr>
<tr>
  <td>
    <strong>Weight&nbsp;&nbsp;&nbsp; </strong> </td><td>
      :<select id="weight">
        <option value="1" selected>none</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>        
</td>
</tr>

</table>
      <a href="<?php echo base_url();?>Main_controller/subcribe" class="btn btn-primary">Buy </a>
    </div>
  </div>

</div>

<div class="col"></div>

</div>




</div>
  
  




</div>

</div>



<script type="text/javascript">
$(document).ready(function() {        
    $("#quantity").click(function(event) {
        
            var q = $("#quantity").find("option:selected").val();
            // alert(q);
            $("#weight").change(function(event) {
        
            var w = $("#weight").find("option:selected").val();
           
            var total = (w*q)/25;
            // alert(total);
             $('#butter_price').text(total);


        
    });
    });
});    
</script>