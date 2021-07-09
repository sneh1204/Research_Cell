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
      <h4 style="position:relative;left:2.5%;">Editing MoUs `<strong><?=$mous->name;?>`</strong> :</h4>
        <div class="content">
            <div class="card-body card-block">
      <form name="mform" action="<?=base_url();?>index.php/Ctrl_functions/editMous" method="post" enctype="multipart/form-data" class="form-horizontal">
         <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">Name Of MoUs :</label></div>
              <div class="col-12 col-md-6"><input type="text" id="text-input" maxlength="200" name="mname" value="<?=$mous->name;?>" placeholder="MoUs Name" class="form-control" required><small class="form-text text-muted">Name of the MOUs to display</small>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">MoU Date :</label></div>
              <div class="col-12 col-md-6"><input type="date" id="text-input" name="date" placeholder="MoUs Date" value="<?=date('Y-m-d', strtotime($mous->date));?>" class="form-control" required>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">MoU Duration :</label></div>
              <div class="col-12 col-md-6"><select id="duration" name="span" placeholder="MoUs Span" class="form-control"><option selected="selected" value="0">Select Duration</option></select>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">MoU Type :</label></div>
              <div class="col-12 col-md-6"><input type="text" id="text-input" maxlength="200" name="type" value="<?=$mous->type;?>" placeholder="MoUs Type" class="form-control" required>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">SPOC Name :</label></div>
              <div class="col-12 col-md-6"><input type="text" id="text-input" name="spoc" value="<?=$mous->spoc;?>" placeholder="SPOC Name" class="form-control" required>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">MoU Scope :</label></div>
              <div class="col-12 col-md-6"><select id="scope" name="scope" placeholder="MoUs Scope" class="form-control"></select>
             </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3" id="label-form"><label for="file-input" class=" form-control-label">Upload MoUs Logo :</label></div>
         <div class="col-12 col-md-6"><input type="file" id="file-input" name="mlogo" class="form-control-file" accept="image/*"></div>
         </div>
        <div class="row form-group">
          <div class="col col-md-3" id="label-form"><label for="file-input" class=" form-control-label">Upload MoUs Image :</label></div>
         <div class="col-12 col-md-6"><input type="file" id="file-input" name="mimage" class="form-control-file" accept="image/*"></div>
         </div>
        <div class="row form-group" style="position:relative;left:27%;">
        <input type="hidden" name="mid" value="<?=$mous->id?>;"/>
            <button name="submit" value="madd" id="submit" class="btn btn-primary btn">
            <i class="fa fa-dot-circle-o"></i> Edit
            </button>&nbsp;&nbsp;
            <button id="reset" class="btn btn-danger btn">
            <i class="fa fa-ban"></i> Reset
            </button>
        </div>
      </form>
      </form>
        </div>
        </div>
        <div class="clearfix"></div><br>
        <?php $this->load->view("admin/footer"); ?>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script> 
    <script>
    var $ = jQuery.noConflict();
    $("#title").html("Admin | Edit MoUs");
    $(document).ready(function() {
        $('.breadcrumbs .page-title h1').html('Edit MoUs');
        $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
        $('.breadcrumbs .text-right a').eq(1).html('MoUs').attr("href", "<?=base_url();?>index.php/Ctrl_list/mous");
        $('.breadcrumbs .text-right li').eq(2).html('Edit');
        var i;
        var sel = <?=$mous->span;?>;
        for(i = 1; i <= 20; i++){
          if(i == sel){
            $('#duration').append($("<option></option>").attr('value', i).text(i).attr('selected', 'selected'));
          }else{
            $('#duration').append($("<option></option>").attr('value', i).text(i));
          }
        }
        var arr = ["NGO", "Industry", "University"];
        var i;
        var sel = "<?=$mous->type;?>";
        for(i = 0; i < arr.length; i++){
          if(arr[i] == sel){
            $('#type').append($("<option></option>").attr('value', arr[i]).text(arr[i]).attr('selected', 'selected'));
          }else{
            $('#type').append($("<option></option>").attr('value',  arr[i]).text(arr[i]));
          }
        }
        var arr = ["National", "International"];
        var i;
        var sel = "<?=$mous->scope;?>";
        for(i = 0; i < arr.length; i++){
          if(arr[i] == sel){
            $('#scope').append($("<option></option>").attr('value', arr[i]).text(arr[i]).attr('selected', 'selected'));
          }else{
            $('#scope').append($("<option></option>").attr('value',  arr[i]).text(arr[i]));
          }
        }
        $("#reset").on("click",function(){
          var conf = confirm("Are you sure you want to reset?");
          if(conf==true){
            jQuery(".form-control").val("");
            jQuery(".form-control-file").val("");
          }
      });
      $("#submit").on("click",function(){
          var conf = confirm("Are you sure you want to submit?");
          if(conf==true){
            document.mform.submit();
          }else{
            return false;
          }
        });
      });
    </script>
    <script>
      document.forms[0].addEventListener('submit', function(evt){
        var duration = $("#duration").val();
        if(duration == "0"){
          alert('Select MoU duration!');
          evt.preventDefault();
          return;
        }
        var type = $("#type").val();
        if(type == "0"){
          alert('Select MoU type!');
          evt.preventDefault();
          return;
        }
        $(".form-control-file").each(function() {
          var file = this.files[0];
          if(file == null)  return;
          if(file.type != "image/jpeg" && file.type != "image/jpg" && file.type != "image/png"){
            alert('Only Image file is supported!');
            evt.preventDefault();
          }
          if(file.size > 52428800 || file.size < 0){
            alert('Image total size must be less than 50 MB!');
            evt.preventDefault();
          }
        });
      }, false);
  </script>
</body>
</html>