<?php if(!isset($_SESSION['access_token'])) redirect("Ctrl_events/loginCheck"); ?>
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

        <a style="float:right;" class="btn btn-danger" href="<?=base_url();?>index.php/Ctrl_events/logout">Sign out</a>
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add New Event</span>

    </div>
    <br>
        <div class="row">
        <br><br>
        <section id="top"></section>
        <table class="table table-borderless">
          <tr><td class="formlabel">Name: </td><td colspan="3"><input type="text" id="name" class="form-control" placeholder="Event Name" max-length="250"></td></tr>
          <tr><td class="formlabel">Date: </td><td><input type="date" id="date" class="form-control"></td></tr>
          <tr><td class="formlabel">Description: </td><td><textarea placeholder="Event description" id="description" class="form-control"></textarea></td></tr>
          <tr><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Name</th><th>Date</th><th>Description</th><th>Update</th></tr>
        <?php
        foreach($events as $pid => $data){
          $rlength = $pid+1;
          echo '<tr style="color:grey;" class="subrow"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub">'.$data->name.'</td><td class="sub">'.$data->date.'</td><td class="sub">'.$data->details.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
        }
        ?>
        </table>
    </div>
    </div>
    </div>
    <?php $this->load->view('scripts'); ?>
    <script>
    function reset(){
      $("#name").val('');
      $("#date").val('0');
      $("#description").val('');
    }
    $("#submit").on('click', function(e){
      if($("#name").val() == "" || $("#date").val() == "" || $("#description").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        var idate = $("#date").val();
        var date = new Date(idate);
        var year = getAcademicYear(date.getMonth()+1, idate.substr(0,4));
        var type = getEventType(idate);
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addEvent/",
          type: "POST",
          data: {name: $("#name").val(), date: idate, description: $("#description").val(), year: year, type: type},
          success:function(result){
            result = parseInt(result);
            if(Number.isInteger(result)){
              $("#submitted").append('<tr style="color:grey;" class="subrow"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub">'+$("#name").val()+'</td><td class="sub">'+$("#date").val()+'</td><td class="sub">'+$("#description").val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
              $(".sub").css("word-break", "break-all");
              $(".sub").css("width", "100px");
              reset();
            }else{
              alert("Error occured.");
            }
          }
        });        
        return;
      }
    });
    function getEventType(date){
      var sdate = new Date(date).setHours(0,0,0,0);
      var now = new Date().setHours(0,0,0,0);
      if(sdate < now){
        return 'completed';
      }else{
        return 'upcoming';
      }
    }
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteEvent",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              namee = row.find("td:nth-child(2)");
              $('#name').val(namee.text());
              date = row.find("td:nth-child(3)");
              $('#date').val(date.text());
              description = row.find("td:nth-child(4)");
              $('#description').val(description.text());
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteEvent",
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
  $("#pagetitle").html("Research Cell | Add Event");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>