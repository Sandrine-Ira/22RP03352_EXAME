<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:index.php');
}
	if(isset($_SESSION['username'])){
	echo "welcome user ".$_SESSION['username'];
}
	
include("connection.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<p><button><a href="logout.php">logout</a></button></p>
<table border="1">
	<tr>
		<th>id</th>
	<th>employee_name</th>
	<th>email</th>
	<th>phone</th>
	<th>position</th>
	<th>adress</th>
	<th>time_created</th>
	<th colspan="2">action</th>
</tr>
<?php
$select="select*from employees";
$query=mysqli_query($conn,$select);
if($query){
	if(mysqli_num_rows($query)>0){
		while($get=mysqli_fetch_array($query)){
		echo"<tr><td>".$get['id']."</td><td>".$get['employee_name']."</td><td>".$get['email']."</td><td>".
		$get['phone']."</td><td>".$get['position']."</td><td>".$get['address']."</td><td>".$get['created_at']."</td>";
		echo"<td><a href='update.php?id=".$get['id']."'>update</a>";
		echo"<td><a href='delete.php?id=".$get['id']."'>delete</a>";
	}
	}
	else{
		echo "<tr><td colspan='8'>no row in table</td</tr>";
	}
}
?>
</table>
click<a href="insert.php">here</a>to insert new record
</body>
</html>