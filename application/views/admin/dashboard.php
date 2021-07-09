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
        <!-- Content -->
        <div class="content">
            <!-- Animate -->
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?=$this->total;?></span></div>
                                            <div class="stat-heading">Visits</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-add-user"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?=$this->unique;?></span></div>
                                            <div class="stat-heading">Unique Visits</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-check"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">349</span></div>
                                            <div class="stat-heading">Registered Students</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-note2"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">6</span></div>
                                            <div class="stat-heading">Upcoming Events</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <a class="btn btn-info" href="#" id="addfaculty">Add Faculty</a>
                <a class="btn btn-danger" target="__blank" href="<?=base_url();?>index.php/Ctrl_admin/downloadBackup" style="float:right;" id="download">Download Backup</a>
                <br><small>(<span style="color:red;">This adds faculty so they can submit faculty publications and download data. (Mous, publications etc..)</span>)</small>
        <!-- /.content -->
        <div class="clearfix"></div>
        <?php $this->load->view("admin/footer"); ?>
    </div>
    <!-- /#right-panel -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
        jQuery("#title").html("Admin | Dashboard");
        var $ = jQuery.noConflict();
    </script>
    <script>
    $("#addfaculty").on("click", function(e){
        var name = prompt("Enter Faculty's name to save:");
        if(name == null){
            return;
        }
        var email = prompt("Enter Faculty's SAKEC email to save:");
        if(email == null){
            return;
        }
        var depts = ['Computer Engineering', 'Information Technology', 'Electronics Engineering', 'Electronics and Telecommunications', 'Human Science'];
        while(true){
            var dept = prompt("Enter Dept. of Faculty ('Computer Engineering', 'Information Technology', 'Electronics Engineering', 'Electronics and Telecommunications', 'Human Science'):");
            if($.inArray(dept, depts) !== -1){
                break;
            }
            if(dept == null){
                return;
            }
        }
        var conf = confirm("Are you sure you want to add Faculty?");
        if(conf==true){
            $.ajax({
                url: "<?=base_url();?>index.php/Ctrl_functions/addFaculty",
                data: {name: name, email:email, dept: dept },
                type: 'POST',
                success: function(result){
                    if(result == 1){
                        alert("Faculty added!");
                    }else{
                        alert("Faculty already exists in database!");
                    }
                }
            });
        }
    });
    </script>

</body>
</html>
