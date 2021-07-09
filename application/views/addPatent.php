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
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add Patent</span>

    </div>
    <br>
        <div class="row">
        <div id="dialog-form" title="Edit Join Date?"></div>
        <br><br>
        <section id="top"></section>
        <table id="mform" style="display:inline-block;width:75%; max-width: 80%;" class="table table-borderless">
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
          <tr><td class="formlabel">Patent ID: </td><td><input type="text" name="patentid" id="patentid" class="form-control" placeholder="Patent ID" max-length="200"></td>
          <td class="formlabel">Title: </td><td><input type="text" style="max-width: 70%" name="title" id="title" class="form-control" placeholder="Patent Title" max-length="200"></td></tr>
          <tr><td class="formlabel">Applicant: </td><td><input type="text" name="applicant" id="applicant" class="form-control" placeholder="Applicant Name" max-length="200"></td>
          <td class="formlabel">Inventor: </td><td><input style='max-width: 70%' type="text" name="inventor" id="inventor" class="form-control" placeholder="Inventor Name" max-length="200"></td></tr>
          <td class="formlabel">Link: </td><td><input type="text" name="link" id="link" class="form-control" placeholder="Link (Optional)" max-length="200"></td></tr>
          <tr><td class="formlabel">Status: </td><td><select name="status" id="status" class="form-control"><option value="0" selected="selected">Select Status</option><option value="Filed">Filed</option><option value="Published">Published</option><option value="Granted">Granted</option></select></td></tr>
          <tr id="dates"></tr>
          <tr><td></td><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
        </table>
        <table frame="box" class="table table-borderless" style="max-width: 20%;background-color:#F8F8F8;color:black;float:left;margin-right:5%">
        <tr style="background-color: #429FFD; color:white; font-size: 20px;" class="typelink"><td>Add</td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addPublication/">Journal/Conference</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addBook/">Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addChapter/">Chapters in Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addCopyright/">Copyright</a></td></tr>
        <tr class="typelink active"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addPatent/"><i class="fa fa-arrow-right" aria-hidden="true"></i> Patent</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addTechArticle/">Tech Article</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_tform/addCerti/">Certification</a></td></tr>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Patent ID</th><th>Title</th><th>Applicant</th><th>Inventor</th><th>Status</th><th>Date</th><th>Link</th><th>Update</th></tr>
        <?php
        foreach($fpatent as $sid => $data){
          $rlength = $sid+1;
          $datestr = 'Filed on - <br><b>' . $data->fdate . "</b>";
          if($data->pdate != ""){
            $datestr .= '<br>Published on - <br><b>' . $data->pdate. "</b>";
          }
          if($data->gdate != ""){
            $datestr .= '<br>Granted on - <br><b>' . $data->gdate. "</b>";
          }
          echo '<tr style="color:grey;" class="subrow"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub">'.$data->patentid.'</td><td class="sub">'.$data->title.'</td><td class="sub">'.$data->applicant.'</td><td class="sub">'.$data->inventor.'</td><td class="sub">'.$data->status.'</td><td class="sub">'.$datestr.'</td><td class="sub">'.$data->link.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
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
      $("#patentid").val('');
      $("#diary").val('');
      $("#title").val('');
      $("#class").val('');
      $("#applicant").val('');
      $("#inventor").val('');
      $("#link").val('');
    }
    $('#editjdate').on("click", function(e){
      $('#dialog-form').empty();
      $("#dialog-form").html('<input data-email="'+email+'" class="form-control" type="date" id="jdate" style="width:200px;border:1px solid red"/>');
      dialog.dialog("open");
    });
    $("#submit").click(function(e){
      if($("#email").val() == "" || $("#scholar").val() == "" || $("#status option:selected").val() == "0" || $("#dept option:selected").val() == "0" || $("#patentid").val() == "" || $("#title").val() == "" || $("#inventor").val() == "" || $("#applicant").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        var status = $('#status').val();
        if(status == 'Filed') {
          if($('#fdate').val() == ""){
            alert("Filed Date not selected");
            return;
          }
        }else if(status == 'Published'){
          if($('#fdate').val() == "" || $('#pdate').val() == ""){
            alert("Dates not selected");
            return;
          }
        }else if(status == 'Granted'){
          if($('#fdate').val() == "" || $('#pdate').val() == "" || $('#gdate').val() == ""){
            alert("Dates not selected");
            return;
          }
        }else{
          alert('Status not selected');
          return;
        }
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addPatent/",
          type: "POST",
          data: {email: $("#email").val(), patentid: $("#patentid").val(), title: $("#title").val(), applicant: $("#applicant").val(), inventor: $("#inventor").val(), dept: $("#dept option:selected").val(), link: $("#link").val(), status: $('#status option:selected').val(), fdate: $('#fdate').val(), pdate: $('#pdate').val(), gdate: $('#gdate').val(), fname: $('#fname').html(), scholar: $("#scholar").val()},
          success:function(result){
            if(result == '0'){
              alert("Error while inserting!");
              return;
            }else{
              var datestr = getDateStr($("#fdate").val(), $("#pdate").val(), $("#gdate").val());
              $("#submitted").append('<tr style="color:grey;" class="subrow"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub">'+$("#patentid").val()+'</td><td class="sub">'+$('#title').val()+'</td><td class="sub">'+$('#applicant').val()+'</td><td class="sub">'+$('#inventor').val()+'</td><td class="sub">'+$('#status option:selected').text()+'</td><td class="sub">'+datestr+'</td><td class="sub">'+$('#link').val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
              $(".sub").css("word-break", "break-all");
              $(".sub").css("width", "100px");
              reset();
            }
          }
        });        
        return;
      }
    });
    function getDateStr(fdate, pdate, gdate){
      var str = "";
      str += "Filed on - <br><b>" + fdate + "</b>";
      if(pdate != null) {
        str += "<br>Published on - <br><b>" + pdate + "</b>";
      }
      if(gdate != null) {
        str += "<br>Granted on - <br><b>" + gdate + "</b>";
      }
      return str;
    }
    </script>
    <script>
    $('#status').on('change', function() {
      var status = $(this).val();
      if(status == "Filed"){
        $("#dates").html("<td class='formlabel'>Filed Date: </td><td><input class='form-control' type='date' id='fdate'></td>");
      }else if(status == 'Published'){
        $("#dates").html("<td class='formlabel'>Filed Date: </td><td><input class='form-control' type='date' id='fdate'></td><td class='formlabel'>Published Date: </td><td><input class='form-control' style='max-width: 70%' type='date' id='pdate'>");
      }else if(status == 'Granted'){
        $("#dates").html("<td class='formlabel'>Filed Date: </td><td><input class='form-control' type='date' id='fdate'></td><td class='formlabel'>Published Date: </td><td><input class='form-control' style='max-width: 70%' type='date' id='pdate'><td class='formlabel'>Granted Date: </td><td><input class='form-control' type='date' id='gdate'></td>");
      }else{
        $("#dates").html("");
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deletePatent",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              patentid = row.find("td:nth-child(2)");
              $('#patentid').val(patentid.text());
              title = row.find("td:nth-child(3)");
              $('#title').val(title.text());
              applicant = row.find("td:nth-child(4)");
              $('#applicant').val(applicant.text());
              inventor = row.find("td:nth-child(5)");
              $('#inventor').val(inventor.text());
              link = row.find("td:nth-child(8)");
              $('#link').val(link.text());
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deletePatent",
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
  $("#pagetitle").html("Research Cell | Add Patent");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>