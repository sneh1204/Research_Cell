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
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add Chapter</span>

    </div>
    <br>
        <div class="row">
        <div id="dialog-form" title="Edit Join Date?"></div>
        <br><br>
        <section id="top"></section>
        <table style="display:inline-block;width:75%; max-width: 80%;" class="table table-borderless">
          <tr><td class="formlabel">Email: </td><td><input type="email" name="email" value="<?=$_SESSION['email']?>" id="email" class="form-control" placeholder="E-mail" readonly></td>
          <td class="formlabel">Dept: </td>
          <td><select style="max-width: 70%" name="dept" id="dept" class="form-control"><option value="0" <?php if($dept == "0") {?> selected="selected" <?php } ?> >Select Department</option><option <?php if($dept == "Computer Engineering") {?> selected="selected" <?php } ?> value="Computer Engineering">Computer Engineering</option><option <?php if($dept == "Information Technology") {?> selected="selected" <?php } ?> value="Information Technology">Information Technology</option><option <?php if($dept == "Electronics and Telecommunications") {?> selected="selected" <?php } ?> value="Electronics and Telecommunications">Electronics and Telecommunications</option><option value="Electronics Engineering" <?php if($dept == "Electronics Engineering") {?> selected="selected" <?php } ?> >Electronics Engineering</option><option <?php if($dept == "Human Science") {?> selected="selected" <?php } ?> value="Human Science">Human Science</option></select></td></tr>
          <tr><td class="formlabel">College Year: </td>
          <td><select name="cyear" id="cyear" class="form-control"><option value="First Year" <?php if($cyear == "First Year") {?> selected="selected" <?php } ?> >First Year</option><option <?php if($cyear == "Second Year") {?> selected="selected" <?php } ?> value="Second Year">Second Year</option><option <?php if($cyear == "Third Year") {?> selected="selected" <?php } ?> value="Third Year">Third Year</option><option <?php if($cyear == "Fourth Year") {?> selected="selected" <?php } ?> value="Fourth Year">Fourth Year</option></select></td></tr>
          <tr><td class="formlabel">Title: </td><td><input type="text" name="title" id="title" class="form-control title" placeholder="Book Title" max-length="200"></td>
          <tr><td class="formlabel">Chapter Name: </td><td><input type="text" name="chap" id="chap" class="form-control" placeholder="Chapter Name" max-length="200"></td>
          <tr><td class="formlabel">Publisher: </td><td><input type="text" name="publisher" id="publisher" class="form-control" placeholder="Book Publisher's Name" max-length="200"></td></tr>
          <tr><td class="formlabel">Front Page: </td><td><form id="imgform" method="POST" action="<?=base_url()?>index.php/Ctrl_publications/addStudentChapterFrontPage"><input type="file" name="front" id="front" class="form-control"></form></td></tr>
          <tr><td class="formlabel">Year: </td><td><select name="year" id="year" class="form-control"></select></td>
          <td class="formlabel">Link: </td><td><input type="text" style="max-width: 70%" name="link" id="link" class="form-control" placeholder="Link of the Book" max-length="200"></td></tr>
          <tr><td></td><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
        </table>
        <table frame="box" class="table table-borderless" style="max-width: 20%;background-color:#F8F8F8;color:black;float:left;margin-right:5%">
        <tr style="background-color: #429FFD; color:white; font-size: 20px;" class="typelink"><td>Add</td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentPublication/">Journal/Conference</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentBook/">Books</a></td></tr>
        <tr class="typelink active"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentChapter/"><i class="fa fa-arrow-right" aria-hidden="true"></i> Chapters in Books</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentCopyright/">Copyright</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentPatent/">Patent</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentTechArticle/">Tech Article</a></td></tr>
        <tr class="typelink"><td><a href="<?=base_url()?>index.php/Ctrl_sform/addStudentCerti/">Certification</a></td></tr>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Front Page</th><th>Title</th><th>Chapter</th><th>Publisher</th><th>Year</th><th>Link</th><th>Update</th></tr>
        <?php
        foreach($fchaps as $sid => $data){
          $rlength = $sid+1;
          $src = base_url()."illustrations/booksfront/".$data->frontpage;
          echo '<tr style="color:grey;" class="subrow" id="tr'.$data->id.'"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub"><img src="'.$src.'" style="height:100px;width:80px;"></img></td><td class="sub">'.$data->title.'</td><td class="sub">'.$data->chapter.'</td><td class="sub">'.$data->publisher.'</td><td class="sub">'.$data->year.'</td><td class="sub">'.$data->link.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
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
    var dt = new Date();
    var global = 1900;
    var year = dt.getYear() + global;
    var i;
    var next;
    var nextstr;
    for(i = 1980; i <= year; i++){
      next = i + 1;
      next = next.toString();
      nextstr = next.substring(next.length - 2);
      if(i == year) $('#year').append($("<option></option>").attr('value', i + '-' + nextstr).attr('selected', 'selected').text(i + '-' + nextstr));
      else  $('#year').append($("<option></option>").attr('value', i + '-' + nextstr).text(i + '-' + nextstr));
    }
    function reset(){
      $("#title").val('');
      $("#chap").val('');
      $("#publisher").val('');
      $("#front").val('');
      $("#link").val('');
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
                alert('Error uploading Book image');
              }else{
                var output = $.parseJSON(result);
                var str = "<?=base_url()?>illustrations/booksfront/" + output[1];
                var row = $('#tr'+output[0]);
                row.find("td:nth-child(2)").append("<img style='height: 100px;width:80px;' src="+str+"></img>");
              }
            },
        });
    }));

    $("#submit").click(function(e){
        var ext = $('#front').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            alert('Invalid Book Front page. Only images are allowed!');
            return;
        }
      if($("#title").val() == "" || $("#dept option:selected").val() == "0" || $("#chap").val() == "" || $("#publisher").val() == "" || $("#front").val() == "" || $("#link").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addStudentChapter/",
          type: "POST",
          data: {email: $("#email").val(), title: $("#title").val(), chapter: $("#chap").val(), link: $("#link").val(), dept: $('#dept option:selected').val(), publisher: $('#publisher').val(), year: $('#year option:selected').val(), fname: $('#fname').html(), cyear: $("#cyear").val()},
          success:function(result){
            if(result == '0'){
              alert("Error while inserting!");
              return;
            }else{
              $("#submitted").append('<tr style="color:grey;" class="subrow" id="tr'+result+'"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub"></td><td class="sub">'+$("#title").val()+'</td><td class="sub">'+$('#chap').val()+'</td><td class="sub">'+$('#publisher').val()+'</td><td class="sub">'+$('#year option:selected').val()+'</td><td class="sub">'+$('#link').val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteStudentChapter",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              title = row.find("td:nth-child(3)");
              $('#title').val(title.text());
              chapter = row.find("td:nth-child(4)");
              $('#chap').val(chapter.text());
              publisher = row.find("td:nth-child(5)");
              $('#publisher').val(publisher.text());
              year = row.find("td:nth-child(6)");
              $('#year').val(year.text());
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteStudentChapter",
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
  $("#pagetitle").html("Research Cell | Add Chapter");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>