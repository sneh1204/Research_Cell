<!DOCTYPE HTML>
<html>
  <?php $this->load->view('head'); ?>
	<body>

	<style>
		th, td{
			color: black;
		}
		th{
			text-align: center;
			font-size: 20px;
			text-decoration: underline;
			background-color: #E5E9E9;
		}
		.active{
			color: #429FFD;
			font-size: 20px;
		}
		.typelink:hover {
			color: #429FFD;
			font-size: 20px;
		}
	</style>

	<div class="colorlib-loader"></div>

	<div id="page" style="text-align: left;">
    <?php $this->load->view('header'); ?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box" style="margin-bottom: 0px;">
			<h2 style="text-align:center; color:#191970;">Publications</h2>
		</div>
	</div>
	<div id="colorlib-counter" class="colorlib-counters" style="background-image: url(<?=base_url();?>dist/images/home/back1.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-file-alt"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$paper_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Papers</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-book"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$book_chap_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Books/Chap</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-copyright"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$copyright_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Copyrights</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-id-card"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$patent_count?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Patents</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<section id="top"></section>
		<div class="colorlib-blog colorlib-light-grey" style="padding-top: 0px;">
			<div class="container" style="width:90%">
				<div style="padding-bottom:3%"></div>
				<div class="row">
				<div class="col-md-4">
				<h3 style="float:right;">Research Publications -</h3>
				</div>
				<div class="col-md-8">
				<a style="float: right;" id="add" class="btn btn-primary" href="<?=base_url()?>index.php/Ctrl_tform">Add your Publication</a>
				<a style="float: right;" class="btn btn-danger" id="download">Download Publications</a>
				<div class="col-md-3" style="float:right;">
					<select id="dept" class="form-control filter" style="border: 1px solid #429FFD;">
						<option selected="selected" value="0">Select Department</option>
						<option value="Computer Engineering">Computer Engineering</option>
						<option value="Information Technology">Information Technology</option>
						<option value="Electronics and Telecommunications">Electronics and Telecommunications</option>
						<option value="Electronics Engineering">Electronics Engineering</option>
						<option value="Human Science">Human Science</option>
					</select>
				</div>
				<div class="col-md-3" style="float:right;padding-left:0px;">
					<select id="year" class="form-control filter" style="border: 1px solid #429FFD;">
						<option selected="selected" value="0">Select Year</option>
					</select>
				</div>
				</div>
				</div>
				</div>
				<div class="container" style="width:100%;">
				<div style="padding-bottom:2%;"></div>
				<div class="row">
				<table border="2px" id="maintable" class="table table-borderless" style="max-width:80%;float:right;margin-right:3%">
					<tr class="subrow">
					<th style="width: 5%;">Sr. no</th>
					<th style="width: 30%">Title</th>
					<th>Authors</th>
					<th>Journal/Conference</th>
					<th>Link</th>
					</tr>
				</table>
				<div id="sticky">
				<table frame="box" class="table table-borderless" style="margin-left: 1%;width: 15%;background-color:#F8F8F8;color:black;">
					<tr style="background-color: #429FFD; color:white; font-size: 20px;" class="typelink"><td><b>Type:</b></td></tr>
					<tr class="typelink active" id="selected" data-type="paper"><td><a href="#top"><i id="arrow" class="fa fa-arrow-right" aria-hidden="true"></i> Journal/Conference</a></td></tr>
					<tr class="typelink" data-type="book"><td><a href="#top">Books</a></td></tr>
					<tr class="typelink" data-type="chapter"><td><a href="#top">Chapters in Books</a></td></tr>
					<tr class="typelink" data-type="copyright"><td><a href="#top">Copyright</a></td></tr>
					<tr class="typelink" data-type="patent"><td><a href="#top">Patent</a></td></tr>
					<tr class="typelink" data-type="tech"><td><a href="#top">Tech Article</a></td></tr>
					<tr class="typelink" data-type="certi"><td><a href="#top">Certification</a></td></tr>
				</table>
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
	$(document).ready(function(){
		getDataByFilter("paper", "0", "0");
		if($('#sticky').length){
			var el = $('#sticky');
			var top = $('#sticky').offset().top;
			var height = $('#sticky').height();
			$(window).scroll(function(){
				var wtop = $(window).scrollTop();
				var limit = $('#colorlib-footer').offset().top - height - 20;
				if(top < wtop){
					el.css({position: 'fixed', top: '1%', width: '100%'});
				}else{
					el.css('position', 'static');
				}
				if(limit < wtop){
					var diff = limit - wtop;
					el.css({top: diff});
				}
			});
		}
		$("#download").on("click", function(e){
			window.open("<?=base_url()?>index.php/Ctrl_twork/download/"+$('#selected').data("type")+"/"+$('#year').val()+"/"+$("#dept").val(), '_blank');
		});
		$(".typelink").on("click", function(e){
			if(!$(this).hasClass('active')){
				var clicked = $(this);
				var type = $(this).data('type');
				$(".typelink").each(function() {
					$(this).removeClass("active");
					$(this).removeAttr("id");
				});
				clicked.attr("id", "selected");
				clicked.addClass("active");
				$("#arrow").remove();
				var li = clicked.find('a');
				li.prepend('<i id="arrow" class="fa fa-arrow-right" aria-hidden="true"></i> ');
				getDataByFilter(type, $('#year').val(), $("#dept").val());
			}
		});
	});
	function getDataByFilter(type, year, dept){
		$.ajax({
          url: "<?=base_url();?>index.php/Ctrl_pfunctions/getPublicationDataByFilter/",
          type: "POST",
		  data: {year:year, dept:dept, type:type},
          success:function(result){
			$("#maintable").html("");
			output = $.parseJSON(result);
			var i;
			var sr=1;
			switch(type){
				case 'paper':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Title</th><th>Author/s</th><th>Journal/Conference</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].title+'</td><td class="sub">'+output[i].authors+'</td><td class="sub">'+output[i].name+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'book':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Title</th><th>Name</th><th>Role</th><th>Publisher</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].title+'</td><td class="sub">'+output[i].fname+'</td><td class="sub">'+output[i].role+'</td><td class="sub">'+output[i].publisher+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'chapter':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Title</th><th>Author</th><th>Publisher</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].title+'</td><td class="sub">'+output[i].fname+'</td><td class="sub">'+output[i].publisher+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'copyright':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Title</th><th>Applicant</th><th>Class of Work</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].title+'</td><td class="sub">'+output[i].applicant+'</td><td class="sub">'+output[i].class+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'patent':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Title</th><th>Applicant</th><th>Status</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].title+'</td><td class="sub">'+output[i].applicant+'</td><td class="sub">'+output[i].status+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'tech':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Topic</th><th>Authors</th><th>Role</th><th>Link</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].topic+'</td><td class="sub">'+output[i].name+'</td><td class="sub">'+output[i].role+'</td><td class="sub"><a href="'+output[i].link+'" target="__blank">Click here</a></td>');
						sr = sr + 1; 
					}
				break;
				case 'certi':
					$("#maintable").html('<tr class="subrow"><th style="width: 5%;">Sr. no</th><th style="width: 30%">Certi Name</th><th>Author</th><th>Details</th><th>Date</th></tr>');
					for(i = 0; i < output.length; i++){
						$("#maintable").append('<tr style="color:grey;" class="subrow"><td class="sub">'+sr+'.</td><td class="sub" style="width: 100%">'+output[i].certiname+'</td><td class="sub">'+output[i].name+'</td><td class="sub">'+output[i].details+'</td><td class="sub">'+output[i].date+'</td>');
						sr = sr + 1; 
					}
				break;
			}
			$(".sub").css("word-break", "normal");
			$(".sub").css("width", "100px");
          }
        });
	}
	</script>
	<script>
	$('.filter').on('change', function() {
		getDataByFilter($('#selected').data('type'), $('#year').val(), $("#dept").val());
	});
	</script>
  	<script>
		var dt = new Date();
		var global = 1900;
		var year = dt.getYear() + global;
		var i;
		var next;
		var nextstr;
		for(i = 1980; i <= year; i++){
		next = i + 1;
		next = next.toString();
		nextstr = next.substring(next.length - 2);
		if(i == year) $('#year').append($("<option></option>").attr('value', i + '-' + nextstr).text(i + '-' + nextstr));
		else  $('#year').append($("<option></option>").attr('value', i + '-' + nextstr).text(i + '-' + nextstr));
		}
	</script>
  <script>
  $("#pagetitle").html("Research Cell | Faculty Publications");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
	</script>

	</body>
</html>


