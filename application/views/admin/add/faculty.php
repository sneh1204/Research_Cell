<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
?>
<!doctype html>
<html>
<?php $this->load->view('admin/head'); ?>
<body>
<style>
.ui-button{
    width: 70px;
    height: 50px;
    color: orange;
}
</style>
<?php $this->load->view('admin/sidebar')?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
      <?php $this->load->view('admin/header');?>
      <?php $this->load->view('admin/breadcrumb');?>
      <div class="content">
      <div class="card-body card-block">
      <?php if(isset($added)){ ?>
        <div class='alert alert-info'>
        <strong>Success! Faculty Publication added successfully!</strong>
        </div>
        <?php
        }
        ?>
        <input type="text" id="text-input" maxlength="200" placeholder="Faculty Name" class="form-control" required>
        <br>
        <button type="button" id="clickme" name="fetch" style="color:green;">Fetch Results</button>
        <div id="crawl"></div>
        <div id="dialog-form" title="Add Publication?">Crawling<span id='wait'>.</span></div>
      </div>
      </div>
      <div class="clearfix"></div>
    <br>
    <?php $this->load->view("admin/footer"); ?>
</div>
    <?php $this->load->view('admin/sidebar')?>

    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>

    <script type='text/javascript'>
    $(document).on('click', '#clickme', function() {
        var value = $("#text-input").val();
        var start_time = new Date().getTime();
        if(value){
            $.ajax({
                url: "<?=base_url();?>index.php/Ctrl_functions/crawlGoogle",
                data: { value: value },
                type: 'POST',
                success: function(result) {
                    var output = JSON.parse(result);
                    if(output){
                        $('#crawl').empty();
                        var request_time = (new Date().getTime() - start_time)/1000;
                        $('#crawl').html('<br><span>Returned <b>'+output.length+'</b> results in <b>'+request_time+'</b> seconds!</span><br><br>');
                        if(output.length > 0){
                            $('#crawl').append('<u>Click an Image below for more info</u><br><br><table style="width:100%">');
                            for (index = 0; index < output.length; index++) {
                                var link = output[index];
                                var newi = index + 1;
                                var sub = link.split("user=");
                                if(sub) sub = sub[1];
                                $('#crawl').append('<tr class="clickable-row" data-href="'+link+'" style="width:100%; height:100px;"><td>'+newi+'. <a href="#"><img style="padding-left: 10px; height: 90px; width: 90px;" src="https://scholar.google.co.in/citations?view_op=view_photo&user='+sub+'&citpid=2"/></a></td></tr>');
                            }
                            $('#crawl').append('</table>');
                        }
                    }else{
                        alert("No citations found!");
                    }
                }
            });
        }
    });
    </script>

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
        "Add": {
            text : "Add Faculty",
            id : "add",
            click : function(){
                return;
            }
        }
      },
      close: function() {
        $("#dialog-form").html("Crawling<span id='wait'>.</span>");
        if(ajax){
            ajax.abort();
        }
      }
    });
    jQuery("#add").on("click",function(){
        sid = $("#scholarid").html();
        name = $("#scholarname").html();
        if (typeof sid === 'undefined') {
            alert("Please wait while the crawler fetches the information.");
            return;
        }
        var email = prompt("Enter SAKEC email to save:");
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
        var conf = confirm("Are you sure you want to add Faculty Publications?");
        if(conf==true){
            $.ajax({
                url: "<?=base_url();?>index.php/Ctrl_functions/addFacultyPublication",
                data: { sid: sid, name: name, email:email, dept: dept },
                type: 'POST',
                success: function(result){
                    if(result == 1){
                        window.location.href = "<?=base_url();?>index.php/Ctrl_add/faculty/added";
                    }else{
                        alert("Faculty Publications already exists in database!");
                    }
                }
            });
        }
    });

    $(document).on('click', '.clickable-row', function() {
        var link = $(this).data("href");
        ajax = $.ajax({
            url: "<?=base_url();?>index.php/Ctrl_functions/crawlScholar/"+link,
            data: { link: link },
            type: 'POST',
            success: function(result) {
                var output = JSON.parse(result);
                if(output){
                    $('#dialog-form').empty();
                    var sub = link.split("user=");
                    var id = "";
                    if(sub){
                        sub = sub[1];
                        id = sub.replace("&hl=en", "");
                    }
                    $('#dialog-form').html('<br><img style="width: 200px; height: 200px;" src="https://scholar.google.co.in/citations?view_op=view_photo&user='+sub+'&citpid=2"/></span><br><br><a style="color:green;" href="https://scholar.google.com/citations?user='+sub+'" target="__blank">View Profile</a><br><b>Name:</b> <span id="scholarname">'+output[0]+'</span><br>'+output[1]+'<br><b>Scholar Id:</b> <span id="scholarid">'+id+'</span><br><br>');
                }else{
                    alert("No Results!");
                }
            }
        });
        dialog.dialog("open");
    });
    </script>

    <script>
        var dots = window.setInterval( function() {
        var wait = document.getElementById("wait");
        if(wait){
            if (wait.innerHTML.length > 3) 
                wait.innerHTML = "";
            else 
                wait.innerHTML += ".";
        }
        }, 250);
    </script>

    <script>
      $("#title").html("Admin | Add Faculty Publication");
      $(document).ready(function() {
        $('.breadcrumbs .page-title h1').html('Add Citation');
        $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
        $('.breadcrumbs .text-right a').eq(1).html('Event').attr("href", "<?=base_url();?>index.php/Ctrl_list/faculty");
        $('.breadcrumbs .text-right li').eq(2).html('Add');
      });
    </script>

</body>
</html>