<!DOCTYPE HTML>
<html>

  <?php $this->load->view('head'); ?>

	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page" style="text-align: left;">

    <?php $this->load->view('header'); ?>
		<div class="colorlib-event" style="padding: 1em; background-color: #191970;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom: 1px;">
						<h2 style="color: white; text-shadow: -2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;"><?=$details->name;?>'s Publications</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-blog colorlib-grey" style="padding: 2em">
			<div class="container">
            <div class="event-flex row-pb-sm">
						<div class="row">
							<div class="col-md-12 animate-box" style="width:1200px;">
								<div class="event-entry">
                                <img src="https://scholar.google.co.in/citations?view_op=view_photo&user=<?=$details->scholarid?>&citpid=2" style="width:128px;height:128px;border-radius:50%;"/>
									<div class="desc">
                                    <br>
                                    <h1 style="position:relative;right:6%; color:#191970 ;"><?=$details->name;?></h1>
									</div>
										<h4 class="organizer" style="position:relative;left:1%;">Designation: <span style="color:#808080;"><?=$designation;?></span></h4>
										<div class="desc">
										<h2 style="position:relative;right:6%;">Publication Domains:</h2>
										</div>
									<ul>
                                    <?php 
                                    foreach($domains as $domain){
                                        echo '<li>'.$domain.'</li>';
                                    }
                                    ?>
									</ul><br>
									<span style="position:relative;left:1%;"><span style="color: black;">Cited By - </span><?=$cited?></span>
								</div>
							</div>          
		
					</div>
            </div>
            <h2><u>Publications:</u></h2>
				<div class="col-md-12">
				<div class="table-responsive">
				<table class="table table-borderless">
					<tr>
                    <th>Title</th>
                    <th>Cited By</th>
                    <th>Year</th>
                    </tr>
                    <?php
                    foreach($publications as $id => $data){
                        echo '<tr>';
                        echo '<td><h3><a target="__blank" href="'.$data['link'].'">'.$data['title'].'</a></h3>'.PHP_EOL.'<h4>'.$data['authors'].'</h4></td><td>'.$data['cites'].'</td><td>'.$data['year'].'</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
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
  $(document).on('click', 'a', function (e) {
    if ($(this).attr('href') == '#') {
        e.preventDefault();
    }
});
  $("#pagetitle").html("Research Cell | Publications of <?=$details->name;?>");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
	</script>
	</body>
</html>