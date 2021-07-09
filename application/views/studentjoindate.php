<?php if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform"); ?>
<html>
<?php $this->load->view('head'); ?>
<?php include 'config3.php'; ?>
<body>
<div class="colorlib-loader"></div>
<div id="page">
<?php $this->load->view('header'); ?>
<div class="container">
    <a style="float:right;" class="btn btn-danger" href="<?=base_url();?>index.php/Ctrl_sform/logout">Sign out</a>
    <div class="row">
    <br>
    <br>
    <br>
    <div class='alert alert-info'>
    <strong>Please enter your SAKEC Student join date!</strong>
    </div>
    <div class="button" align="center" style="padding-top: 10%">
    <input class='form-control' type='date' id='jdate' style="width:200px;border:1px solid red"/>
    <br>
    <br>
    <br>
    <a href="#" id="submit" class="btn btn-primary">Submit</a>
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
  $("#submit").on("click", function(e){
    if($('#jdate').val() == ""){
        alert("Join Date not selected");
        return;
    }else{
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addStudentJoinDate/",
          type: "POST",
          data: {date: $("#jdate").val()},
          success:function(result){
            if(result == '1'){
              window.location.href = "<?=base_url()?>index.php/Ctrl_sform/addStudentPublication";
            }
          }
        });
        return;
    }
  });
  </script>
  <script>
  $("#pagetitle").html("Research Cell | Enter Join date");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>