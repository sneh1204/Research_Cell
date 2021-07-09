<!DOCTYPE HTML>
<html>
  <?php $this->load->view('head'); ?>
	<body>
	<div class="colorlib-loader"></div>
	<style>
hr.style1{
	margin: 2% 5% 4% 5%;
	border-top: 1px solid #8c8b8b;
}
.hovereffect {
  width: 100%;
  height: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: default;
}
.hovereffect .overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  left: 0;
  background-color: rgba(255, 255, 255, 0.7);
  top: -200px;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: all 0.1s ease-out 0.5s;
  transition: all 0.1s ease-out 0.5s;
}
.hovereffect:hover .overlay {
  opacity: 1;
  filter: alpha(opacity=100);
  top: 0px;
  -webkit-transition-delay: 0s;
  transition-delay: 0s;
}
.hovereffect img {
  display: block;
  position: relative;
}
.hovereffect h2 {
  text-transform: uppercase;
  color: #fff;
  text-align: center;
  position: relative;
  font-size: 17px;
  padding: 10px;
  background: rgba(0, 0, 0, 0.6);
  -webkit-transform: translateY(-200px);
  -ms-transform: translateY(-200px);
  transform: translateY(-200px);
  -webkit-transition: all ease-in-out 0.1s;
  transition: all ease-in-out 0.1s;
  -webkit-transition-delay: 0.3s;
  transition-delay: 0.3s;
}
.hovereffect:hover h2 {
  -webkit-transform: translateY(0px);
  -ms-transform: translateY(0px);
  transform: translateY(0px);
  -webkit-transition-delay: 0.3s;
  transition-delay: 0.3s;
}
.hovereffect a.info {
  display: inline-block;
  text-decoration: none;
  padding: 7px 14px;
  text-transform: uppercase;
  margin: 150px 0 0 0;
  background-color: #429FFD;
  -webkit-transform: translateY(-200px);
  -ms-transform: translateY(-200px);
  transform: translateY(-200px);
  color: #000;
  border: 1px solid #000;
  -webkit-transition: all ease-in-out 0.3s;
  transition: all ease-in-out 0.3s;
}
.hovereffect a.info:hover {
  box-shadow: 0 0 5px #fff;
}
.hovereffect:hover a.info {
  -webkit-transform: translateY(0px);
  -ms-transform: translateY(0px);
  transform: translateY(0px);
  box-shadow: 0 0 5px #000;
  color: #000;
  border: 1px solid #000;
  -webkit-transition-delay: 0.3s;
  transition-delay: 0.3s;
}
</style>
	<div id="page">
		<?php $this->load->view('header'); ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom: 0">
      <h2 style="text-align:center; color:#191970;">Memorandum of Understanding</h2>
      </div>
    </div>
    <div id="colorlib-counter" class="colorlib-counters" style="background-image: url(<?=base_url();?>dist/images/home/back1.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-sitemap"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$mous_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">MoUs</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-globe"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$int_mous_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">International MoUs</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-tasks"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$projects_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Projects</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-user"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$intern_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Interns</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
      <br>
	  <?php 
			  $international = [];
			  $national = [];
			  foreach ($mous as $value) {
				  if($value->scope == 'International')	$international[] = $value;
				  elseif($value->scope == 'National')	$national[] = $value;
			  }
			$onerow = 3; 
			$times = ceil(count($international) / $onerow); 
		?>
    <div class="row">
		<div class="text-center colorlib-heading animate-box" style="margin-bottom: 20px;padding-left:5%">
			<h1 style="display:inline;margin-left:12%">SAKEC Collaborations</h1>
			<div style="display:inline;float:right;margin-right:10em;"><a href="#" class="btn btn-danger" id="download">Download</a></div>
		</div>
	</div>
		<h2 style="margin-left: 6%;"><b>International:</b></h2>
		<?php for($i = 1; $i <= $times; $i++){ ?>
			<div class="row">
			<?php for($j = 0; $j < $onerow; $j++){ ?>
			<?php 
					$current = $j + (($i - 1) * $onerow); 
					if(isset($international[$current])){ 
			?>
			<div class="col-md-4">
			<div class="hovereffect">
				<div class="img" style="background-repeat:no-repeat;background-size: 100% 100%;background-image: url(<?=base_url();?>illustrations/mous/logos/<?=$international[$current]->logo;?>);position:relative; left: 18%;border:2px solid black;border-radius: 20px;width:300px;height:300px;">
		
				</div>
				<div class="overlay">
           <a class="info" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" data-mousid="<?=$international[$current]->id;?>">More Details</a>
				</div>
        <p style="color:black;"><b><?=$international[$current]->name;?></b></p>
			</div>
    	</div>
			<?php }
		
		} ?>
		  </div><br>
		  <hr class="style1">
		<?php } 
		$onerow = 3; 
		$times = ceil(count($national) / $onerow); 
		?>
		<h2 style="margin-left: 6%;"><b>National:</b></h2>
		<?php for($i = 1; $i <= $times; $i++){ ?>
			<div class="row">
			<?php for($j = 0; $j < $onerow; $j++){ ?>
			<?php 
					$current = $j + (($i - 1) * $onerow); 
					if(isset($national[$current])){ 
			?>
			<div class="col-md-4">
			<div class="hovereffect">
				<div class="img" style="background-repeat:no-repeat;background-size: 100% 100%;background-image: url(<?=base_url();?>illustrations/mous/logos/<?=$national[$current]->logo;?>);position:relative; left: 18%;border:2px solid black;border-radius: 20px;width:300px;height:300px;">
		
				</div>
				<div class="overlay">
           <a class="info" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" data-mousid="<?=$national[$current]->id;?>">More Details</a>
				</div>
        <p style="color:black;"><b><?=$national[$current]->name;?></b></p>
			</div>
    	</div>
			<?php }
		
		} ?>
		  </div><br>
		<?php } ?>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Fetching...</h4>
					</div>
					<div class="modal-body">
						<img style="height: 180px;max-width: 50%;" id="modal-handshake"/>
						<img style="height: 100%;width: 100%;" id="modal-logo"/>
						<br>
						<br>
						<span id="mous-info" style="color:black;"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<?php $this->load->view('footer'); ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
  <?php $this->load->view('scripts'); ?>
  
  <script>
	$("#pagetitle").html("Research Cell | MoUs");
	$(".treeview").removeClass('active');
	$(".treeview").eq(3).addClass("active");
	$(document).ready(function(e){
		$(".projects").each(function(e){
		var huh = $(this);
		var mous = $(this).data('id');
		$.ajax({
			url: "<?=base_url();?>index.php/Ctrl_mous/getMousProjectCount",
			data: {mous: mous},
			type: 'POST',
			success: function(result){
			if(result == 0) huh.html("In Process");
			else huh.html(result);
			}
		});
		});
	});
	$("#download").on("click", function(e){
		window.open("<?=base_url()?>index.php/Ctrl_twork/downloadMous/", '_blank');
	});
	</script>
	<script>
		$(".info").on("click",function(){
			var mousid = $(this).data('mousid');
			$.ajax({
				url:"<?=base_url();?>index.php/Ctrl_mous/getMous/"+mousid,
				type:"POST",
				success:function(result){
					if(result != '0'){
						var out = $.parseJSON(result);
						var output = out[0];
						$(".modal-title").html(output.name);
						if(!output.image){
							$("#modal-handshake").attr("src", "<?=base_url();?>illustrations/mous/handshake-tm.png");
							$("#modal-logo").attr("src", "<?=base_url();?>illustrations/mous/logos/"+output.logo);
							$("#modal-logo").css({"width": ""});
							$("#modal-logo").css({"max-width": "50%"});
						}else{
							$("#modal-handshake").attr("src", "");
							$("#modal-logo").attr("src", "");
							$("#modal-logo").css({"width": "100%"});
							$("#modal-logo").attr("src", "<?=base_url();?>illustrations/mous/"+output.image);
						}
						$("#mous-info").html("<b><u>Name</u></b>: " + output.name);
						$("#mous-info").append("<br>" + "<b><u>Date of signing</u></b>: " + new Date(output.date).toDateString());
						$("#mous-info").append("<br>" + "<b><u>Total Projects</u></b>: " + out[1]);
						if(out[1] != "In Process"){
							$('#mous-info').append(" &nbsp;(<a href='<?=base_url();?>index.php/Ctrl_projects?mous="+mousid+"'>View Projects</a>)");
						}
						$("#mous-info").append("<br>" + "<b><u>Total Students Enrolled</u></b>: " + out[2]);
						$("#mous-info").append("<br>" + "<b><u>Total Faculties Enrolled</u></b>: " + out[3]);
					}
				}
			});
		});
	</script>
</body>
</html>


