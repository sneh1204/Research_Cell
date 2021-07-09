<?php if(isset($_SESSION['access_token']))  redirect('Ctrl_sform/addStudentPublication'); ?>
<html>
<?php $this->load->view('head'); ?>
<?php include 'config3.php'; ?>
<body>
<div class="colorlib-loader"></div>
<div id="page">
<?php $this->load->view('header'); ?>
<div class="container">
    <div class="row">
    <br>
    <br>
    <br>
    <div class='alert alert-danger'>
    <strong>Error! Please login to access that page!</strong>
    </div>
    <?php if (isset($loginurl)){ ?>
    <div class="button" align="center" style="padding-top: 10%">
    <a class="btn btn-primary" href="<?=$loginurl?>"><img width="15px" alt="Google &quot;G&quot; Logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png"/><span style="padding-top:2px;">oogle Login</span></a><br>
    <?php } ?>
    </div>
    <div class="makespace" style="padding-top: 30%"></div>
    </div>
    </div>
<?php $this->load->view('footer'); ?>
</div>
<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>
  <?php $this->load->view('scripts'); ?>
  <script>
  $("#pagetitle").html("Research Cell | Student Login");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>