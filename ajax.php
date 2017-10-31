<?php
include_once("include/config.php");
//include_once("../includes/function.php");
if(!empty($_REQUEST['ajax_p_m_id']))
{
  $sqlcourse="select * from tbl_sub_menu where s_m_id='".$_REQUEST['ajax_p_m_id']."'";
  $rscourse=mysql_query($sqlcourse) or die(mysql_error());
  $list="<option value='0'>-Select Course-</option>";
  while($course=mysql_fetch_assoc($rscourse))
  {
    $list.="<option value='$course[s_id]'>$course[s_title]</option>";
  }
  if($list!='')
  echo $list;
  else
  echo'Error';
}
?>