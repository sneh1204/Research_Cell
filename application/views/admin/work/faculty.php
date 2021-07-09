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
        <div id="dialog-form" title="Submit End Date?"></div>
        <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Publications</strong>
                            </div>
                            <div class="card-body">
                            <?php
                                if(isset($deleted)){
                                ?>
                                <div class='alert alert-danger'>
                                <strong>Publication deleted successfully!</strong>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(isset($ended)){
                                ?>
                                <div class='alert alert-danger'>
                                <strong>Faculty end date set successfully!</strong>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="clearfix"></div><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-info" href="<?=base_url();?>index.php/Ctrl_add/faculty">+ Add Faculty Publication</a>
                                <table id="bootstrap-data-table" class="table table-bordered">
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Dept</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($facultywork)){
                                        foreach($facultywork as $data){
                                            if(!isset($enddate[$data->email]) or $enddate[$data->email] == ""){
                                                echo '<tr><td>'.$data->id.'</td><td>'.$data->name.'</td><td>'.$data->email.'</td><td>'.$data->dept.'</td><td><a style="color:green;" href="'.$data->scholar.'&hl=en" target="__blank">View Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:blue;" data-email="'.$data->email.'" href="#" class="eod">End Date</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: red;" href="'.base_url().'index.php/Ctrl_del/tform/'.$data->id.'">Delete</a></td></tr>';
                                            }else{
                                                echo '<tr><td>'.$data->id.'</td><td>'.$data->name.'</td><td>'.$data->email.'</td><td>'.$data->dept.'</td><td><a style="color:green;" href="'.$data->scholar.'&hl=en" target="__blank">View Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:darkred;"<i>Left</i></span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: red;" href="'.base_url().'index.php/Ctrl_del/tform/'.$data->id.'">Delete</a></td></tr>';
                                            }
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

    <script src="<?=base_url();?>assets/js/lib/data-table/datatables.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/jszip.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?=base_url();?>assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?=base_url();?>assets/js/init/datatables-init.js"></script>

    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
    var ajax;
    var dialog = $("#dialog-form").dialog({
      autoOpen: false,
      height: 500,
      width: 500,
      modal: true,
      buttons: {
        Cancel: function() {
          dialog.dialog("close");
        },
        "Submit": {
            text : "Submit",
            id : "submit",
            click : function(){
                return;
            }
        }
      },
    });
    jQuery("#submit").on("click",function(){
        var edate = $("#edate").val();
        if(edate == "") {
            alert("End date not set.");
            return;
        }else{
            var conf = confirm("Are you sure you want to submit?");
            if(conf==true){
                $.ajax({
                    url: "<?=base_url();?>index.php/Ctrl_publications/addFacultyEndDate",
                    data: { email: $('#edate').data("email"), edate: edate},
                    type: 'POST',
                    success: function(result){
                        if(result == 1){
                            window.location.href = "<?=base_url();?>index.php/Ctrl_list/faculty/ended";
                        }else{
                            alert("Error submitting!");
                        }
                    }
                });
            }
        }
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.breadcrumbs .page-title h1').html('Events');
            $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
            $('.breadcrumbs .text-right a').eq(1).html('Publications');
            $('.breadcrumbs .text-right li').eq(2).html('Faculty');
            $('#bootstrap-data-table-export').DataTable();
            $("body").on("click", ".eod", function(){
               var email = $(this).data("email");
               $('#dialog-form').empty();
               $("#dialog-form").html('<input data-email="'+email+'" class="form-control" type="date" id="edate" style="width:200px;border:1px solid red"/>');
               dialog.dialog("open");
            });
        });
    </script>
    <script>
    var $ = jQuery.noConflict();
    $("#title").html("Admin | List Faculty Work");
    </script>

</body>
</html>
