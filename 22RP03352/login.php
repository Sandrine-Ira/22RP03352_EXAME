<?php
session_start();
$err="";
if ($_SERVER['REQUEST_METHOD']=="POST") {
	$uname=$_POST['uname'];
	$pass=$_POST['pass'];
	$remember=isset($_POST['rememberme']);
	if(empty($uname) || empty($pass)){
		$err="please fill all field";
	}
	else{
		include("connection.php");
		$select="select*from users where username='$uname'";
		$query=mysqli_query($conn,$select);
		if($query){
			if(mysqli_num_rows($query)>0){
				$get=mysqli_fetch_array($query);
				$upass=$get['password'];
				$uuname=$get['username'];
				if($pass==$upass){
                 $_SESSION['username']=$uname;
                 if($remember){
                 	setcookie("rememberme",$uname,time() + 86400 * 7,"/");
                 }
                 else{
                 	setcookie("rememberme"," ",time() -3600,"/");
                 }
			 header("location:select.php");
exit;
				}
				else{
$err="invalid password";
				}

			}
			else{
				$err="no user found please contact administrator";
			}
		}
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table>
<form method="post">
<tr><td colspan="2" style="text-align:center;"><h3>fill the form to login</h3></td></tr>
<tr><td>username</td>
<td><input type="text" name="uname" value="<?php echo isset($uname)?$uname:"";?>"></td>
</tr>
<tr><td>password</td>
<td><input type="password" name="pass"></td>
</tr>
<tr><td colspan="2" style="text-align: center;"><input type="submit" name="login" value="login"></td></tr>
<tr><td colspan="2" style="text-align: center;"><input type="checkbox" name="rememberme" value="rememberme">remember me</td></tr>
</form>
</table>
<p style="color: red;"><?php echo $err?></p>
</body>
</html>