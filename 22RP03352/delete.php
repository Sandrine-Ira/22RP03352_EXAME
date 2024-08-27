<?php
$id=$_GET['id'];
include("connection.php");

$delete="delete from employees where id='$id'";
$query=mysqli_query($conn,$delete);
if ($query) {
	header('location:select.php');
}
else{
	echo "not exist";
}
?>