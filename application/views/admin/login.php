<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<?php $this->load->view('admin/head');?>

<body class="login-background-color">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                </div>
                <div class="login-form">
                    <?php
                    if(isset($loggedout)){
                    ?>
                    <div class='alert alert-info'>
                    <strong>You are now logged out!</strong>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if(isset($wrongpass)){
                    ?>
                    <div class='alert alert-info'>
                    <strong>Error! Wrong Credentials!</strong>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if(isset($notloggedin)){
                    ?>
                    <div class='alert alert-info'>
                    <strong>Error! You need to log in to see that page!</strong>
                    </div>
                    <?php
                    }
                    ?>
                    <form method='post' action='<?=base_url();?>index.php/Ctrl_functions/checkAdminLogin'>
                        <h2 style="color: #212A45;"> Admin Login </h2><br>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="username" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Password">
                            </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
        jQuery("#title").html("Admin | Login");
    </script>

</body>
</html>
