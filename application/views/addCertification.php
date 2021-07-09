<?php if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform"); ?>
<html>
<?php $this->load->view('head'); ?>
<body>
<style>
.form-control{  
  display: inline;
}
.formlabel{
  color: black;
  font-weight: bold;
}
.typelink:hover {
  color: #429FFD;
  font-size: 20px;
}
.active{
  color: #429FFD;
  font-size: 20px;
}
.sub{
  word-break: break-all;
  width: 100px;
}
a {
  color: inherit; 
  text-decoration: inherit; 
}
</style>
<div class="colorlib-loader"></div>
<div id="page">
<?php $this->load->view('header'); ?>
<div class="container">
    <div class="row">
    <br>
    <br>
    <br>
    <div class="col-md-12 animate-box">

        <a style="float:right;" class="btn btn-danger" href="<?=base_url();?>index.php/Ctrl_tform/logout">Sign out</a>
        <span style="float:right;color: black;padding-right:25px;padding-top:8px;">Hello, <b><span id="fname"><?=$_SESSION['name']?></span></b></span>
        <span style="float:right;color: black;padding-right:25px;padding-top:8px;">Joined: <span id="setjdate"><?php echo date("d,M Y",strtotime($joindate));?></span><a id="editjdate" style="color:blue;" href="#">&nbsp;&nbsp;Edit</a></span></b></span>
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add Certification</span>

    </div>
    <br>
        <div class="row">
        <div id="dialog-form" title="Edit Join Date?"></div>
        <br><br>
        <section id="top"></section>
        <table style="display:inline-block;width:75%; max-width: 80%;" class="table table-borderless">
          <tr><td class="formlabel">Email: </td><td><input type="email" name="email" value="<?=$_SESSION['email']?>" id="email" class="form-control" placeholder="E-mail" readonly></td>
          <td class="formlabel">Dept: </td>
          <td>
          <?php if(!$isAdmin){ ?>
            <select style="max-width: 70%" name="dept" id="dept" class="form-control"><option value="0" <?php if($fdept == "0") {?> selected="selected" <?php } ?> >Select Department</option><option <?php if($fdept == "Computer Engineering") {?> selected="selected" <?php } ?> value="Computer Engineering">Computer Engineering</option><option <?php if($fdept == "Information Technology") {?> selected="selected" <?php } ?> value="Information Technology">Information Technology</option><option <?php if($fdept == "Electronics and Telecommunications") {?> selected="selected" <?php } ?> value="Electronics and Telecommunications">Electronics and Telecommunications</option><option value="Electronics Engineering" <?php if($fdept == "Electronics Engineering") {?> selected="selected" <?php } ?> >Electronics Engineering</option><option <?php if($fdept == "Human Science") {?> selected="selected" <?php } ?> value="Human Science">Human Science</option></select>
          <?php }else{ ?>
            <input type="text" name="dept" value="<?=$isAdmin?>" id="dept" class="form-control" placeholder="Department" readonly>
          <?php } ?>
          </td></tr>
          <tr><td class="formlabel">Scholar URL: </td><td colspan="3"><input type="text" name="scholar" id="scholar" class="form-control" placeholder="Google Scholar Profile Link" max-length="250" value="<?=$fscholar?>"></td></tr>
          <tr><td class="formlabel">Author: </td><td><input type="text" name="name" id="name" class="form-control title" placeholder="Author Name" max-length="200"></td>
          <tr><td class="formlabel">Certi Name: </td><td><input type="text" name="cname" id="cname" class="form-control title" placeholder="Certi Name" max-length="200"></td>
          <tr><td class="formlabel">Details: </td><td><input type="text" name="detail" id="detail" class="form-control" placeholder="Certi Details" max-length="200"></td></tr>
          <tr><td class="formlabel">Certi Image: </td><td><form id="imgform" method="POST" action="<?=base_url()?>index.php/Ctrl_publications/addCertiImage"><input type="file" name="cimage" id="cimage" class="form-control"></form></td></tr>
          <tr><td class="formlabel">Date: </td><td><input class='form-control' type='date' id='date'></td></tr>
          <tr><td></td><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
        </table>
        <table frame="box" class="table table-borderless" style="max-width: 20%;background-color:#F8F8F8;color:black;float:left;margin-right:5%">
        <tr style="background-color: #429FFD; color:white; font-size: 20px;" class="typelink"><td>Add</td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addPublication/">Journal/Conference</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addBook/">Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addChapter/">Chapters in Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addCopyright/">Copyright</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addPatent/">Patent</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addTechArticle/">Tech Article</a></td></tr>
        <tr class="typelink active"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addCerti/"><i class="fa fa-arrow-right" aria-hidden="true"></i> Certification</a></td></tr>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Certi Image</th><th>Certi Name</th><th>Author</th><th>Details</th><th>Date</th><th>Update</th></tr>
        <?php
        foreach($fcerti as $sid => $data){
          $rlength = $sid+1;
          $src = base_url()."illustrations/certi/".$data->cimage;
          echo '<tr style="color:grey;" class="subrow" id="tr'.$data->id.'"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub"><img src="'.$src.'" style="height:100px;width:80px;"></img></td><td class="sub">'.$data->certiname.'</td><td class="sub">'.$data->name.'</td><td class="sub">'.$data->details.'</td><td class="sub">'.$data->date.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
        }
        ?>
        </table>
    </div>
    </div>
    </div>
    <?php $this->load->view('scripts'); ?>
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
                editJDate();
              }
          }
        },
      });
      function editJDate(){
        var jdate = $("#jdate").val();
        if(jdate == "") {
            alert("Join date not set.");
            return;
        }else{
            var conf = confirm("Are you sure you want to submit?");
            if(conf==true){
                $.ajax({
                    url: "<?=base_url();?>index.php/Ctrl_publications/editFacultyJoinDate",
                    data: {jdate: jdate},
                    type: 'POST',
                    success: function(result){
                      alert("Join date updated successfully.");
                      $('#dialog-form').empty();
                      dialog.dialog("close");
                      $("#setjdate").html(result);
                    }
                });
            }
        }
    }
    function reset(){
      $("#name").val('');
      $("#cname").val('');
      $("#detail").val('');
      $("#cimage").val('');
      $("#date").val('');
    }
    $('#editjdate').on("click", function(e){
      $('#dialog-form').empty();
      $("#dialog-form").html('<input data-email="'+email+'" class="form-control" type="date" id="jdate" style="width:200px;border:1px solid red"/>');
      dialog.dialog("open");
    });
    $('#imgform').on('submit',(function(e) {
        e.preventDefault();
        var row = $('#submitted tr:last');
        var autoincr = row.find("td:nth-child(1)").text();
        var formData = new FormData(this);
        formData.append('autoincr', autoincr);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(result){
              if(result == 0){
                alert('Error uploading Certi image');
              }else{
                var output = $.parseJSON(result);
                var str = "<?=base_url()?>illustrations/certi/" + output[1];
                var row = $('#tr'+output[0]);
                row.find("td:nth-child(2)").append("<img style='height: 100px;width:80px;' src="+str+"></img>");
              }
            },
        });
    }));

    $("#submit").click(function(e){
        var ext = $('#cimage').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            alert('Invalid Certi Image. Only images are allowed!');
            return;
        }
      if($("#name").val() == "" || $("#scholar").val() == "" || $("#dept option:selected").val() == "0" || $("#cname").val() == "" || $("#detail").val() == "" || $("#cimage").val() == "" || $("#date").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addCerti/",
          type: "POST",
          data: {email: $("#email").val(), name: $("#name").val(), cname: $("#cname").val(), date: $("#date").val(), dept: $('#dept option:selected').val(), detail: $('#detail').val(), fname: $('#fname').html(), scholar: $("#scholar").val()},
          success:function(result){
            if(result == '0'){
              alert("Error while inserting!");
              return;
            }else{
              $("#submitted").append('<tr style="color:grey;" class="subrow" id="tr'+result+'"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub"></td><td class="sub">'+$("#cname").val()+'</td><td class="sub">'+$('#name').val()+'</td><td class="sub">'+$('#detail').val()+'</td><td class="sub">'+$('#date').val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
              $(".sub").css("word-break", "break-all");
              $(".sub").css("width", "100px");
              $("#imgform").submit();
              reset();
            }
          }
        });        
        return;
      }
    });
    </script>
    <script>
    $("body").on("click", ".editme", function(){
        var id = $(this).attr('id');
        var rawid = id.replace("edit", "");
        var row = $(this).closest("tr");
        var autoincr = $('#srno'+rawid).html();
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteCerti",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              cname = row.find("td:nth-child(3)");
              $('#cname').val(cname.text());
              namee = row.find("td:nth-child(4)");
              $('#name').val(namee.text());
              detail = row.find("td:nth-child(5)");
              $('#detail').val(detail.text());
              date = row.find("td:nth-child(6)");
              $('#date').val(date.text());
              row.remove();
              window.location.href = "#top";
            }
          }
        });
    });
    </script>
    <script>
    $("body").on("click", ".deleteme", function(){
        var id = $(this).attr('id');
        var rawid = id.replace("delete", "");
        var row = $(this).closest("tr");
        var autoincr = $('#srno'+rawid).html();
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteCerti",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while deleting!");
              return;
            }else{
              row.remove();
            }
          }
        });
    });
    </script>
<?php $this->load->view('footer'); ?>
</div>
<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>
  
  <script>
  $("#pagetitle").html("Research Cell | Add Certification");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>