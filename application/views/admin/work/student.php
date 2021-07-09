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
                                if(isset($confirmed)){
                                ?>
                                <div class='alert alert-success'>
                                <strong>Publication no. <?=$confirmed?> confirmed successfully!</strong>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="clearfix"></div><br>
                                
                                <table id="bootstrap-data-table" class="table table-bordered">
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($studentwork as $data){
                                        if($data->confirm == 1){
                                            echo '<tr><td>'.$data->id.'</td><td>'.$data->name.'</td><td>'.$data->email.'</td><td>'.ucfirst($data->title).'</td><td><a style="color:green;" href="http://'.$data->link.'" target="__blank">View</a></td><td><span style="color: cyan;">Confirmed</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: red;" href="'.base_url().'index.php/Ctrl_del/sform/'.$data->id.'">Delete</a></td></tr>';
                                        }else{
                                            echo '<tr><td>'.$data->id.'</td><td>'.$data->name.'</td><td>'.$data->email.'</td><td>'.ucfirst($data->title).'</td><td><a style="color:green;" href="http://'.$data->link.'" target="__blank">View</a></td><td><a style="color: green;" href="'.base_url().'index.php/Ctrl_list/confirm/student/'.$data->id.'">Confirm</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: red;" href="'.base_url().'index.php/Ctrl_del/sform/'.$data->id.'">Delete</a></td></tr>';
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.breadcrumbs .page-title h1').html('Events');
            $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
            $('.breadcrumbs .text-right a').eq(1).html('Publications');
            $('.breadcrumbs .text-right li').eq(2).html('Student');
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
    <script>
    var $ = jQuery.noConflict();
    $("#title").html("Admin | List Student Work");
    </script>

</body>
</html>
