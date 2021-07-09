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
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($deleted)){
                                ?>
                                <div class='alert alert-danger'>
                                <strong>Event deleted successfully!</strong>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(isset($edited)){
                                ?>
                                <div class='alert alert-info'>
                                <strong>Event edited successfully!</strong>
                                </div>
                                <?php
                                }
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-info" href="<?=base_url();?>index.php/Ctrl_add/event">+ Add new Event</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;<form style="display:inline;float:right;" action="#" id="update" method="POST"><input style="width:250px;" type="file" id="event" name="event" required/><input type="submit" class="btn btn-danger" value="Update Event Excel"/></form>
                                <div class="clearfix"></div><br>
                                
                                <table id="bootstrap-data-table" class="table table-bordered">
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($events as $data){
                                        echo '<tr><td>'.$data->id.'</td><td>'.$data->name.'</td><td>'.$data->date.'</td><td>'.ucfirst($data->type).'</td><td><a style="color:green;" href="'.base_url().'index.php/Ctrl_events/event/'.$data->id.'" target="__blank">View</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:blue;" href="'.base_url().'index.php/Ctrl_edit/event/'.$data->id.'">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: red;" href="'.base_url().'index.php/Ctrl_del/event/'.$data->id.'">Delete</a></td></tr>';
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
            $('.breadcrumbs .text-right a').eq(1).html('Event').attr("href", "<?=base_url();?>index.php/Ctrl_list/event");
            $('.breadcrumbs .text-right li').eq(2).html('List');
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
    <script>
    $(document).on("submit", "#update", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var formData = new FormData(this);
      $.ajax({
           url: "<?=base_url();?>index.php/Ctrl_functions/updateEventExcel",
           type: 'POST',
           data: formData,
           success: function (response) {
               if (response) {
                   alert(response);
                   if(response == 'File uploaded successfully!'){
                       $("#event").val("");
                   }
               }
           },
           error: function (error) {
               console.log(error)
           },
           cache: false,
           contentType: false,
           processData: false
      });
      return false;
 });
    </script>
    <script>
    var $ = jQuery.noConflict();
    $("#title").html("Admin | List Event");
    </script>

</body>
</html>
