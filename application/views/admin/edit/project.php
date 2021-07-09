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
      <div class="clearfix"></div><br>
      <h4 style="position:relative;left:2.5%;">Editing Project `<strong><?=$project->title;?>`</strong> :</h4>
        <div class="content">
            <div class="card-body card-block">
      <form id="myform" name="pform" action="<?=base_url();?>index.php/Ctrl_functions/editProject" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">Name Of Project:</label></div>
              <div class="col-12 col-md-10"><input type="text" id="text-input" maxlength="200" name="ptitle" placeholder="Project Title" class="form-control" value="<?=$project->title;?>" required><small class="form-text text-muted">Title of the project to display</small>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">In Collaboration with:</label></div>
              <div class="col-12 col-md-10"><input type="text" id="text-input"  maxlength="200" name="pcollab" placeholder="Foundation" class="form-control" value="<?=$project->collab;?>" required><small class="form-text text-muted">Enter Foundation Name</small>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">Objectives:</label></div>
              <div class="col-12 col-md-10">
              <div class="input_fields_wrap">
              <?php
                $x = 1;
                $objs = $project->objectives;
                $objsarr = explode('-$$-', $objs);
                echo '<input type="text" id="text-input" maxlength="200" value="'.$objsarr[0].'" name="obj-1" placeholder="Objective 1" class="form-control" required>';
                for($y=1; $y < count($objsarr); $y++){
                    $x++;
                    echo '<input type="text" id="text-input"  maxlength="200" value="'.$objsarr[$y].'" name="obj-'.$x.'" placeholder="Objective '.$x.'" class="form-control"/><a style="font-size:14px;color:red;" href="#" class="remove_field" id="remove'.$x.'">- Remove objective</a>';
                }
              ?>
              </div>
              <small class="form-text text-muted"><a href="#" class="add_field_button" style="color:blue;">+ Add another objective</a></small>
             </div>
        </div>
        <div class="row" id="parti">
          <div class="col col-md-2" id="label-form">
            <label for="text-input" class="form-control-label">Participants:</label>
          </div>
          <div class="col-2">
              <div class="form-group">
              <input type="text" id="text-input" name="p-1"  maxlength="100" placeholder="Name #1" class="form-control" value="<?=$parti[0]->name;?>" required/>
              </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <input type="file" id="file-input" name="timage-1" class="form-control-file" accept="image/*"/>
            </div>
          </div>
          <div class="col-2">
              <div class="form-group">
              <select name="select_br_1" class="select-branch form-control" required>
                  <option value="0">Select Branch</option>
                  <option value="IT" <?php if($parti[0]->branch == 'IT'): ?> selected="selected"<?php endif; ?>>IT</option>
                  <option value="COMPS" <?php if($parti[0]->branch == 'COMPS'): ?> selected="selected"<?php endif; ?>>COMPS</option>
                  <option value="EXTC" <?php if($parti[0]->branch == 'EXTC'): ?> selected="selected"<?php endif; ?>>EXTC</option>
                  <option value="ETRX" <?php if($parti[0]->branch == 'ETRX'): ?> selected="selected"<?php endif; ?>>ETRX</option>
                </select>
              </div>
          </div>
          <div class="col-2">
              <div class="form-group">
                <select name="select_role_1" id="select_role_1" class="select-role form-control" required>
                  <option value="0">Select role</option>
                  <option value="Project Coordinator" <?php if($parti[0]->role == 'Project Coordinator'): ?> selected="selected"<?php endif; ?>>Project Coordinator</option>
                  <option value="Student" <?php if($parti[0]->role == 'Student'): ?> selected="selected"<?php endif; ?>>Student</option>
                </select>
              </div>
          </div>
          <div class="col-2">
              <div class="form-group">
                <select name="select_desc_1" id="select_desc_1" class="select-desc form-control" required>
                  <option value="0">Description</option>
                  <option value="<?=$parti[0]->description;?>" selected><?=$parti[0]->description;?></option>
                </select>
              </div>
          </div>
          <?php
          $y = 1;
          foreach($parti as $id => $data){
              if($id == 0)  continue;
              else{
          ?>
              <div class="col col-md-2 removeme<?=++$y?>" id="label-form"> <label for="text-input" class="form-control-label"></label> </div> <div class="col-2 removeme<?=$y?>"> <div class="form-group"> <input type="text"  maxlength="100" id="text-input" name="p-<?=$y?>" placeholder="Name #<?=$y?>" class="form-control" value="<?=$data->name;?>"> </div> </div> <div class="col-2 removeme<?=$y?>"> <div class="form-group"> <input type="file" id="file-input" name="timage-<?=$y?>" class="form-control-file" accept="image/*"/> </div> </div><div class="col-2 removeme<?=$y?>"> <div class="form-group"> <select name="select_br_<?=$y?>" class="select-branch form-control"> <option value="0">Select Branch</option> <option value="IT" <?php if($data->branch == 'IT'): ?> selected="selected"<?php endif; ?>>IT</option> <option value="COMPS" <?php if($data->branch == 'COMPS'): ?> selected="selected"<?php endif; ?>>COMPS</option> <option value="EXTC" <?php if($data->branch == 'EXTC'): ?> selected="selected"<?php endif; ?>>EXTC</option> <option value="ETRX" <?php if($data->branch == 'ETRX'): ?> selected="selected"<?php endif; ?>>ETRX</option> </select> </div> </div> <div class="col-2 removeme<?=$y?>"> <div class="form-group"> <select name="select_role_<?=$y?>" id="select_role_<?=$y?>" class="select-role form-control"> <option value="0">Select role</option> <option value="Project Coordinator" <?php if($data->role == 'Project Coordinator'): ?> selected="selected"<?php endif; ?>>Project Coordinator</option> <option value="Student" <?php if($data->role == 'Student'): ?> selected="selected"<?php endif; ?>>Student</option> </select> </div> </div> <div class="col-2 removeme<?=$y?>"> <div class="form-group"> <select name="select_desc_<?=$y?>" id="select_desc_<?=$y?>"class="select-desc form-control"> <option value="0">Description</option> <option value="<?=$data->description;?>" selected><?=$data->description;?></option> </select> </div> </div><div class="col col-md-2 removeme<?=$y?>"></div><div class="col-12 col-md-10 removeme<?=$y?>"><a style="font-size:14px;color:red;" href="#" class="remove_parti_field" id="removep<?=$y?>">- Remove participant</a></div>
          <?php
              }
          }
        ?>
        </div>
        <div class="row form-group">
            <div class="col col-md-2"></div>
            <div class="col-12 col-md-10">
            <small class="form-text text-muted"><a href="#" class="add_parti_button" style="color:blue;">+ Add another participant</a></small>
            </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-2" id="label-form"><label for="file-input" class=" form-control-label">Upload Project Image:</label></div>
         <div class="col-12 col-md-10"><input type="file" id="file-input" name="pimage" class="form-control-file" accept="image/*"></div>
         </div>
         <div class="row form-group">
          <div class="col col-md-2" id="label-form"><label for="file-input" class=" form-control-label">Upload Team Image:</label></div>
         <div class="col-12 col-md-10"><input type="file" id="file-input" name="ptimage" class="form-control-file" accept="image/*"></div>
         </div>
         <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">Overview of Project:</label></div>
              <div class="col-12 col-md-10"><textarea name="content" id="editor"></textarea><small class="form-text text-muted">Add project details</small>
          </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">MoU Under:</label></div>
              <div class="col-12 col-md-10">
              <select id="mous" name="mous" placeholder="Project MoUs" class="form-control">
                <option selected="selected" value="0">Select MoUs</option>
                <?php
                foreach ($mous as $id => $value) {
                  if($project->mous != $value['id']){
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                  }else{
                    echo "<option selected='selected' value='".$value['id']."'>".$value['name']."</option>";
                  }
                }
                ?>
              </select>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">Project Video:</label></div>
              <div class="col-12 col-md-10"><input type="text" id="text-input" name="plink" value="<?=$project->link;?>" placeholder="Project Video Link" class="form-control" maxlength="200"/><small class="form-text text-muted">Enter Project Youtube link if there</small>
             </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-2" id="label-form"><label for="file-input" class=" form-control-label">Upload Excel Sheet:</label></div>
         <div class="col-12 col-md-10"><input type="file" id="file-input" name="pexcel" class="form-control-file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></div>
         </div>
        <div class="row form-group">
            <div class="col col-md-2" id="label-form"><label for="text-input" class="form-control-label">Project Type:</label></div>
              <div class="col-12 col-md-3">
                <select name="select_type" id="select_type" class="select-role form-control" required>
                  <option value="0">Select type</option>
                  <option value="Upcoming" <?php if($project->type == 'Upcoming'): ?> selected="selected"<?php endif; ?>>Upcoming</option>
                  <option value="On going" <?php if($project->type == 'On going'): ?> selected="selected"<?php endif; ?>>On going</option>
                  <option value="Completed" <?php if($project->type == 'Completed'): ?> selected="selected"<?php endif; ?>>Completed</option>
                </select>
                <small class="form-text text-muted">Choose project type</small>
          </div>
        </div>
        <div class="row form-group" style="position:relative;left:18.5%;">
            <input type="hidden" name="pid" value="<?=$project->id?>;"/>
            <button name="submit" value="padd" id="submit" class="btn btn-primary btn">
            <i class="fa fa-dot-circle-o"></i> Edit
            </button>&nbsp;&nbsp;
            <button id="reset" class="btn btn-danger btn">
            <i class="fa fa-ban"></i> Reset
            </button>
        </div>
      </form>
        </div>
        </div>
        <div class="clearfix"></div><br>
        <?php $this->load->view("admin/footer"); ?>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="<?=base_url();?>plugins/ckeditor/ckeditor.js"></script>
    <script>
      ClassicEditor.create(document.querySelector('#editor'),{toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]}).then(editor => {theEditor = editor;}).catch(error => {console.error(error);});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
    theEditor.setData('<?=html_entity_decode($project->overview);?>');
    var $ = jQuery.noConflict();
    $("#title").html("Admin | Edit Project");
    $(document).ready(function() {
        $('.breadcrumbs .page-title h1').html('Edit Project');
        $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
        $('.breadcrumbs .text-right a').eq(1).html('Project').attr("href", "<?=base_url();?>index.php/Ctrl_list/project");
        $('.breadcrumbs .text-right li').eq(2).html('Edit');
          $("#submit").on("click",function(){
          var conf = confirm("Are you sure you want to submit?");
          if(conf==true){
            document.pform.submit();
          }else{
            return false;
          }
        });
        var max_fields2      = 15;
        var wrapper2   		= jQuery("#parti"); 
        var add_button2      = jQuery(".add_parti_button"); 
        
        var y = <?php echo json_encode($y, JSON_UNESCAPED_UNICODE);?>;
        jQuery(add_button2).click(function(e){ 
          e.preventDefault();
          if(y < max_fields2){
            y++;
            var large='<div class="col col-md-2 removeme'+y+'" id="label-form"> <label for="text-input" class="form-control-label"></label> </div> <div class="col-2 removeme'+y+'"> <div class="form-group"> <input type="text" id="text-input" name="p-'+y+'" placeholder="Name #'+y+'" class="form-control"> </div> </div><div class="col-2 removeme'+y+'"> <div class="form-group"> <input type="file" id="file-input" name="timage-'+y+'" class="form-control-file" accept="image/*"/> </div> </div> <div class="col-2 removeme'+y+'"> <div class="form-group"> <select name="select_br_'+y+'" class="select-branch form-control"> <option value="0">Select Branch</option> <option value="IT">IT</option> <option value="COMPS">COMPS</option> <option value="EXTC">EXTC</option> <option value="ETRX">ETRX</option> </select> </div> </div> <div class="col-2 removeme'+y+'"> <div class="form-group"> <select name="select_role_'+y+'" id="select_role_'+y+'" class="select-role form-control"> <option value="0">Select role</option> <option value="Project Coordinator">Project Coordinator</option> <option value="Student">Student</option> </select> </div> </div> <div class="col-2 removeme'+y+'"> <div class="form-group"> <select name="select_desc_'+y+'" id="select_desc_'+y+'"class="select-desc form-control"> <option value="0">Description</option> </select> </div> </div><div class="col col-md-2 removeme'+y+'"></div><div class="col-12 col-md-10 removeme'+y+'"><a style="font-size:14px;color:red;" href="#" class="remove_parti_field" id="removep'+y+'">- Remove participant</a></div>';
            jQuery(wrapper2).append(large);
          }else{
            alert("You have reached max number of participants!");
          }
        });
        jQuery(wrapper2).on("click",".remove_parti_field", function(e){
          e.preventDefault();
          var id = this.id;
          var strid = id.slice(7);
          if(y==strid){
            jQuery('.removeme'+y).remove(); y--;
          }else{
            alert("Remove the succeeding participants first!");
          }
        });
        var max_fields      = 10;
        var wrapper   		= $(".input_fields_wrap"); 
        var add_button      = $(".add_field_button"); 
        var x = <?php echo json_encode($x, JSON_UNESCAPED_UNICODE);?>;
        $(add_button).click(function(e){ 
          e.preventDefault();
          if(x < max_fields){
            x++;
            jQuery(wrapper).append('<input type="text" id="text-input" placeholder="Objective '+x+'" class="form-control" name="obj-'+x+'"/><a style="font-size:14px;color:red;" href="#" class="remove_field" id="remove'+x+'">- Remove objective</a>');
          }else{
            alert("You have reached max number of objectives!");
          }
        });
        jQuery(wrapper).on("click",".remove_field", function(e){
          e.preventDefault();
          var id = this.id;
          var strid = id.slice(6);
          if(x==strid){
            jQuery(this).parent('div').remove(); x--;
          }else{
            alert("Remove the succeeding objectives first!");
          }
        })
        jQuery("#reset").on("click",function(){
          var conf = confirm("Are you sure you want to reset?");
          if(conf==true){
            jQuery(".form-control").val("");
            jQuery(".form-control-file").val("");
            theEditor.setData('');
          }
        });
        $('#myform').on("change", ".select-role", function(){
            var id = this.id;
            var strid = id.slice(12);
            var role = $(this).val();
            var wrap = $("#select_desc_" + strid);
            if(role == "Project Coordinator"){
              $(wrap).html('<option value="Associate Professor">Associate Professor</option><option value="Assistant Professor">Assistant Professor</option>');
            }
            if(role == "Student"){
              $(wrap).html('<option value="FE">FE</option><option value="SE">SE</option><option value="TE">TE</option><option value="BE">BE</option>');
            }
        });
      });
    </script>
    <script>
      document.forms[0].addEventListener('submit', function(evt){
        var mous = $("#mous").val();
        if(mous == "0"){
          alert('Select MoUs!');
          evt.preventDefault();
          return;
        }
      }, false);
  </script>

</body>
</html>