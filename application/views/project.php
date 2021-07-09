<!DOCTYPE HTML>
<html>

  <?php $this->load->view('head'); ?>

	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">

    <?php $this->load->view('header'); ?>
		<div class="colorlib-event" style="padding: 1em; background-color: #191970;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom: 1px;">
						<h2 style="color: white; text-shadow: -2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Project: <?=$project->title;?></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-blog colorlib-grey" style="padding: 2em">
			<div class="container">
        <div class="event-flex row-pb-sm">
					<div class="half event-img animate-box" style="  border:5px solid black;background-size: 100% 100%;background-image: url(<?=base_url();?>illustrations/projects/<?=$project->image;?>);">
					</div>
					<div class="half">
						<div class="row">
							<div class="col-md-12 animate-box">
								<div class="event-entry">
									<div class="desc">
										<h1 style="position:relative;right:18%; color:#191970 ;"><?=$project->title;?></h1>
									</div>
										<h4 class="organizer">Collaboration: <span><?=$project->collab;?></span></h4>
										<div class="desc">
										<h2 style="position:relative;right:18%;">Objectives:</h2>
										</div>
									<ul>
									<?php
											$objarr = explode('-$$-', $project->objectives);
											foreach($objarr as $id => $data){
													echo '<li style="color:black;position:relative;right:5%;">'.$data.'</li>';
											}
									?>
									</ul>
										<a href="<?=base_url()?>illustrations/projects/excel/<?=$project->excel?>" target="_blank" style="position:relative;">Download Project Excel Sheet</h2>
								</div>
							</div>          
						</div>
					</div>
				</div>
				<div class="col-md-12">
				<div class="table-responsive">
				<table class="table table-borderless">
					<thead>
						<tr colspan="3">
							<th scope="col"><h3>Participants:</h3></th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td style="width:250px;height:300px;text-align:center;" colspan="3">
							<img style="width150px;height:200px;" src="<?=base_url();?>illustrations/projects/pics/<?php if(!empty($pro_details[0]->pic)){ echo $pro_details[0]->pic; } else{ echo 'default.jpg'; }?>"/><br><span style="color:black;"><strong><?=$pro_details[0]->name;?></strong><br><?=$pro_details[0]->role;?><br><?=$pro_details[0]->description;?> - <?=$pro_details[0]->branch;?><span>
						</td>
					</tr>
					<?php
						$j = 1;
						$times = (int) ceil(count($pro_details) / 3);
						while($j <= $times):
							echo '<tr>';
							for($i=1;$i<=3;$i++):
								$real = (($j-1) * 3) + $i;
								if(isset($pro_details[$real])){
						?>
							<td scope="row" style="width:250px;height:300px;text-align:center;">
								<img style="width:150px;height:200px;" src="<?=base_url();?>illustrations/projects/pics/<?php if(!empty($pro_details[$real]->pic)){ echo $pro_details[$real]->pic; } else{ echo 'default.jpg'; }?>"/>
								<br><span style="color:black;"><strong><?=$pro_details[$real]->name;?></strong><br><?=$pro_details[$real]->role;?><br><?=$pro_details[$real]->description;?> - <?=$pro_details[0]->branch;?><span>
							</td>
						<?php
								}
							endfor;
							echo '</tr>';
							$j++;
						endwhile;
					?>
					</tbody>
				</table>
				</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="event-entry">
							<div class="desc">
								<h2 style="color: black; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;position:relative;right:8%;"><strong>Description:</strong></h2>
							</div>
								<h4 class="organizer"><span id='pro_desc'><?=html_entity_decode($project->overview);?></span></h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="event-entry" style="width:100%; height:100%;">
								<img src="<?=base_url();?>illustrations/projects/team/<?=$project->team;?>" style="width:100%;height:100%;"/>
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
  $("#pagetitle").html("Research Cell | Project - <?=$pno?>");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
	</script>
	</body>
</html>