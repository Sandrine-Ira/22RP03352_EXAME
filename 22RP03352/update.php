<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:index.php');
}
$id=$_GET['id'];
include("connection.php");
$select="select*from employees where id='$id'";
$query=mysqli_query($conn,$select);
if($query){
	$get=mysqli_fetch_array($query);
	$id=$get['id'];
	$name=$get['employee_name'];
	$email=$get['email'];
	$phone=$get['phone'];
	$position=$get['position'];
	$address=$get['address'];

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
		<tr><td colspan="2"><h3>UPDATE EMPLOYEE INFORMATION</h3></td></tr>
		<tr><td>employee_name</td><td><input type="text" name="name" value="<?php echo $name?>"></td></tr>
		<tr><td>email</td><td><input type="text" name="email" value="<?php echo $email?>"></td></tr>
		<tr><td>phone</td><td><input type="text" name="phone" value="<?php echo $phone?>"></td></tr>
<tr><td>position</td><td><input type="text" name="position" value="<?php echo $position?>"></td></tr>
<tr><td>address</td><td><input type="text" name="address" value="<?php echo $address?>"></td></tr>
<tr><td colspan="2" style="text-align: center;"><input type="submit" name="update" value="update"></td></tr>
	</form>
</table>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"  &&isset($_POST['update'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$position=$_POST['position'];
	$address=$_POST['address'];
	$update="update employees set employee_name='$name',email='$email',phone='$phone',position='$position',
	address='$address' where id='$id'";
	$query=mysqli_query($conn,$update);
if($query){
	header('location:select.php');
}
else{
	echo"failed to update";
}
	
} 
?>
</body>
</html>