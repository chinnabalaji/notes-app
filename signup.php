<?php
 include_once("include/config.php"); 
 include_once("include/function.php"); 
 $error='';
 if ( isset($_POST['act']) && $_POST['act']=='CreateAccount') {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['us_name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['user_login']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['us_password']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// basic name validation
		if (empty($name)) {
			
			$error = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			
			$error = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		
			$error = "Name must contain alphabets and space.";
		}		 
		else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			
			$error = "Please enter valid email address.";
		}
		else if (empty($pass) ) {
			
			$error = "Please enter password.";
		}
		else if (strlen($pass)<6 ) {
			
			$error = "Password must have atleast 6 characters.";
		} 
		
		// password encrypt using SHA256();
		
		
		// if there's no error, continue to signup
		if( $error =='') {
			$password = hash('sha256', $pass);
			$sqlQuery="select * from admin where user_name='$email'";
			$rsQuery=mysql_query($sqlQuery) or die($sqlQuery.' '.mysql_error());
			if(mysql_num_rows($rsQuery)<1){
				$query = "INSERT INTO admin(name,user_name,password,status) VALUES('$name','$email','$pass','Y')";
				$res = mysql_query($query);
				$userIds=mysql_insert_id();	
				if ($res) {
				    $error="Account has been created.";
			        echo"<script>alert('$error');</script>";
					unset($name);
					unset($email);
					unset($pass);
					echo"<script>window.location='signup.php';</script>";
				} else {
					
					$error="Something went wrong, try again later...";
			        echo"<script>alert('$error');</script>";
				}
		   }
		   else{
		    $error='Email allready exist.';
			echo"<script>alert('$error');</script>";
		   }	
				
		}
	   else{
		
		echo"<script>alert('$error');</script>";
	   }	
				
		
	}
 ?>
 <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Notes Panel :</title>
	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<style>
  body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background-color:#0099FF;
  //background: url("http://i.imgur.com/HgflTDf.jpg") 50% fixed;
  background-size: cover;
}

@keyframes spinner {
  0% {
    transform: rotateZ(0deg);
  }
  100% {
    transform: rotateZ(359deg);
  }
}
* {
  box-sizing: border-box;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
  background: rgba(4, 40, 68, 0.85);
}

.login {
  border-radius: 2px 2px 5px 5px;
  padding: 10px 20px 20px 20px;
  width: 90%;
  max-width: 320px;
  background: #ffffff;
  position: relative;
  padding-bottom: 80px;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
}
.login.loading button {
  max-height: 100%;
  padding-top: 50px;
}
.login.loading button .spinner {
  opacity: 1;
  top: 40%;
}
.login.ok button {
  background-color: #8bc34a;
}
.login.ok button .spinner {
  border-radius: 0;
  border-top-color: transparent;
  border-right-color: transparent;
  height: 20px;
  animation: none;
  transform: rotateZ(-45deg);
}
.login input {
  display: block;
  padding: 15px 10px;
  margin-bottom: 10px;
  width: 100%;
  border: 1px solid #ddd;
  transition: border-width 0.2s ease;
  border-radius: 2px;
  color: #ccc;
}
.login input + i.fa {
  color: #fff;
  font-size: 1em;
  position: absolute;
  margin-top: -47px;
  opacity: 0;
  left: 0;
  transition: all 0.1s ease-in;
}
.login input:focus {
  outline: none;
  color: #444;
  border-color: #2196F3;
  border-left-width: 35px;
}
.login input:focus + i.fa {
  opacity: 1;
  left: 30px;
  transition: all 0.25s ease-out;
}
.login a {
  font-size: 0.8em;
  color: #2196F3;
  text-decoration: none;
}
.login .title {
  color: #444;
  font-size: 1.2em;
  font-weight: bold;
  margin: 10px 0 30px 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
}
.login button {
  width: 100%;
  height: 100%;
  padding: 10px 10px;
  background: #2196F3;
  color: #fff;
  display: block;
  border: none;
  margin-top: 20px;
  position: absolute;
  left: 0;
  bottom: 0;
  max-height: 60px;
  border: 0px solid rgba(0, 0, 0, 0.1);
  border-radius: 0 0 2px 2px;
  transform: rotateZ(0deg);
  transition: all 0.1s ease-out;
  border-bottom-width: 7px;
}
.login button .spinner {
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  border: 4px solid #ffffff;
  border-top-color: rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  left: 50%;
  top: 0;
  opacity: 0;
  margin-left: -20px;
  margin-top: -20px;
  animation: spinner 0.6s infinite linear;
  transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
}
#submit
{
display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  border: 4px solid #ffffff;
  border-top-color: rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  left: 50%;
  top: 0;
  opacity: 0;
  margin-left: -20px;
  margin-top: -20px;
  animation: spinner 0.6s infinite linear;
  transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
}
.login:not(.loading) button:hover {
  box-shadow: 0px 1px 3px #2196F3;
}
.login:not(.loading) button:focus {
  border-bottom-width: 4px;
}

footer {
  display: block;
  padding-top: 50px;
  text-align: center;
  color: #ddd;
  font-weight: normal;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
  font-size: 0.8em;
}
footer a, footer a:link {
  color: #fff;
  text-decoration: none;
}
</style>
</head>

<body>
 <div class="wrapper">
 <?php if($_REQUEST['msg']){?><p><?php echo $_REQUEST['msg'];?></p><?php } ?>
 
  <form name="signup" id="signup" class="login" action="signup.php" method="post">

    <p class="title">Create New Account </p>
	<input type="test" name="us_name" id="us_name"  size="28" class="input" required autocomplete="off" placeholder="User name." value="<?php echo $name;?>"/>
    <i class="fa fa-user"></i>
     <input type="email" name="user_login" id="user_login" placeholder="Email ID.!"  size="28" class="input" autofocus required autocomplete="off" value="<?php echo $email;?>"/>
    <i class="fa fa-user"></i>
    <input type="password" name="us_password" id="us_password"  size="28" class="input" required autocomplete="off" placeholder="Type your password.!"/>
    <i class="fa fa-key"></i>
	
    <a href="<?php echo $url;?>" id="">If you have an account <strong>Login</strong>?</a>
    <button>
      <i class="spinner"></i>
      <span class="state">SignUp</span>
    </button>
	
	<!--	 <input name="submit" type="submit" value="Log In" id="" class="login button spinner" />-->
	 <input type="hidden" name="act" value="CreateAccount">
  </form>
    </p>
  
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/login.js"></script>

</body>
</html>
