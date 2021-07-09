<!DOCTYPE HTML>
<html>
<?php $this->load->view('head'); ?>
	<body>
		
	<div class="colorlib-loader">/</div>

	<div id="page">

  <?php $this->load->view('header'); ?>
		<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
				<h1>Contact Information</h1>
			</div>
		</div>
		</div>
		<div id="colorlib-contact" style="padding: 0;">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<div class="row">
							<div class="col-md-12">
								<div class="contact-info-wrap-flex">
									<div class="con-info" style="width: 50%;">
										<p><span><i class="icon-location-2"></i></span> <br>Shah & Anchor Kutchhi Engineering College. <br><br><br>
										Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br><br>
										<a style="color:#191970" href="http://www.shahandanchor.com/home/">ShahAndAnchor.com</a></p>
									</div>
									<div class="con-info" style="width:48%">
										<p><span><i class="icon-phone3"></i></span> <br>Dr. Nilakshi Jain - <br>022-25580854 Ext. 406<br><br> Dr. Kranti Ghag - <br>022-25580854 Ext. 407<br><br><a style="color:#191970" href="mailto:research@sakec.ac.in">Research@Sakec.ac.in<br></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h2>Message Us</h2>
						<form action="#">
							<div class="row form-group">
								<div class="col-md-6">
									<!-- <label for="fname">First Name</label> -->
									<input type="text" id="fname" class="form-control" placeholder="Your firstname">
								</div>
								<div class="col-md-6">
									<!-- <label for="lname">Last Name</label> -->
									<input type="text" id="lname" class="form-control" placeholder="Your lastname">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<!-- <label for="email">Email</label> -->
									<input type="text" id="email" class="form-control" placeholder="Your email address">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<!-- <label for="subject">Subject</label> -->
									<input type="text" id="subject" class="form-control" placeholder="Subject">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<!-- <label for="message">Message</label> -->
									<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Send Message" class="btn btn-primary">
							</div>
						</form>		
					</div>
				</div>
			</div>
    </div>
    
    <div id="map" class="colorlib-map" style="margin-left: 19%;width: 62%"></div>
    <br><br>
		<?php $this->load->view('footer'); ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<?php $this->load->view('scripts'); ?>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="<?=base_url();?>dist/js/google_map.js"></script>
  <script>
  $("#pagetitle").html("Research Cell | Contact Us");
  $(".treeview").removeClass('active');
  $(".treeview").eq(7).addClass('active');
	</script>
	</body>
</html>

