<!DOCTYPE HTML>
<html>

  <?php $this->load->view('head'); ?>

	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">

    <?php $this->load->view('header'); ?>
		<div class="colorlib-event" style="padding: 1em; background-color:#191970 ;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom: 1px;">
						<h2 style="color: white; text-shadow: -2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Event: <?=$event->name;?></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-blog colorlib-white" style="padding: 2em">
			<div class="container">
        <div class="event-flex row-pb-sm">
					<div class="half event-img animate-box" style="border:5px solid black;background-size: 100% 100%;background-image: url(<?=base_url();?>illustrations/events/<?=$event->image;?>);">
					</div>
					<div class="half">
						<div class="row">
							<div class="col-md-12 animate-box">
								<div class="event-entry">
									<div class="desc">
										<h1 style="position:relative;right:18%; text-align: left; color:#191970 ; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;"><?=$event->name;?></h1>
									</div>
										<h4 class="organizer">Date:<span> <?=date("d M, Y", strtotime($event->date));?></span></h4>
										<h4 class="organizer">Type:<span> <?=ucfirst($event->type);?></span></h4>
										<div class="desc">
										<h3 style="position:relative;right:18%;">Event Link:</h3>
										</div>
										<a target="__blank" href="<?=$event->link;?>" style="color:blue;">More Details</a>
										<br>
										<br>
										<br>
										<?php
										if($event->excel != ""){
										?>
										<a target="__blank" href="<?=base_url().'illustrations/events/excel/'.$event->excel;?>" style="color:blue;">Download Report</a>
										<?php
										}else{
										?>
										<a href="#" style="color:blue;">Download Report</a>
										<?php
										}
										?>
									</div>
							</div>          
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="event-entry">
							<div class="desc">
								<h2 style="color: black; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;position:relative;right:8%;"><strong>Details:</strong></h2>
							</div>
								<h4 class="organizer"><span id='pro_desc'><?=html_entity_decode($event->details);?></span></h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="event-entry" style="width:100%; height:100%;">
								<img src="<?=base_url();?>illustrations/events/collage/<?=$event->collage;?>" style="width:100%;height:100%;"/>
						</div>
					</div>          
				</div>
			</div>	
      </div>
		<?php $this->load->view('footer'); ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
  <?php $this->load->view('scripts'); ?>
  
  <script>
  $("#pagetitle").html("Research Cell | Event - <?=$eno?>");
  $(".treeview").removeClass('active');
  $(".treeview").eq(2).addClass('active');
	</script>
	</body>
</html>