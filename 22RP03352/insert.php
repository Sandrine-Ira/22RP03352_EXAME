<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:index.php');
}
$err=" ";

?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$position=$_POST['position'];
	$address=$_POST['address'];
	if(empty($name) || empty($email) || empty($phone) || empty($position) || empty($address)){
		$err="please fill all field";
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		$err="name only contain letters and numbers";
	}
	elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$err="please insert valid email";
	}
	elseif(strlen($phone)!==10 || !is_numeric($phone)){
		$err="phone number contaion only 10 numbers";
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $address)) {
		$err="address only contain letters and numbers";
	}
	elseif (!preg_match("/^[a-zA-Z]*$/", $position)) {
		$err="position only contain letters";
	}
	else{
		$name=test($name);
	$email=test($email);
	$phone=	test($phone);
	$position=test($position);
	$address=test($address);
		include("connection.php");
		$insert="insert into employees(employee_name,email,phone,position,address)values('$name','$email','$phone','$position','$address')";
		$query=mysqli_query($conn,$insert);
		if ($query) {
		header('location:select.php');
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
	<button><a href="select.php">back</a></button>
<table>
	<form method="post">
		<tr><td colspan="2"><h3>INSERT EMPLOYEE INFORMATION</h3></td></tr>
		<tr><td>employee_name</td><td><input type="text" name="name" value="<?php echo isset($name)?$name:""; ?>"></td></tr>
		<tr><td>email</td><td><input type="text" name="email"value="<?php echo isset($email)?$email:""; ?>"></td></tr>
		<tr><td>phone</td><td><input type="text" name="phone" value="<?php echo isset($phone)?$phone:""; ?>"></td></tr>
<tr><td>position</td><td><input type="text" name="position" value="<?php echo isset($position)?$position:""; ?>"></td></tr>
<tr><td>address</td><td><input type="text" name="address" value="<?php echo isset($address)?$address:""; ?>"></td></tr>
<tr><td colspan="2" style="text-align: center;"><input type="submit" name="insert" value="insert"></td></tr>
	</form>
</table>
<p style="color: red;"><?php echo $err ?></p>
</body>
</html>
<?php
function test($data){
	$data=htmlspecialchars($data);
	$data=stripslashes($data);
	$data=trim($data);
	return $data;
}
?>
