<?php
include_once("include/config.php");	 
include_once("include/function.php");
$request_from_server=$_SERVER['HTTP_REFERER'];
$this_server=$_SERVER['HTTP_HOST'];
if($request_from_server!=''){
	check_access_url($request_from_server,$this_server);
}
if($_SESSION['admin_login']!='Yes' || $_SESSION['all_step']!='complete' || $_SESSION['url']=='' || $_SESSION['admin_login_id']=='' || $_SESSION['admin_username']=='')
{
	$msg="Please login to access the Panel........";
	header("Location:login.php?msg=$msg");
	exit;
}
else if(global_login($table_name="admin",$cond="where user_id='".$_SESSION['admin_login_id']."' and user_name='".$_SESSION['admin_username']."' and status='Y'")==false){
	$msg="Please login to access the Panel........";
  header("Location:index.php?msg=$msg");
  exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title> Notes Panel </title>
<link href="<?php echo $admin_path;?>css/entypo.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/mouldifi-core.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/mouldifi-forms.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/mouldifi-forms.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<!--Summernote-->
<link href="<?php echo $admin_path;?>css/plugins/summernote/summernote.css" rel="stylesheet">
<!--Markdown-->
<link href="<?php echo $admin_path;?>css/plugins/markdown/bootstrap-markdown.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $admin_path;?>css/mouldifi-forms.css">
<link href="<?php echo $admin_path;?>css/plugins/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?php echo $admin_path;?>css/plugins/scrollbar/perfect-scrollbar.css" rel="stylesheet">

<link href="<?php echo $admin_path;?>css/dcalendar.picker.css" rel="stylesheet" type="text/css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style>
.container { margin:150px auto 30px auto; max-width:300px;}
</style>


<link href="<?php echo $admin_path;?>js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
<script src="<?php echo $admin_path;?>js/js.js" type="text/javascript" language="javascript"></script>

</head>
<body>

<!-- Page container -->
<div class="page-container">

	
  	<!-- Main container -->
  	<div class="main-container">
  
		<!-- Main header -->
		<div class="main-header row" style="background-color:#000000;">
		  <div class="col-sm-12 col-xs-7">
		  
			<!-- User info -->
			<ul class="user-info pull-right">          
			  <li><a  href="add_notes.php" aria-expanded="false" style="color:#FFFFFF;"><strong>Create Notes</strong></a> &nbsp;|&nbsp;<a  href="view_notes.php" aria-expanded="false" style="color:#FFFFFF;"><strong>View Notes</strong></a>&nbsp;|&nbsp;<a  href="lib/login.php?act=logout" aria-expanded="false" style="color:#FFFFFF;"><strong>Welcome : <?php echo $_SESSION['user_name'];?>&nbsp;&nbsp;<i class="icon-logout"></i>Logout</strong></a>
			  
				<!-- User action menu --> &nbsp;&nbsp;&nbsp;
			
				
			  </li>
			</ul>

			
			
			
		  </div>
		  
		
		</div>