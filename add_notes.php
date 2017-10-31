<?php 
include_once("header.php");
include_once("include/function.php");
$error='';
$flag='';
if($_POST['act']=='updateNotes' && $_POST['notes_id']>0 && $_POST['notes_id']!=''){

 $notes_title=$_POST['notes_title'];
 $notes_id=$_POST['notes_id'];
 $notes_description=$_POST['notes_description'];
 if($notes_title==''){
 $error='Enter the notes title.';
 }
 else if($notes_description==''){
 $error='Enter the notes description.';
 }
 else if($error==''){
    $response=EditNotes($api_url,$notes_id,$notes_title, $notes_description);
     $json=json_decode($response);
   if($json->id){
    echo"<script>alert('Notes updated successfully.');</script>";
    echo"<script>window.location='view_notes.php';</script>";
   }
 }
}
else if($_POST['act']=='ManageNotes'){

 $notes_title=$_POST['notes_title'];
 $notes_description=$_POST['notes_description'];
 if($notes_title==''){
 $error='Enter the notes title.';
 }
 else if($notes_description==''){
 $error='Enter the notes description.';
 }
 else if($error==''){
   $response=AddNotes($api_url,$notes_title, $notes_description);
   $json=json_decode($response);
   if($json->id){
    echo"<script>alert('Notes created successfully.');</script>";
    echo"<script>window.location='view_notes.php';</script>";
   }
	
 }
}



if($_GET['act']=='edit' && $_GET['edit_id']>0){
    $id=$_GET['edit_id'];
    $ch = curl_init();
//echo "https://private-87cf3-henrikygge.apiary-mock.com/notes/$id";
curl_setopt($ch, CURLOPT_URL, "$api_url/$id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);
$response= json_decode($response);
}
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
	<input type="text"  class="form-control required" name="notes_title" id="notes_title"  placeholder="Notes Title" value="<?php echo $response->title;?>">
</div> 
</div>
<br /><br />
<div class="form-group"> 

<div class="col-sm-10">

       <textarea name="notes_description" id="notes_description" placeholder="Nores Discription" rows="10" class="form-control required"><?php echo $response->description;?></textarea>
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

<input type="hidden" name="act" value="<?php if($response->id)echo'updateNotes';
else echo'ManageNotes';?>" />

<input type="hidden" name="notes_id" id='notes_id' value="<?php echo $response->id;?>" />
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

