<?php 
include_once("header.php");
include_once("include/function.php");
if($_GET['act']=='deleteNotes' && $_GET['notes_id']>0 && $_GET['notes_id']!=''){
    $id=$_GET['notes_id'];
    if($id){
    $response=deleteNotes($api_url,$id);
      
        echo"<script>alert('Notes deleted successfully.');</script>";
        echo"<script>window.location='view_notes.php';</script>";
     
    }
}


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$api_url");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
$response=json_decode($response);

if( ! $result = curl_exec($ch)){ 
  trigger_error(curl_error($ch)); 
} 
curl_close($ch);

?>

<div class="main-content">          
 <div class="row">
  <div class="col-lg-12">
   <div class="panel panel-default"> 
    
<div class="panel-heading clearfix">
<h3 class="panel-title">View Notes </h3>
					
						</div>

<div class="panel-body">
<?php if($_REQUEST['msg'] && $_REQUEST['error_type']=='success') {?><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><?php echo $_REQUEST['msg'];?></strong>  </div></span></div>
<?php }elseif($_REQUEST['error_type']=='error'){?><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><?php echo $_REQUEST['msg'];?></strong>  </div><?php } ?>
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
<thead>
    <tr>      
      <th>Sr.No</th>
      <th>Notes Title</th>
	  <th>Description</th>      
      <th>Action</th>
    </tr> 
	</thead>
	<?php
	$edit="<img src='img/edit.jpg' alt='edit'/>";
	$view="<img src='img/folder.jpg' alt='View'/>";
	$delet="<img src='img/cancel.jpg' alt='Delete'/>";
	$sr_no=1;
  foreach($response  as $view){
	?>   
	<tr>
	
      <td><?php echo $sr_no++;?></td>
      <td width='10%'><?php  echo $view->title;?></td>
	  <td><?php  echo $view->description;?></td>
      
	 
      <td>
	  <a href="add_notes.php?act=edit&edit_id=<?php echo $view->id;?>"><?php echo $edit;?></a> |
	 
	  <a href="javascript:deleteNotes(<?php echo $view->id;?>)"><?php echo $delet;?></a>	</td>
    </td>
	</tr>
	<?php
	}
	?>
	
	</tbody>
  </table>
<script>
function deleteNotes(notes_id)
{
  if(confirm("Do you want to delete.!"))
  {
    window.location="view_notes.php?act=deleteNotes&notes_id="+notes_id;
  }
}
</script>
</div>
						</div>
					</div>
				</div>
			</div>


<?php include_once("footer.php");?>