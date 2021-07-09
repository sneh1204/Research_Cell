<?php if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform"); ?>
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

        <a style="float:right;" class="btn btn-danger" href="<?=base_url();?>index.php/Ctrl_sform/logout">Sign out</a>
        <span style="float:right;color: black;padding-right:25px;padding-top:8px;">Hello, <b><span id="fname"><?=$_SESSION['name']?></span></b></span>
        <span style="float:right;color: black;padding-right:25px;padding-top:8px;">Joined: <span id="setjdate"><?php echo date("d,M Y",strtotime($joindate));?></span><a id="editjdate" style="color:blue;" href="#">&nbsp;&nbsp;Edit</a></span></b></span>
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add Tech Article</span>

    </div>
    <br>
        <div class="row">
        <div id="dialog-form" title="Edit Join Date?"></div>
        <br><br>
        <section id="top"></section>
        <table id="mform" style="display:inline-block;width:75%; max-width: 80%;" class="table table-borderless">
          <tr><td class="formlabel">Email: </td><td><input type="email" name="email" value="<?=$_SESSION['email']?>" id="email" class="form-control" placeholder="E-mail" readonly></td>
          <td class="formlabel">Dept: </td>
          <td><select style="max-width: 70%" name="dept" id="dept" class="form-control"><option value="0" <?php if($dept == "0") {?> selected="selected" <?php } ?> >Select Department</option><option <?php if($dept == "Computer Engineering") {?> selected="selected" <?php } ?> value="Computer Engineering">Computer Engineering</option><option <?php if($dept == "Information Technology") {?> selected="selected" <?php } ?> value="Information Technology">Information Technology</option><option <?php if($dept == "Electronics and Telecommunications") {?> selected="selected" <?php } ?> value="Electronics and Telecommunications">Electronics and Telecommunications</option><option value="Electronics Engineering" <?php if($dept == "Electronics Engineering") {?> selected="selected" <?php } ?> >Electronics Engineering</option><option <?php if($dept == "Human Science") {?> selected="selected" <?php } ?> value="Human Science">Human Science</option></select></td></tr>
          <tr><td class="formlabel">College Year: </td>
          <td><select name="cyear" id="cyear" class="form-control"><option value="First Year" <?php if($cyear == "First Year") {?> selected="selected" <?php } ?> >First Year</option><option <?php if($cyear == "Second Year") {?> selected="selected" <?php } ?> value="Second Year">Second Year</option><option <?php if($cyear == "Third Year") {?> selected="selected" <?php } ?> value="Third Year">Third Year</option><option <?php if($cyear == "Fourth Year") {?> selected="selected" <?php } ?> value="Fourth Year">Fourth Year</option></select></td></tr>
          <tr><td class="formlabel">Topic: </td><td><input type="text" name="topic" id="topic" class="form-control" placeholder="Article Topic" max-length="250"></td>
          <td class="formlabel">Name: </td><td><input type="text"name="name" id="name" class="form-control" placeholder="Authors" max-length="250"></td></tr>
          <tr><td class="formlabel">Role: </td><td><select name="role" id="role" class="form-control"><option value="Writer" selected="selected">Writer</option><option value="Editor">Editor</option><option value="Reviewer">Reviewer</option></select></td>
          <td class="formlabel">Publisher: </td><td><input type="text" name="publisher" id="publisher" class="form-control" placeholder="Publisher" max-length="200"></td></tr>
          <td class="formlabel">Date: </td><td><input class='form-control' type='date' id='date'></td></td></tr>
          <td class="formlabel">Link: </td><td><input type="text" name="link" id="link" class="form-control" placeholder="Link" max-length="500"></td></tr>
          
          <tr><td></td><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
        </table>
        <table frame="box" class="table table-borderless" style="max-width: 20%;background-color:#F8F8F8;color:black;float:left;margin-right:5%">
        <tr style="background-color: #429FFD; color:white; font-size: 20px;" class="typelink"><td>Add</td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentPublication/">Journal/Conference</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentBook/">Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentChapter/">Chapters in Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentCopyright/">Copyright</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentPatent/">Patent</a></td></tr>
        <tr class="typelink active"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentTechArticle/"><i class="fa fa-arrow-right" aria-hidden="true"></i> Tech Article</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentCerti/">Certification</a></td></tr>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Topic</th><th>Authors</th><th>Role</th><th>Publisher</th><th>Date</th><th>Link</th><th>Update</th></tr>
        <?php
        foreach($ftech as $sid => $data){
          $rlength = $sid+1;
          echo '<tr style="color:grey;" class="subrow"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub">'.$data->topic.'</td><td class="sub">'.$data->name.'</td><td class="sub">'.$data->role.'</td><td class="sub">'.$data->publisher.'</td><td class="sub">'.$data->date.'</td><td class="sub">'.$data->link.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
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
                    url: "<?=base_url();?>index.php/Ctrl_publications/editStudentJoinDate",
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
      $("#topic").val('');
      $("#name").val('');
      $("#role").val('Writer');
      $("#publisher").val('');
      $("#date").val('');
      $("#link").val('');
    }
    $('#editjdate').on("click", function(e){
      $('#dialog-form').empty();
      $("#dialog-form").html('<input data-email="'+email+'" class="form-control" type="date" id="jdate" style="width:200px;border:1px solid red"/>');
      dialog.dialog("open");
    });
    $("#submit").click(function(e){
      if($("#email").val() == "" || $("#dept option:selected").val() == "0" || $("#topic").val() == "" || $("#name").val() == "" || $("#publisher").val() == "" || $("#date").val() == "" || $("#link").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        var date = $("#date").val();
        var year = getAcademicYear(date.substr(5, 2), date.substr(0,4));
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addStudentTechArticle/",
          type: "POST",
          data: {email: $("#email").val(), topic: $("#topic").val(), name: $("#name").val(), role: $("#role").val(), publisher: $("#publisher").val(), date: date, year: year, link: $("#link").val(), dept: $('#dept option:selected').val(), fname: $('#fname').html(), scholar: $("#cyear").val()},
          success:function(result){
            if(result == '0'){
              alert("Error while inserting!");
              return;
            }else{
              $("#submitted").append('<tr style="color:grey;" class="subrow"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub">'+$("#topic").val()+'</td><td class="sub">'+$('#name').val()+'</td><td class="sub">'+$('#role').val()+'</td><td class="sub">'+$('#publisher').val()+'</td><td class="sub">'+$('#date').val()+'</td><td class="sub">'+$('#link').val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
              $(".sub").css("word-break", "break-all");
              $(".sub").css("width", "100px");
              reset();
            }
          }
        });        
        return;
      }
    });
    function getAcademicYear(month, year){
      var next = parseInt(year.substr(year.length - 2), 10);
      if(month > 0 && month <= 6){
        next = next - 1;
        var front = year.substr(0, 2);
        var newy = next + 1;
        return front + next + "-" + newy;
      }else if(month > 6 && month < 13){
        next = next + 1;
        return year + "-" +  next;
      }else{
        return 'NaN';
      }
    }
    </script>
     <script>
    $("body").on("click", ".editme", function(){
        var id = $(this).attr('id');
        var rawid = id.replace("edit", "");
        var row = $(this).closest("tr");
        var autoincr = $('#srno'+rawid).html();
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteStudentTechArticle",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              topic = row.find("td:nth-child(2)");
              $('#topic').val(topic.text());
              names = row.find("td:nth-child(3)");
              $('#name').val(names.text());
              role = row.find("td:nth-child(4)");
              $('#role').val(role.text());
              publisher = row.find("td:nth-child(5)");
              $('#publisher').val(publisher.text());
              dates = row.find("td:nth-child(6)");
              $('#date').val(dates.text());
              link = row.find("td:nth-child(7)");
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteStudentTechArticle",
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
  $("#pagetitle").html("Research Cell | Add Tech Article");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>