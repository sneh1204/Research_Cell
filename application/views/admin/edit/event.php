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
      <h4 style="position:relative;left:2.5%;">Editing Event `<strong><?=$event->name;?>`</strong> :</h4>
        <div class="content">
            <div class="card-body card-block">
      <form name="eform" action="<?=base_url();?>index.php/Ctrl_functions/editEvent" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">Name Of Event:</label></div>
              <div class="col-12 col-md-6"><input type="text" id="text-input" maxlength="200" name="ename" value="<?=$event->name;?>" placeholder="Event Name" class="form-control" required><small class="form-text text-muted">Name of the event to display</small>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">Event Date:</label></div>
              <div class="col-12 col-md-6"><input type="text" id="datepicker" value="<?=date("m/d/Y", strtotime(str_replace('-', '/', $event->date)));?>" name="edate" placeholder="Event Date" class="form-control" required><small class="form-text text-muted">Select Event Data</small>
             </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">Event Link:</label></div>
              <div class="col-12 col-md-6"><input type="text" id="text-input" maxlength="200" name="elink" value="<?=$event->link;?>" placeholder="Event Link" class="form-control" required><small class="form-text text-muted">External Event redirect link</small>
             </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3" id="label-form"><label for="file-input" class=" form-control-label">Upload Event Image:</label></div>
         <div class="col-12 col-md-6"><input type="file" id="file-input" name="eimage" class="form-control-file" accept="image/*"></div>
         </div>
         <div class="row form-group">
          <div class="col col-md-3" id="label-form"><label for="file-input" class=" form-control-label">Upload Event Collage:</label></div>
         <div class="col-12 col-md-6"><input type="file" id="file-input" name="ecimage" class="form-control-file" accept="image/*"></div>
         </div>
         <div class="row form-group">
          <div class="col col-md-3" id="label-form"><label for="file-input" class=" form-control-label">Upload Excel Sheet:</label></div>
         <div class="col-12 col-md-6"><input type="file" id="file-input" name="eexcel" class="form-control-file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></div>
         </div>
         <div class="row form-group">
            <div class="col col-md-3" id="label-form"><label for="text-input" class="form-control-label">Event Details:</label></div>
              <div class="col-12 col-md-6"><textarea name="content" id="editor" maxlength="2000"></textarea><small class="form-text text-muted">Add event details</small>
              <input type="hidden" id="etype" name="etype" value="<?=$event->type;?>"/>
          </div>
        </div>
        <div class="row form-group" style="position:relative;left:27%;">
        <input type="hidden" name="eid" value="<?=$event->id?>;"/>
            <button name="submit" value="eadd" id="submit" class="btn btn-primary btn">
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
    <script src="<?=base_url();?>plugins/ckeditor/ckeditor.js"></script>
    <script>
      ClassicEditor.create(document.querySelector('#editor'),{toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]}).then(editor => {theEditor = editor;}).catch(error => {console.error(error);});
    </script>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url();?>assets/js/main.js"></script>
    <script>
    theEditor.setData('<?=html_entity_decode($event->details);?>');
    var $ = jQuery.noConflict();
    $(function() {
        $("#datepicker").datepicker();
      });
    $("#title").html("Admin | Edit Event");
    $(document).ready(function() {
        $('.breadcrumbs .page-title h1').html('Edit Event');
        $('.breadcrumbs .text-right a').eq(0).html('Dashboard').attr("href", "<?=base_url();?>index.php/Ctrl_admin");
        $('.breadcrumbs .text-right a').eq(1).html('Event').attr("href", "<?=base_url();?>index.php/Ctrl_list/event");
        $('.breadcrumbs .text-right li').eq(2).html('Edit');
        jQuery("#submit").on("click",function(){
          var conf = confirm("Are you sure you want to submit?");
          if(conf==true){
            document.eform.submit();
          }else{
            return false;
          }
        });
        $('#datepicker').datepicker().change(evt => {
          var selectedDate = $('#datepicker').datepicker('getDate');
          var now = new Date();
          now.setHours(0,0,0,0);
          if(selectedDate < now){
            $('#etype').val('completed');
          }else{
            $('#etype').val('upcoming');
          }
        });
        var previousDate;
        $("#datepicker").focus(function(){   
          previousDate= $(this).val(); ;
        });
        $("#datepicker").blur(function(){   
          val = $(this).val();
          val1 = Date.parse(val);
          if (isNaN(val1)==true && val!==''){
            $(this).val(previousDate);  
          }
        });
        jQuery("#reset").on("click",function(){
          var conf = confirm("Are you sure you want to reset?");
          if(conf==true){
            jQuery(".form-control").val("");
            jQuery("#datepicker").val("<?=date('m/d/Y');?>");
            jQuery(".form-control-file").val("");
            theEditor.setData('');
          }
        });
      });
    </script>
    <script>
      document.forms[0].addEventListener('submit', function(evt){
        $(".form-control-file").each(function() {
          if($(this).attr("name") != "eexcel"){
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
            val = $("#datepicker").val();
            val1 = Date.parse(val);
            if (isNaN(val1)==true && val!==''){
              alert('Wrong date selected!');
              evt.preventDefault(); 
            }
          }
        });
      }, false);
  </script>

</body>
</html>