<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
?>
<!doctype html>
<html>
<?php $this->load->view('admin/head'); ?>

<body>
    <?php $this->load->view('admin/sidebar')?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('admin/header');?>
        <div class="content">
            <div class="animated fadeIn">
               <h3>:: Error 404 ::</h3><br>
               <p>Reason: `<strong><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);} else echo 'Invalid Request'; ?></strong>`</p> 
            </div>
        </div>
        <div class="clearfix"></div><br>
        <?php $this->load->view("admin/footer"); ?>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
    var $ = jQuery.noConflict();
    $("#title").html("Admin | Error");
    </script>

</body>
</html>
