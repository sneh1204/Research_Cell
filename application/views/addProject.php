<?php if(!isset($_SESSION['access_token'])) redirect("Ctrl_projects/loginCheck"); ?>
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
    <div class='alert alert-danger'>
    <strong>If a project is completed, please update it from the backend to add banners and more info.</strong>
    </div>
    <div class="col-md-12 animate-box">

        <a style="float:right;" class="btn btn-danger" href="<?=base_url();?>index.php/Ctrl_projects/logout">Sign out</a>
        <span style="font-weight: bold;font-size: 20px;color:black;padding-top:10px;">Add New Project</span>

    </div>
    <br>
        <div class="row">
        <br><br>
        <section id="top"></section>
        <table style="display:inline-block;" class="table table-borderless">
          <tr><td class="formlabel">Title: </td><td colspan="3"><input type="text" id="title" class="form-control" placeholder="Project Title" max-length="250"></td></tr>
          <tr><td class="formlabel">Collab: </td><td><select id="mous" class="form-control">
                <option selected="selected" value="0">Select MoUs</option>
                <?php
                foreach ($mous as $value) {
                  echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
                ?>
                <option value="other">Other</option>
          </select>
          <input style="display: none;" type="text" id="other" class="form-control" placeholder="Name of the Collab"/>
          </td>
          </tr>
          <tbody id="parti" style="border-top: none;">
          <tr>
          <td class="formlabel">Participants: </td>
            <td><input type="text" id="p-1" class="form-control partiname" placeholder="Participant Name"/></td>
            <td><input type="text" id="pemail-1" class="form-control partiemail" placeholder="Email"/></td>
            <td>
            <select id="pbranch-1" class="form-control" required>
                <option selected="selected" value="IT">IT</option>
                <option value="COMPS">COMPS</option>
                <option value="EXTC">EXTC</option>
                <option value="ETRX">ETRX</option>
                <option value="Human Science">Human Science</option>
              </select>
              </td>
              <td>
              <select id="prole-1" class="form-control select-role" required>
                  <option selected="selected" value="Project Coordinator">Project Coordinator</option>
                  <option value="Student">Student</option>
                </select>
              </td>
              <td>
              <select id="pdesc-1" class="form-control" required>
                  <option selected="selected" value="Associate Professor">Associate Professor</option>
                  <option value="Assistant Professor">Assistant Professor</option>
                </select>
              </td>
              <td><small><a href="#" class="add_parti_button" style="color:blue;">+ Add another participant</a></small></td>
          </tr>
          </tbody>
          <tbody style="border-top: none;">
          <tr><td class="formlabel">Start Date: </td><td><input type="date" id="idate" class="form-control"></td></tr>
          <tr><td class="formlabel">Status: </td><td><select id="status" class="form-control"><option value="On-Going" selected="selected">On Going</option><option value="Completed">Completed</option></select></td></tr>
          <tr id="dates"></tr>
          <tr><td class="formlabel">Achievements: </td><td colspan="3"><input type="text" id="achievements" class="form-control" placeholder="Project Achievements" max-length="500"></td></tr>
          <tr><td class="formlabel">Details: </td><td><form id="fdetails" method="POST" action="<?=base_url()?>index.php/Ctrl_publications/addDetails"><input type="file" name="details" id="details" class="form-control"></form></td></tr>
          <tr><td></td><td><a href="#" id="submit" class="btn btn-primary">Submit</a></td></tr>
          </tbody>
        </table>
        </div>
        <div class="row">
        <h4 style="font-family: 'Open Sans', Arial, sans-serif;font-size: 20px;padding-left:30px;"><b>Submitted</b></h4>
        <table class="table table-borderless" id="submitted" style="table-layout: fixed">
        <tr style="color:black;"><th>ID</th><th>Title</th><th>Collab</th><th>Year</th><th>Participants</th><th>Status</th><th>Update</th></tr>
        <?php
        function getMousNameById($id, $mous){
          if(!is_numeric($id))  return $id;
          $id = (int) $id;
          foreach($mous as $value){
            if($value['id'] == $id){
              return $value['name'];
            }
          }
          return '';
        }
        function getParticipantString($id, $prodetails){
          $str = "";
          foreach($prodetails as $value){
            if($value->id == $id){
              $str .= $value->pid . ". " . $value->name . " - " . $value->role . "\n";
            }
          }
          return $str;
        }
        foreach($projects as $pid => $data){
          $rlength = $pid+1;
          echo '<tr style="color:grey;" class="subrow"><td class="sub" id="srno'.$rlength.'">'.$data->id.'</td><td class="sub">'.$data->title.'</td><td class="sub">'.getMousNameById($data->mous, $mous).'</td><td class="sub">'.$data->year.'</td><td class="sub">'.getParticipantString($data->id, $pro_details).'</td><td class="sub">'.$data->status.'</td><td class="sub"><a href="#" class="editme" id="edit'.$rlength.'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'.$rlength.'" style="color:red;">Delete</a></td></tr>';
        }
        ?>
        </table>
    </div>
    </div>
    </div>
    <?php $this->load->view('scripts'); ?>
    <script>
    function reset(){
      $("#title").val('');
      $("#mous").val('0');
      $("#idate").val('');
      $("#details").val('');
      $("#achievements").val('');
      $("#p-1").val('');
      $("#pemail-1").val('');
      partinos = $("#parti tr").length;
      var i;
      for(i=2;i<=partinos;i++){
        $(".removeme"+i).remove();
      }
    }
    $('#mous').change(function() {
      if($('#mous').val() == 'other'){
       $("#other").css({"display" : "inline"});
      }else{
        $("#other").css({"display" : "none"});
      }
    });
    $('#status').change(function() {
      if($('#status option:selected').text().charAt(0) == 'C'){
        $("#dates").html("<td class='formlabel'>End Date: </td><td><input class='form-control' type='date' id='edate'></td>");
      }else{
        $("#dates").html("");
      }
    });
    jQuery(document).ready(function() {
    var wrapper2   		= jQuery("#parti"); 
    var add_button2      = jQuery(".add_parti_button"); 
    var y = 1;
    jQuery(add_button2).click(function(e){ 
        e.preventDefault();
        y = $("#parti tr").length + 1;
        var large='<tr class="removeme'+y+'"><td></td><td><input type="text" id="p-'+y+'" class="form-control partiname" placeholder="Participant Name"/></td><td><input type="text" id="pemail-'+y+'" class="form-control partiemail" placeholder="Email"/></td><td><select id="pbranch-'+y+'" class="form-control" required><option selected="selected" value="IT">IT</option><option value="COMPS">COMPS</option><option value="EXTC">EXTC</option><option value="ETRX">ETRX</option><option value="Human Science">Human Science</option></select></td><td><select id="prole-'+y+'" class="form-control select-role" required><option selected="selected" value="Project Coordinator">Project Coordinator</option><option value="Student">Student</option></select></td><td><select id="pdesc-'+y+'" class="form-control" required><option selected="selected" value="Associate Professor">Associate Professor</option><option value="Assistant Professor">Assistant Professor</option></select></td><td><small><a href="#" id="remove'+y+'" class="remove_parti_field" style="color:red;">- Remove participant</a></small></td></tr>';
        jQuery(wrapper2).append(large);
    });
    jQuery(wrapper2).on("click",".remove_parti_field", function(e){
      e.preventDefault();
      var id = this.id;
      var strid = id.slice(6);
      if(y==strid){
        jQuery('.removeme'+y).remove(); y--;
      }else{
        alert("Remove the succeeding participants first!");
      }
    });
    $('#parti').on("change", ".select-role", function(){
        var id = this.id;
        var strid = id.slice(6);
        var role = $(this).val();
        var wrap = $("#pdesc-" + strid);
        if(role == "Project Coordinator"){
          $(wrap).html('<option value="Associate Professor">Associate Professor</option><option value="Assistant Professor">Assistant Professor</option>');
        }
        if(role == "Student"){
          $(wrap).html('<option value="FE">FE</option><option value="SE">SE</option><option value="TE">TE</option><option value="BE">BE</option>');
        }
    });
    });
    $('#fdetails').on('submit',(function(e) {
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
        });
    }));
    $("#submit").on('click', function(e){
      if($("#title").val() == "" || $("#mous").val() == "0" || $("#idate").val() == ""){
        alert("Please fill all the values!");
        return;
      }else{
        var flag = false;
        $(".partiname").each(function(){
          if($(this).val() == ""){
            flag = true;
          }
        });
        $(".partiemail").each(function(){
          if($(this).val() == ""){
            flag = true;
          }
        });
        if(flag){
          alert("Please fill all the Participant's values!");
          return;
        }
        var formdata = {};
        formdata.edate = "";
        if($("#status").val() == 'Completed'){
          if($("#edate").val() == ''){
            alert("Please fill the End date!");
            return;
          }else{
            formdata.edate = $("#edate").val();
          }
        }
        partinos = $("#parti tr").length;
        var idate = $("#idate").val();
        var date = new Date(idate);
        var year = getAcademicYear(date.getMonth()+1, idate.substr(0,4));
        formdata.title = $("#title").val();
        formdata.achievements = $("#achievements").val();
        if($("#mous").val() == 'other'){
          formdata.mous = $("#other").val();
        }else{
          formdata.mous = $("#mous").val();
        }
        formdata.idate = idate;
        formdata.year = year;
        formdata.status = $("#status").val();
        formdata.partis = partinos;
        var i;
        for(i = 1; i <= partinos; i++){
          formdata["p-"+i] = $("#p-"+i).val();
          formdata["p-email"+i] = $("#pemail-"+i).val();
          formdata["p-branch"+i] = $("#pbranch-"+i).val();
          formdata["p-role"+i] = $("#prole-"+i).val();
          formdata["p-desc"+i] = $("#pdesc-"+i).val();
        }
        $.ajax({
          url: "<?=base_url();?>index.php/Ctrl_publications/addProject/",
          type: "POST",
          data: JSON.stringify(formdata),
          dataType: "json",
          success:function(result){
            if(Number.isInteger(result)){
              if($("#mous").val() == 'other'){
                mousname = $("#other").val();
              }else{
                mousname = $("#mous").val();
              }
              $("#submitted").append('<tr style="color:grey;" class="subrow"><td class="sub" id="srno'+result+'">'+result+'</td><td class="sub">'+$("#title").val()+'</td><td class="sub">'+mousname+'</td><td class="sub">'+year+'</td><td class="sub">'+getParticipantString()+'</td><td class="sub">'+$('#status').val()+'</td><td class="sub"><a href="#" class="editme" id="edit'+result+'" style="color:green;">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="deleteme" id="delete'+result+'" style="color:red;">Delete</a></td></tr>');
              $(".sub").css("word-break", "break-all");
              $(".sub").css("width", "100px");
              if($("#details").val() != ""){
                $("#fdetails").submit();
              }
              reset();
            }else{
              alert("Error occured.");
            }
          }
        });        
        return;
      }
    });
    function getParticipantString(){
      partinos = $("#parti tr").length;
      var str = "";
      for(i = 1; i <= partinos; i++){
        str = str + i + ". " + $("#p-"+i).val() + " - " + $("#prole-"+i).val() + "\n";
      }
      return str;
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
          url: "<?=base_url();?>index.php/Ctrl_publications/editProject",
          type: "POST",
          data: {autoincr: autoincr},
          success:function(result){
            if(result == '0'){
              alert("Error while editing!");
              return;
            }else{
              output = $.parseJSON(result);
              details = output[0];
              partis = output['partis'];
              $("#title").val(details['title']);
              if(parseInt(details['mous']) == 'NaN'){
                $("#mous").val('other').trigger('change');
                $("#other").val(details['mous']);
              }else{
                $("#mous").val(details['mous']);
              }
              $("#idate").val(details['idate']);
              $("#status").val(details['status'].replace("_", " ")).trigger('change');
              $("#edate").val(details['edate']);
              $("#achievements").val(details['achievements']);
              $("#p-1").val(partis[0].name);
              $("#pemail-1").val(partis[0].email);
              $("#pbranch-1").val(partis[0].branch.replace("_", " "));
              $("#prole-1").val(partis[0].role.replace("_", " ")).trigger('change');
              $("#pdesc-1").val(partis[0].description.replace("_", " "));
              particount = partis.length;
              if(particount > 1){
                for (let i = 1; i < particount; i++) {
                  var y = i + 1;
                  var large='<tr class="removeme'+y+'"><td></td><td><input type="text" id="p-'+y+'" class="form-control partiname" placeholder="Participant Name"/></td><td><input type="text" id="pemail-'+y+'" class="form-control partiemail" placeholder="Email"/></td><td><select id="pbranch-'+y+'" class="form-control" required><option selected="selected" value="IT">IT</option><option value="COMPS">COMPS</option><option value="EXTC">EXTC</option><option value="ETRX">ETRX</option><option value="Human Science">Human Science</option></select></td><td><select id="prole-'+y+'" class="form-control select-role" required><option selected="selected" value="Project Coordinator">Project Coordinator</option><option value="Student">Student</option></select></td><td><select id="pdesc-'+y+'" class="form-control" required><option selected="selected" value="Associate Professor">Associate Professor</option><option value="Assistant Professor">Assistant Professor</option></select></td><td><small><a href="#" id="remove'+y+'" class="remove_parti_field" style="color:red;">- Remove participant</a></small></td></tr>';
                  $("#parti").append(large);
                  $("#p-"+y).val(partis[i].name);
                  $("#pemail-"+y).val(partis[i].email);
                  $("#pbranch-"+y).val(partis[i].branch.replace("_", " "));
                  $("#prole-"+y).val(partis[i].role.replace("_", " ")).trigger('change');
                  $("#pdesc-"+y).val(partis[i].description.replace("_", " "));
                }
              }
              
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
          url: "<?=base_url();?>index.php/Ctrl_publications/deleteProject",
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
  $("#pagetitle").html("Research Cell | Add Project");
  $(".treeview").removeClass('active');
  $(".treeview").eq(1).addClass('active');
  </script>
</body>
</html>