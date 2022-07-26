
<?php
ini_set("display_errors","1");
ini_set ("error_reporting",E_ALL & ~E_NOTICE);
require_once("dbclass.php");

$sql =new MySQL_class();
$sql->Create("admin_training");

$id=$_GET['id'];
$action=$_GET['action'];
if((isset($action)) && ($action=="delete"))
{
	$dquery="delete from namereg where id='".$id."'";
	$sql->Delete($dquery);
	header("location:reginlist.php");
}
?>
<html>
<head><title>View Customers</title>
</head>
<body>
<center>
<h1>Customer Details</h1>
<table border='1'>
<tr>
		<th>First Name</th>
		<th>Last name</th>
		<th>Age</th>
		<th>Username</th>
		<th>Password</th>
		<th>Edit</th>
		<th>Delete</th>
</tr>
<?php
$query="select * from namereg ";
$sql->Query($query);
$rowno= $sql->rows;
for($i=0;$i<$rowno;$i++)
{
	$sql->Fetch($i);
	$rows=$sql->data;
?>
<tr>
		<td><? echo $rows['firstname']?></td>
		<td><? echo $rows['lastname']?></td>
		<td><? echo $rows['age']?></td>
		<td><? echo $rows['username']?></td>
		<td><? echo $rows['password']?></td>
		<td><a href="regin.php?id=<?php echo $rows["id"];?>">Edit</a></td>
		<td><a href="reginlist.php?id=<?php echo $rows["id"];?>&action=delete">Delete</a></td>
</tr>
<?php
}
?>
</table>
<center>
</body>

</html>