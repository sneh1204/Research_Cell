<!DOCTYPE HTML>
<html>
<?php $this->load->view('head'); ?>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">

    <?php $this->load->view('header'); ?>
    
    <div class="colorlib-blog colorlib-white" style="padding: 2em">
		<div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <div class="event-entry" style="width:100%; height:100%;">
                        <div class="desc">
                            <h1 style="position:relative;right:7%; color: black; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">:: Error 404 ::</h1>
                        </div>
                        <h4 class="organizer"><u>Reason:</u> <span>`<strong><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);} else echo 'Invalid Request'; ?></strong>`</span></h4>
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
        $("#pagetitle").html("Research Cell | Error");
        $(".treeview").removeClass('active');
	</script>
	</body>
</html>