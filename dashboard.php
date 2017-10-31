<?php 
include_once("header.php");
include_once("include/function.php");

?>
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
<h1 align="center">Notes  </h1>     
<h3 align="center">Note taking made easy  </h3>  
<div class="main-content"> 
 <div class="row">
  <div class="col-lg-12">
   <div class="panel panel-default">
   

<div class="panel-body">


<form action="add_notes.php"  enctype="multipart/form-data" method="post" name="form" onsubmit=""  >
<div class="form-group"> 
<div class="col-sm-10"> 
	<input type="text"  class="form-control required" name="notes_title" id="notes_title"  placeholder="Notes Title" value="<?php echo $edit['notes_title'];?>">
</div> 
</div>
<br /><br />
<div class="form-group"> 

<div class="col-sm-10">

       <textarea name="notes_description" id="notes_description" placeholder="Nores Discription" rows="10" class="form-control required"><?php echo $edit['notes_description'];?></textarea>
</div>
</div>
<div class="form-group"> 

<div class="col-sm-10">
<br />
</div>
</div>
<div class="form-group"> 
<div class="col-sm-10"><input name="Submit" type="submit" class="btn btn-success"  id="save" value="Submit"/> &nbsp; &nbsp;<input name="Submit" type="reset" class="btn btn-error"  id="save" value="Reset"/> &nbsp;&nbsp;<input name="Submit" type="reset" class="btn btn-error"  id="save" value="Refresh"/></td>
  </div>
  </div>

<input type="hidden" name="act" value="ManageNotes" />
<input type="hidden" name="temp_p_filename" id="temp_p_filename" value="<?php echo $edit['p_filename'];?>" />
<input type="hidden" name="p_id" value="<?php echo $edit['p_id'];?>" />
</form>

 </div>
     					
    </div>
  </div>
</div>


<?php include_once("footer.php");?>
<script src="js/plugins/summernote/summernote.min.js"></script>
<!--Markdown Editor-->
<script src="js/plugins/markdown/bootstrap-markdown.js"></script>
<script src="js/plugins/markdown/markdown.js"></script>
<script>
	 $(document).ready(function(){
		$('#summernote').summernote({
		  height: 260,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true                  // set focus to editable area after initializing summernote
		});
		
		
	});
</script>

