<!DOCTYPE HTML>
<html>
  <?php $this->load->view('head'); ?>
	<body>

	<style>
		.tbdata{
				width:250px;
				text-align:center;
				color:black;
		}
		.tbdataid{
				max-width:20px;
				text-align:center;
				color:black;
		}
		.tbheader{
				width: 250px;
				color: black;
				text-align: center;
				font-weight: bold;
		}
	</style>

	<div class="colorlib-loader"></div>

	<div id="page">
    <?php $this->load->view('header'); ?>
	<?php
	if($page == 1):
	?>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
				<li style="background-image: url(<?=base_url();?>dist/images/events/eveback.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/events/pro1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/events/pro2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/events/pro3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/events/pro4.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
						 <div class="row">
						 </div>
			   		</div>
			   	</li>	
			  	</ul>
		  	</div>
		</aside>
		<?php
		endif;
		?>
		<div class="colorlib-blog colorlib-light-grey" style="padding-top: 2em;">
			<div class="container">
				<div class="row">
					<a href="<?=base_url()?>index.php/Ctrl_events/loginCheck/" style="float:right;" class="btn btn-info">Add Event</a>
					<a href="<?=base_url()?>index.php/Ctrl_twork/downloadEvents/" target="__blank" style="float:right;" class="btn btn-danger">Download Events</a>
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom:0;">
						<h2>Our Events</h2>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name</p>
					</div>
					<?php
					if($page == 1){
					?>
					<br>
					<table class="table table-borderless" style="margin-top: 12em;margin-bottom	: 5em;" id="events" border="1">
					<thead>
							<tr>
									<th class="tbheader"><h4>Sr no.</h4></th>
									<th class="tbheader"><h4>Name</h4></th>
									<th class="tbheader"><h4>Date</h4></th>
									<th class="tbheader"><h4>Description</h4></th>
									<th class="tbheader"><h4>Status</h4></th>
							</tr>
					</thead>
					<tbody>
						<?php
						foreach($tabledata as $id => $value){
							echo "<tbody>";
							echo "<tr>";
							$sr = $id + 1;
							echo "<td class='tbdataid'>".$sr.".</td>";
							echo "<td class='tbdata'>".$value->name."</td>";
							echo "<td class='tbdata'>".$value->date."</td>";
							echo "<td class='tbdata'><a target='__blank' href='".$value->details."'>Click here</a></td>";
							echo "<td class='tbdata'>".ucfirst($value->type)."</td>";
							echo "</tr>";
							echo "</tbody>";
						}
						?>
					</tbody>
				</table>
				</div>
				<br>
				<?php
				}
				?>
				<div class="row">
				<?php
					$i = ($offset-1)*5;
					$pages = ceil($totcount / 6);
					$newpages = ($pages - ($offset*5));
					if($newpages > -5){
						if(!empty($events)){
							foreach($events as $id => $data):
				?>
					<div class="col-md-4 animate-box">
						<article class="article-entry" style="border: 1px solid black;border-radius: 15px;">
							<a href="<?=base_url();?>index.php/Ctrl_events/event/<?=$data->id;?>" class="blog-img" style="border-bottom: 1px solid black;background-image: url(<?=base_url();?>illustrations/events/<?=$data->image;?>);">
								<p class="meta"><span class="day"><?=date("d", strtotime($data->date));?></span><span class="month"><?=date("M", strtotime($data->date));?></span></p>
							</a>
							<div class="desc">
								<h2><a href="<?=base_url();?>index.php/Ctrl_events/event/<?=$data->id;?>"><?=substr($data->name, 0, 25);?><?php if(strlen($data->name) >= 25){ echo '...'; }?></a></h2>
								<p><?=substr(strip_tags(html_entity_decode($data->details)), 0, 100);?>...</p>
								<p><a href="<?=base_url();?>index.php/Ctrl_events/event/<?=$data->id;?>" class="btn-learn">Learn More <i class="icon-arrow-right3"></i></a></p>
							</div>
						</article>
					</div>
					<?php
						endforeach;
						}else{
							echo "<p>No results!</p>";
						}
					}else{
						echo "<p>Wrong link!</p>";
					}
						?>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<ul class="pagination">
						<?php if($offset != 1): ?>
							<li><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$page;?>&offset=<?=$offset-1?>"><i class="fa fa-angle-left"></i></a></li>
						<?php endif; ?>
						<?php if($newpages > -5){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset;?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -4){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset;?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -3){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset;?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -2){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset;?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -1){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset;?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > 0){ ?><li><a href="<?=base_url();?>index.php/Ctrl_events/page/<?=$i;?>?offset=<?=$offset+1;?>"><i class="fa fa-angle-right"></i></a></li><?php } ?>
						</ul>
					</div>	
				</div>
			</div>
    	</div>
    
		<?php $this->load->view('footer'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
  <?php $this->load->view('scripts'); ?>
  
  <script>
  $("#pagetitle").html("Research Cell | Events");
  $(".treeview").removeClass('active');
  $(".treeview").eq(2).addClass('active');
	</script>

	</body>
</html>


