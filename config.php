<?php
error_reporting(0);
ob_start();
session_start();
$TransactionTypeArray=array('','Cash','Debit / Credit Card','Net Banking','NEFT','Cheque','RTGS');
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            // this is HTTPS
            $protocol  = "https";
        } else {
            // this is HTTP
            $protocol  = "http";
        }
$api_url="https://timesheet-1172.appspot.com/a61e70a1/notes";
if($_SERVER['HTTP_HOST']=='localhost:8080'){
$host=mysql_connect("localhost","root","") or die(mysql_error());
$db=mysql_select_db('notes') or die(mysql_error());

$path=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';
$admin_path=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';
$url=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';

}
else{
$host=mysql_connect("localhost","smbnidhi_notes","9140754281") or die('Connection error '.mysql_error());
$db=mysql_select_db('smbnidhi_notes') or die('Database Connection error '.mysql_error());
$path=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';
$admin_path=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';
$url=$protocol.'://'.$_SERVER['HTTP_HOST'].'/notes/';

}
date_default_timezone_set("Asia/Kolkata");
/*
  md5 user as md5('payment'),md5(fr_id),md5(dc_id),md5(dc_orderid),md5(fr_orderid),md5('confired'),
  
*/


##################################################################
$sqlsite="select * from tbl_site where site_id='1'";
$rssite=mysql_query($sqlsite) or die(mysql_error());
$sitedata=mysql_fetch_assoc($rssite);


##################################################################
function get_client_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

	return $ipaddress;
	
}
################################################################## check outsider url target
function check_access_url($request_from_server,$this_server){
	if (strpos($request_from_server, $this_server) !== false) {
		return true;
	}else{
		header("Location:$request_from_server?msg=Invalid Request...!");
		exit;
	}
	
}
##################################################################
function check_special_char($data)
{
  $return=array();
  foreach($data as $k=>$v)
  {
   $return[$k]=mysql_real_escape_string($v);
  }
  return $return;
}

################################################################
function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
    // Length of character list
    $chars_length = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $chars_length)};
   
    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $chars_length)};
       
        // Make sure the same two characters don't appear next to each other
        if ($r != $string{$i - 1}) $string .=  $r;
    }
   
    // Return the string
    return $string;
}
##################################################################
function tstr($data, $len=13)
{
    $more="";
    if (strlen($data)>$len){$more=" ...";}
    return substr($data,0,$len).$more;
}
##################################################################


function AddNotes($api_url='',$title, $description){
$ch = curl_init();
$title1 = str_replace(' ','%20',$title);
$description1 = str_replace(' ','%20',$description);

curl_setopt($ch, CURLOPT_URL, "$api_url?title=$title1&description=$description1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{ 
  \"title\": \"$title\",
  \"description\": \"$description\"
 }");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json"
));

$response = curl_exec($ch);
if( ! $result = curl_exec($ch)){ 
  trigger_error(curl_error($ch)); 
} 
curl_close($ch);
return $response;
}

function EditNotes($api_url='',$id,$title, $description){
$ch = curl_init();
$title1 = str_replace(' ','%20',$title);
$description1 = str_replace(' ','%20',$description);

$ch = curl_init();
//echo "$api_url/$id?title=$title&description=$description";
curl_setopt($ch, CURLOPT_URL, "$api_url/$id?title=$title1&description=$description1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"title\": \"$title\",
  \"description\": \"$description\"
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json"
));

$response = curl_exec($ch);
curl_close($ch);
return $response;
}

function deleteNotes($api_url,$id){

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$api_url/$id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

echo $response = curl_exec($ch);
curl_close($ch);

return $response;
}

?>
