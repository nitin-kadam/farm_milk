<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><script type="text/javascript">
	$(document).ready(function(){

		$("#checkout").click(function(){

			$("#popup_box").show('slow');

		});
		$(".close").click(function(){

			$("#popup_box").hide('slow');
			
		});


	});
</script>
<style type="text/css">
	#popup_box{
	background:rgba(0,0,0,.4);
    
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
     overflow: scroll;

	}
	#popup_box > div {
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
    padding: 10px 5%;
    margin-top: 100px;
}



	img{
		display: inline-block;
	}




</style>
<body>           <?php 
						$p['page']='Product';
						$p['page_id']='p';
						
						$this->session->set_userdata($p);?>
						<a href="<?php echo base_url().'User_controller/registration'?>" data-toggle="modal" data-target="#myModal3"> Don't have an account?</a></p>
					
  <div class="container"><br/>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<h4>Product</h4>
			<div class="row">
			<?php foreach ($data->result() as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="<?php echo base_url().'assets/images/'.$row->product_image;?>">
						<div class="caption">
							<h4><?php echo $row->product_name;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo number_format($row->product_price);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->product_id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-productid="<?php echo $row->product_id;?>" data-productname="<?php echo $row->product_name;?>" data-productprice="<?php echo $row->product_price;?>"
							data-productimg="<?php echo $row->product_image;?>"	>Add To Cart</button>
						
							<!-- <a href="#" class="add_cart btn btn-danger btn-block" role="button">Buy Now </a> -->

							<form action="<?php echo base_url().'Main_controller/view_product';?>" method="POST">
								<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
								<input type="submit" class="add_cart btn btn-danger btn-block" value="Buy Now">
							</form>
							
						</div>
					</div>
				</div>
		         <?php endforeach;?>
				
			    </div>

		</div>
		<div class="col-md-4">
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


				</tbody>
				
			</table>
			<button id="checkout">checkout</button>
		</div>
	</div>
</div>



<div id="popup_box">
	


					<div class="signin-form profile">
						<button type="button" class="close" >&times;</button>
						<h3 class="agileinfo_sign">Sign In</h3>
						<div class="login-form">
							<form action="<?php echo base_url();?>User_controller/checkout_login" method="post">
								<input type="hidden" name="checkout_id" value="checkout">
								<input type="email" name="email" placeholder="E-mail" required="">
								<input type="password" name="password" placeholder="Password" required="">
								<div class="tp">
								<input type="submit" value="Sign In"><br><br>
								
								<a href="<?php echo base_url();?>Main_controller/forget"><strong>Forget Password</strong></a>	<br>
								Don't have an Account
								<a href="<?php echo base_url();?>Main_controller/register"><strong>Click here!..</strong></a>

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

</div>
</div>


<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.add_cart').click(function(){
			var product_id    = $(this).data("productid");
			var product_name  = $(this).data("productname");
			var product_price = $(this).data("productprice");
			var quantity   	  = $('#' + product_id).val();
			var image 		  = $(this).data("productimg");
// alert(img);
			$.ajax({

				url : "add_to_cart",
				method : "POST",
				
				data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity},
				success: function(data){
					$('#detail_cart').html(data);
					
				}
			});
		});

		var base_url="<?php echo base_url();?>Main_controller/load_cart";
		// alert(base_url);
		$('#detail_cart').load("load_cart");

		
		$(document).on('click','.romove_cart',function(){
			var row_id=$(this).attr("id"); 
			$.ajax({
				url : "delete_cart",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>
<!-- </body>
</html> -->