<!DOCTYPE HTML>
<html>

  <?php $this->load->view('head'); ?>

	<body>

	<div class="colorlib-loader"></div>
	<div id="page">

    <?php $this->load->view('header'); ?>

			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
					<br>
					<h1 style="text-align:center; color:#191970;font-family:Ariel;"><b>Research Cell Testimonials / Achievements</b></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi1.jpg">
						<img id="image" data-group="group" style="height: 850px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi1.jpg"/>
					</a>
					</div>
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi2.jpg">
						<img style="height: 850px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi2.jpg"/>
					</a>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi3.jpg">
						<img style="height: 850px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi3.jpg"/>
					</a>
					</div>
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi4.jpg">
						<img style="height: 850px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi4.jpg"/>
					</a>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi5.png">
						<img style="height: 500px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi5.png"/>
					</a>
					</div>
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi6.jpg">
						<img style="height: 500px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi6.jpg"/>
					</a>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi7.png">
						<img style="height: 500px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi7.png"/>
					</a>
					</div>
					<div class="col-md-6 col-sm-6 animate-box">
					<a href="<?=base_url();?>dist/images/testimonials/testi8.png">
						<img style="height: 500px; width: 100%; border: 1px solid black; border-radius: 4px; padding: 5px" src="<?=base_url();?>dist/images/testimonials/testi8.png"/>
					</a>
					</div>
				</div>
			</div><br><br>
    
		<?php $this->load->view('footer'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
  <?php $this->load->view('scripts'); ?>
  <script>
  $("#pagetitle").html("Research Cell | Testimonials");
  $(".treeview").removeClass('active');
  $(".treeview").eq(6).addClass('active');
	</script>
	<script>
	</script>
	</body>
</html>