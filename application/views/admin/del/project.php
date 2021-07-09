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
        <?php $this->load->view('admin/breadcrumb');?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        Are you sure you want to delete project `<strong><?=$title;?></strong>`?
                            <div style="position:relative;top:50px;">
                                <button id="submit" class="btn btn-danger">
                                <i class="fa fa-dot-circle-o"></i> Delete
                                </button>&nbsp;&nbsp;
                                <button id="cancel" class="btn btn-primary" onClick="goBack();">
                                <i class="fa fa-ban"></i> Cancel
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div><br><br>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
    function goBack(){
        window.location.href="<?=base_url();?>index.php/Ctrl_list/project";
    }
    var $ = jQuery.noConflict();
    $("#title").html("Admin | Delete Project");
    $(document).ready(function() {
        $('.breadcrumbs .page-title h1').html('Delete Project');
        $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
        $('.breadcrumbs .text-right a').eq(1).html('Project').attr("href", "<?=base_url();?>index.php/Ctrl_list/project");
        $('.breadcrumbs .text-right li').eq(2).html('Delete');
          $("#submit").on("click",function(){
            $.ajax({
            url:"<?=base_url();?>index.php/Ctrl_functions/delProject/<?=$id?>",
            type:"POST",
            success:function(result){
            if(result != '0'){
                window.location.href="<?=base_url();?>index.php/Ctrl_list/project/deleted";
            }
            else{
                alert("Project doesnt exist!");
            }
            }
        });
        });
    });
    </script>

</body>
</html>
