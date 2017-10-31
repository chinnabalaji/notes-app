<?php
function get_transaction_type($edit=''){
  $array=array('Cash','Debit / Credit Card','Net Banking','NEFT','Cheque','RTGS');
  $list='';
  foreach($array as $k=>$v){
   $key=$k+1;
   $list.="<option value='$key'>$v</option>";
  }
  return $list;
}
function LEFT_recursive_function($member_id,&$ltot,&$counter) {
// USEFUL IF YOU WANT TO STOP AT A CERTAIN LEVEL
$tot2 = array();
//DO THE SIMPLE QUERY - PARENT VALUE
if($member_id!='')
$sqlA = "SELECT member_id,member_code,member_status,sponsor_id,sponsor_code,member_name,member_position,under_referal_code,under_referal_id FROM tbl_member WHERE under_referal_id='$member_id' and under_referal_id!='' and member_position='left' ORDER BY member_id ASC";
$res=mysql_query($sqlA) or die ("2Fail recursive");
$totrow = mysql_num_rows($res);
if($totrow>0)
{
$data1=mysql_fetch_assoc($res);
//print_r($data1);
$ltempstr = $data1['member_id'];
$counter=$counter+1;
LEFT_recursive_function($data1['member_id'],$ltot,$counter);
$ltot=$ltot.",".$ltempstr;
}
}

function RIGHT_recursive_function($member_id,&$rtot,&$rcounter) {
// USEFUL IF YOU WANT TO STOP AT A CERTAIN LEVEL
$tot3 = array();
//DO THE SIMPLE QUERY - PARENT VALUE
if($member_id!='')
$sqlA = "SELECT member_id,member_code,member_status,sponsor_id,sponsor_code,member_name,member_position,under_referal_code,under_referal_id FROM tbl_member WHERE under_referal_id='$member_id' and under_referal_id!='' and member_position='right' ORDER BY member_id ASC";
$res=mysql_query($sqlA) or die ("2Fail recursive");
$totrow = mysql_num_rows($res);
if($totrow>0)
{
$data1=mysql_fetch_assoc($res);
$rtempstr = $data1['member_id'];
$rcounter=$rcounter+1;
RIGHT_recursive_function($data1['member_id'],$rtot,$rcounter);
$rtot=$rtot.",".$rtempstr;
}
}

function leftrecursive_function($member_id,&$ltot,&$counter) {
// USEFUL IF YOU WANT TO STOP AT A CERTAIN LEVEL
$tot2 = array();
//DO THE SIMPLE QUERY - PARENT VALUE
if($member_id!='')
 $sqlA = "SELECT member_id,member_code,sponsor_id,under_referal_id,sponsor_code FROM tbl_member WHERE sponsor_id='$member_id'";
$res=mysql_query($sqlA) or die ("2Fail recursive");
$totrow = mysql_num_rows($res);
if($totrow>0)
{
while($data1=mysql_fetch_assoc($res)){

 $ltempstr = $data1['member_id'];
$counter=$counter+1;
leftrecursive_function($data1['member_id'],$ltot,$counter);
$ltot=$ltot.",".$ltempstr;
}
}
}

function rightrecursive_function($member_id,&$rtot,&$rcounter) {
// USEFUL IF YOU WANT TO STOP AT A CERTAIN LEVEL
$tot3 = array();
//DO THE SIMPLE QUERY - PARENT VALUE
if($member_id!='')
 $sqlA = "SELECT member_id,member_code,sponsor_id,under_referal_id,sponsor_code FROM tbl_member WHERE sponsor_id='$member_id'";
$res=mysql_query($sqlA) or die ("2Fail recursive");
$totrow = mysql_num_rows($res);
if($totrow>0)
{
while($data1=mysql_fetch_assoc($res)){
$rtempstr = $data1['member_id'];
$rcounter=$rcounter+1;
rightrecursive_function($data1['member_id'],$rtot,$rcounter);
$rtot=$rtot.",".$rtempstr;
}
}
}
############################################################
function count_record($table_name,$field,$cond){
	$sqlcount="select COUNT($field) from $table_name $cond";
	$rscount=mysql_query($sqlcount) or die(mysql_error());
	$count=mysql_fetch_assoc($rscount);
	return $count;
}
############################################################
function get_dd_mm_yy($start='',$end='',$order='',$edit=''){
	if($order!=''){
		for($i=$start;$i<=$end;$i++){
			if($i<10)
			$ii='0'.$i;
		    else
			$ii=$i;
			if($edit==$ii)
			 $list.="<option value='$ii' selected>$ii</option>";
		   else
			$list.="<option value='$ii'>$ii</option>";
		}
	}
	else{
		for($i=$end;$i>=$start;$i--){
			if($i<10)
			$ii='0'.$i;
		    else
			$ii=$i;
			if($edit==$ii)
			 $list.="<option value='$ii' selected>$ii</option>";
		   else
			$list.="<option value='$ii'>$ii</option>";
		}
	}
	return $list;
}
##########################################
function get_single_field_value($table_name,$field_name,$con)
{  
	if($_SESSION['counter']=="" || $_SESSION['counter']==0)
	{
	  $_SESSION['counter']=1;
	  $sqlcount="select $field_name from $table_name $con";
	  $rscount=mysql_query($sqlcount);
	  if(mysql_num_rows($rscount))
	  {
		$counter=mysql_fetch_assoc($rscount);
		$count=$counter[$field_name]+1;
		$query="UPDATE $table_name SET count_no='$count' $con";
		$res=mysql_query($query);
		return $count;
	  }
	}
	else
	 {
	  $sqlcount="select $field_name from $table_name $con";
	  $rscount=mysql_query($sqlcount);
	  $counter=mysql_fetch_assoc($rscount);
	  return $counter[$field_name];   
	  }
  
}
####################################################### function Mobile validation
function mobile_validation($phone)
{
	$phone=test_input($phone);
	if(preg_match('/^\d{10}$/', $phone))
    return true;
    else
	return false;
   
}
####################################################### function Email Validation
function email_validation($email)
{
	$emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
	$email=test_input($email);
	if(preg_match($emailval, $email))
    return true;
    else
	return false;
    
}
####################################################### function for special character
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
####################################################### function for dropdown list
function get_dropdown_list($tbale="",$col_id="",$col_name="",$edit_id="",$cond="",$field1='')
{
  
	$sql="select * from $tbale $cond";
	$rs=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs)>0)
	{
		$list="";
		while($data=mysql_fetch_assoc($rs))
		{
			$id=$data[$col_id];
			$name=$data[$col_name];
			if($field1!='')
			$name.=' - '.$data[$field1];
			if($edit_id==$id)
			$list.="<option value='$id' selected='selected'>$name </option>";
		    else
			$list.="<option value='$id'>$name</option>";
		
		}
		return $list;
	} 
	
}
#########################################################  function for fetch all record from tables
function fetch_all_record_function($table_name='',$col_id='',$col_name='',$cond='')
{
	if($cond=='')
	 $sql="select * from $table_name";
	else
	 $sql="select * from $table_name $cond";	
	  
	  $ArrayData=array();
	  $rssql=mysql_query($sql) or die(mysql_error());
	  if(mysql_num_rows($rssql))
	  {
		  while($data=mysql_fetch_assoc($rssql))
		  {
			  $ArrayData[$data[$col_id]]=$data[$col_name];
		  }
		  return $ArrayData;
	  }
	  else{
		  return false;
	  }	  
}

################################################################## function for global uploads
function global_file_upload_function($files,$field_name,$upload_path,$upload_path_small)
{
  $allow_extension=array("jpg","png","gif","JPG","PNG","GIF","jpeg","JPEG");
  $new=explode(".",$files[$field_name]['name']);
  $file_extension=end($new);

  if(in_array($file_extension,$allow_extension))
  {
   if($files['size']<25000 && $files['error']==0)
   {
	   $new_file_name=time()."_".$files[$field_name]['name'];
if($file_extension=="jpg" || $file_extension=="jpeg" || $file_extension=='JPG' || $file_extension=='JPEG' )
{
$uploadedfile = $files[$field_name]['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
}
else if($file_extension=="png" || $file_extension=="PNG")
{
$uploadedfile = $files[$field_name]['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
else 
{
$src = imagecreatefromgif($uploadedfile);
}
list($width,$height)=getimagesize($uploadedfile);
$newwidth=75;
//$newheight=($height/$width)*$newwidth;
$newheight=75;
$tmp=imagecreatetruecolor($newwidth,$newheight);

$newwidth1=75;
//$newheight1=($height/$width)*$newwidth1;
$newheight1=75;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

//$filename = $upload_path.$files[$field_name]['name'];

$filename1 = $upload_path_small.$new_file_name;

//imagejpeg($tmp,$filename,100);

imagejpeg($tmp1,$filename1,100);

imagedestroy($src);
//imagedestroy($tmp);
imagedestroy($tmp1);
   if(move_uploaded_file($files[$field_name]['tmp_name'],$upload_path.$new_file_name))
   return $new_file_name;
   else
   return 1;  
   }
   else
   {
		$msg="File Size exceeded.!";
		return 2; 
   }
  }
  else
  {
    $msg="File Format Does Not Allow To Upload.!";
	return 3;
  }
}
################################################################## function for fetch multiple fields from tables / single rows
function get_multi_value($table_name,$col_name,$con)
{
 $sql="select * from $table_name $con";
 $rs=mysql_query($sql) or die(mysql_error());

 if(mysql_num_rows($rs)>0)
 {
  $record=mysql_fetch_assoc($rs);
 return $record; 
 }
 else{
return "0";
 }
}
################################################################## function for checkbox list
function get_checkboxList($table_name="",$column_id="",$column_name="",$check_name="",$selected="",$cond="")
{ 
	if($selected!="")
	$sel_array = explode(",",$selected);
	if($cond=="")
	$SQL="SELECT * FROM $table_name ORDER BY $column_name ASC";
	else
	$SQL="$cond";
	
	$rs=mysql_query($SQL) or die(mysql_error());
	$checklist="";
	while($data = mysql_fetch_assoc($rs))
	{
		if(in_array($data[$column_name],$sel_array))
		{
			$checklist .= "<input type='checkbox' value='$data[$column_name]' name='$check_name' CHECKED>$data[$column_name]<br>";
		}
		else
		{
			$checklist .= "<input type='checkbox' value='$data[$column_name]' name='$check_name'>$data[$column_name]<br>";
		}
	}
	return $checklist;
}
################################################################## function for get income from tables
function get_income_ammount($table_name,$col_name,$cond) 
{
  $sql="select sum($col_name) from $table_name $cond";

  $res=mysql_query($sql) or die(mysql_error());
  $row=mysql_num_rows($res);
  if($row>0)
  {
	 $dd=mysql_fetch_assoc($res);
	 return $dd["sum($col_name)"];
 }
 else
 {
 return 0;
 }
}
################################################################## function for max id or serial no.
function getmax_serial_no($table,$col_id,$cond)
{
  $sql="select max($col_id) from $table $cond";
  $rs=mysql_query($sql) or die(mysql_error());
  if(mysql_num_rows($rs))
  {
	$data=mysql_fetch_assoc($rs);
	
	$max=$data["max($col_id)"];
	return ++$max;
  }
  else
  {
  return "1";
  }
}
################################################################## function for fetch single field value from table
function get_value_new($table_name,$col_name,$con)
{
 $sql="select $col_name from $table_name $con";
 $rs=mysql_query($sql) or die(mysql_error());
 $data=mysql_fetch_assoc($rs) or die(mysql_error());
 return $data[$col_name]; 
} 
################################################################## function for fetch single field value from table
function get_value($table_name,$col_name,$con)
{
 $sql="select $col_name from $table_name $con";
 $rs=mysql_query($sql) or die(mysql_error());
 $data=mysql_fetch_assoc($rs) or die(mysql_error());
 return $data[$col_name]; 
} 
################################################################## function for max id or serial no.
function getmaxid_new($table,$col_id,$con="")
{
  $sql="select max($col_id) from $table $con";
  $rs=mysql_query($sql) or die(mysql_error());
  if(mysql_num_rows($rs))
  {
	$data=mysql_fetch_assoc($rs);
	
	$max=$data["max($col_id)"];
	return ++$max;
  }
  else
  {
  return "1";
  }
}
################################################################## function for return controls
function return_control_function($Request)
{
$req='';
foreach($Request as $k=>$v)
  {
   $req.="&".$k."=".$v;
  }
  return $req;

}
################################################################## function for find total record in a tables
function get_total_record($table_name,$cond="")
{
  if($cond!='')
  {
  $sql="select * from $table_name $cond";
  }
  else{
  $sql="select * from $table_name";
  }
  //echo $sql; die;
  $rs=mysql_query($sql) or die(mysql_error());
  if(mysql_num_rows($rs))
  return mysql_num_rows($rs);
}
################################################################## function for check login
function global_login($table_name='',$cond='')
{
   $sqllogin="select * from $table_name $cond";
   $rslogin=mysql_query($sqllogin) or die(mysql_error());
   if(mysql_num_rows($rslogin)>0)
   {
     return true;
   }
   else
   {
     return false;
   }
}
################################################################## function for check record
function sqlCheckRecord($data)
{
  $sqlcheck=mysql_query($data) or die(mysql_error());
  if(mysql_num_rows($sqlcheck)>0)
  $rscheck=mysql_fetch_assoc($sqlcheck);
  else
  $rscheck=false;
  return $rscheck;
}
################################################################## function for executing the query
function insertQuery($data,$id='')
{
  $resultset=mysql_query($data) or die(mysql_error());
  if($id=='')
  $currentid=mysql_insert_id($resultset);
  else
  $currentid=$id;
    
  return $currentid;
}

?>