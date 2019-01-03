

<script src="<?php echo base_url();?>assets/js/validation.js"></script> 

	<!-- //Modal2 -->
	<div class="services-breadcrumb">
		<div class="container">
			<ul>
				<li><a href="index.html">Home</a><i>|</i></li>
				<li>Contact </li>
			</ul>
		</div>
	</div>
	<!-- contact -->
	<div class="banner-bottom">
		<div class="container">
			<h2 class="title-w3-agileits inner">Contact</h2>
			<p class="quia">Add Some Description </p>
<
			<div class="w3ls_map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.727127635693!2d73.84997430005656!3d18.541229187335148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c1651d8af4bf%3A0x67246d5127c466b9!2sWired+2+Technologies!5e0!3m2!1sen!2sin!4v1542268190345" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<!-- contact info -->
			<div class="col-md-4 wthree_contact_left">
				<h4>Address</h4>
				<p> Ekta Park Society, Hem Opal, Plot No.26, Wakadewadi,   Shivajinagar, <span>Pune, Maharashtra 411003
					</span></p>
				<ul>
					<li><span class="fa fa-phone" aria-hidden="true"></span> Free Phone :+91-9223536900</li>
					<li><span class="fa fa-folder-open-o" aria-hidden="true"></span> Fax :+91 7249215555</li>
					<li><span class="fa fa-envelope-o" aria-hidden="true"></span><a href="mailto:info@example.com">info@amaratechnologies.com</a></li>
				</ul>
			</div>
			<!-- /contact info -->
			<!-- contact form -->
			<div class="col-md-8 wthree_contact_left">
				<h4>Contact Form</h4>
				<form action="<?php echo base_url();?>User_controller/contact"   onsubmit=" return regular_validation()" method="post">
					<div class="col-md-6 wthree_contact_left_grid">

						<input type="text" name="name" placeholder="Name "  id="username" required="">
                        <span id="nameerror" class="text-danger"> </span>
						<input type="email" name="email" placeholder="Email " id="email" required="">
						<span id="emailerror" class="text-danger"> </span>
					</div>
					<div class="col-md-6 wthree_contact_left_grid">
						<input type="text" name="telephone" placeholder="Telephone" id="telephone" required="">
						<span id="telephonerror" class="text-danger"> </span>
						<input type="text" name="subject" placeholder="Subject"  id="subject" required="">
						<span id="subjecterror" class="text-danger"> </span>
					</div>
					<div class="clearfix"> </div>
					<textarea name="message" placeholder="Message... " required=""></textarea>
					<input type="submit" name="submit" value="Submit">
					<input type="reset" value="Clear">
				</form>
			</div>
			<!-- /contact form -->
			<div class="clearfix"> </div>

		</div>
	</div>
	<!-- //contact -->
