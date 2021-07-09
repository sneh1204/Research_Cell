<!DOCTYPE HTML>
<html>
  <?php $this->load->view('head'); ?>

	<body>

	<style>
		.tbdata{
				width:400px;
				text-align:center;
				color:black;
		}
		.tbheader{
				width: 400px;
				color: black;
				text-align: center;
				font-weight: bold;
		}
		.tbparti{
			width: 520px;
			color: black;
			text-align: left;
		}
		.tbpartidept{
			width: 520px;
			color: black;
			text-align: left;
		}
	</style>
		
	<div class="colorlib-loader"></div>

	<div id="page">

    <?php $this->load->view('header'); ?>
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

				<?php
				if(isset($_GET['projects'])):
					$year = "20" . $_GET['projects'] . "-" . ++$_GET['projects'];
				?>
				<div class="colorlib-blog colorlib-light-grey" style="padding-bottom: 0;">
				<div class="container" style="margin: 0; width: 100%">
				<div class="row">
				<a target="__blank" href="<?=base_url()?>index.php/Ctrl_projects/downloadExcel/<?=$year?>" style="float:right;" class="btn btn-danger">Download Projects</a>
				<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
					<h2>Our Projects</h2>
					<p>List of all projects that came under our banner in <b><?=$year?></b>.</p>
				</div>
				</div>
				<div class="row" style="margin: 0;">
				<div class="table-responsive">
				<table class="table table-borderless" id="projects" border="1">
					<thead>
							<tr>
									<th class="tbheader"><h4>Sr no.</h4></th>
									<th class="tbheader"><h4>Title</h4></th>
									<th class="tbheader"><h4>In Collaboration With</h4></th>
									<th class="tbheader"><h4>Participants</h4></th>
									<th class="tbheader"><h4>Status</h4></th>
									<th class="tbheader"><h4>Details</h4></th>
									<th class="tbheader"><h4>Achievements/Remarks</h4></th>
							</tr>
					</thead>
					<tbody>
						<?php
						function getMousName($id, $mous){
							if(!is_numeric($id))  return $id;
							$id = (int) $id;
							foreach($mous as $value){
							  if($value->id == $id){
								return $value->name;
							  }
							}
							return "";
						}
						function getMentors($id, $tabledatadetails){
							$max = 25;
							$sr = 1;
							$str = "";
							foreach($tabledatadetails as $value){
								if($value->id == $id){
									if($value->role == 'Project_Coordinator'){
										$str .= $sr++ . ". ";
										if(strlen($value->name) > $max){
											$str .= substr($value->name, 0, $max) . "...";
										}else{
											$str .= $value->name;
										}
										$str .= " <span style='float:right;'>[" . $value->branch . "]</span>" . "<br>";
									}
								}
							}
							return str_replace("_", " ", $str);
						}
						function getPartis($id, $tabledatadetails){
							$max = 30;
							$sr = 1;
							$str = "";
							foreach($tabledatadetails as $value){
								if($value->id == $id){
									if($value->role == 'Student'){
										$str .= $sr++ . ". ";
										if(strlen($value->name) > $max){
											$str .= substr($value->name, 0, $max) . "...";
										}else{
											$str .= $value->name;
										}
										$str .= " <span style='float:right;'>[" . $value->description . "-" . $value->branch . "]</span>" . "<br>";
									}
								}
							}
							return str_replace("_", " ", $str);
						}
						function getPartiData($id, $tabledatadetails){
							$str = "<b>Mentors: </b><br>" . getMentors($id, $tabledatadetails) . "<b>Students: </b><br>" . getPartis($id, $tabledatadetails);
							return str_replace("_", " ", $str);
						}
						$i = 0;
						foreach($tabledata as $id => $value){
							if($value->year == $year){
								$i++;
								echo "<tbody>";
								echo "<tr>";
								$sr = $id + 1;
								echo "<td class='tbdata'>".$i.".</td>";
								echo "<td class='tbdata' style='word-break: break-all'>".str_replace("_", "", $value->title)."</td>";
								if(!is_numeric($value->mous)){
									echo "<td class='tbdata'>".getMousName($value->mous, $mous)."</td>";
								}else{
									echo "<td class='tbdata'><a href='".base_url()."index.php/Ctrl_projects?mous=".$value->mous."'>".getMousName($value->mous, $mous)."</a></td>";
								}
								echo "<td class='tbparti' style='width: 800px;max-width: 1000px;overflow:hidden'>".getPartiData((int) $value->id, $tabledatadetails)."</td>";
								echo "<td class='tbdata'>".$value->status."</td>";
								if($value->details != ""){
									echo "<td class='tbdata'><a href='".base_url()."illustrations/projects/details/".$value->details."' class='btn btn-success'>Details</a></td>";
								}else{
									echo "<td class='tbdata'><a href='#' class='btn btn-success'>Details</a></td>";
								}
								echo "<td class='tbdata'>".$value->achievements."</td>";
								echo "</tr>";
								echo "</tbody>";
							}
						}
						?>
					</tbody>
				</table>
				</div>
				</div>
				<br>
				</div>
				</div>
				<?php
				endif;
				?>
		
		<div class="colorlib-blog colorlib-light-grey">
			<div class="container">
				<div class="row">
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Fetching...</h4>
							</div>
							<div class="modal-body">
								<img style="height: 100%;max-width:100%;max-height:100%;" id="modal-head"/>
								<img style="height: 100%;max-width:100%;max-height:100%;" id="modal-data"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Our Launched Projects</h2>
						<p>List of different projects that were successfully conducted under our banner.</p>
					</div>
					<a href="<?=base_url()?>index.php/Ctrl_projects/loginCheck/" style="float:right;" class="btn btn-info">Add Projects</a>
				</div>
				<br>
				<br>
				<div class="row">
					<?php
						$i = ($offset-1)*5;
						$pages = ceil($totcount / 6);
						$newpages = ($pages - ($offset*5));
						if($newpages > -5){
							if(!empty($projects)){
								foreach($projects as $id => $data):
					?>
						<div class="col-md-4 animate-box">
							<article class="article-entry" style="border: 1px solid black;border-radius: 15px;">
								<a class="blog-img" style="border-bottom: 1px solid black;background-image: url(<?=base_url();?>illustrations/projects/<?=$data->image;?>);background-size: contain;" href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>">
								</a>
								<div class="desc">
									<h2><a href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>"><?=substr($data->title, 0, 27);?><?php if(strlen($data->title) >= 27){ echo '...'; }?></a></h2>
									<p><?=substr(strip_tags(html_entity_decode($data->overview)), 0, 100);?>...</p>
									<p><a href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>" class="btn-learn">Learn More <i class="icon-arrow-right3"></i></a></p>
								</div>
							</article>
						</div>
					<?php
						endforeach;
					}else{
						echo "<h3>- No results! -</h3>";
					}
				}else{
					echo "<h3>- Wrong link! -</h3>";
				}
					?>
				</div>
				</div>
				<?php
				if(!isset($_GET['mous']))	$_GET['mous'] = ""; 
				?>
				<?php if(!empty($projects)){ ?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<ul class="pagination">
						<?php if($offset != 1): ?>
							<li><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$page;?>&offset=<?=$offset-1?>"><i class="fa fa-angle-left"></i></a></li>
						<?php endif; ?>
						<?php if($newpages > -5){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset;?>&mous=<?=$_GET['mous']?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -4){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset;?>&mous=<?=$_GET['mous']?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -3){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset;?>&mous=<?=$_GET['mous']?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -2){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset;?>&mous=<?=$_GET['mous']?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > -1){ ?><li <?php if($page == ++$i): ?> class="active"<?php endif; ?>><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset;?>&mous=<?=$_GET['mous']?>"><?=$i;?></a></li><?php } ?>
						<?php if($newpages > 0){ ?><li><a href="<?=base_url();?>index.php/Ctrl_projects/page/<?=$i;?>?offset=<?=$offset+1;?>&mous=<?=$_GET['mous']?>"><i class="fa fa-angle-right"></i></a></li><?php } ?>
						</ul>
					</div>	
				</div>	
				<?php } ?>
			</div>	
    </div>
    
		<?php $this->load->view('footer'); ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
  <?php $this->load->view('scripts'); ?>
  <script src="<?=base_url();?>plugins/SheetJS/xlsx.full.min.js"></script>
  <script src="<?=base_url();?>plugins/SheetJS/FileSaver.min.js"></script>
  
  <script>
	$(document).ready(function() {
		/*
		var wb = XLSX.utils.table_to_book(document.getElementById('projects'), {sheet:"Sheet JS"});
		var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});
		function s2ab(s) {
			var buf = new ArrayBuffer(s.length);
			var view = new Uint8Array(buf);
			for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
			return buf;
		}
		$("#downloadExcel").click(function(){
			saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Research_Projects.xlsx');
		}); 
		*/
	});
  $("#pagetitle").html("Research Cell | Projects");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
	$('.tbdata').on("click", function(){
		var proid = $(this).data('proid');
		var title = $(this).data('title');
			if(proid && title){
				$(".modal-title").html(title);
				$("#modal-head").attr("src", "<?=base_url();?>illustrations/projects/ongoing/heads.png");
				$("#modal-data").attr("src", "<?=base_url();?>illustrations/projects/ongoing/pros"+proid+".png");
				$("#modal-data").css({"width": "100%"});
				if(proid == 3 || proid == 4 || proid == 8 || proid == 9 || proid == 10 || proid == 11 || proid == 12 || proid == 13 || proid == 14){
					$("#modal-data").css({"width": "56%"});
				}
			}
	});
	</script>

	</body>
</html>