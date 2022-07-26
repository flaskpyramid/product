<?php
ini_set("display_errors","1");
ini_set("error_reporting",E_ALL & ~E_NOTICE);
require_once("dbclass.php");

$sql=new MySQL_class();
$sql->Create("admin_training");

$id=$_GET['id'];
$action=$_GET['action'];
if((isset($action)) && ($action=="delete"))
{
	$dquery="delete from category44 where id='".$id."'";
	$sql->Delete($dquery);
	header("location:productclaslist.php");
}
?>
<!DOCTYPE html>
<html>
<body>
<table border="1">
<tr>
	<td>Product Name:</td>
	<td>Product SKU:</td>
	<td>Product Price</td>
	<td>Category</td>
	<td>Edit</td>
	<td>Delete</td>
</tr>
<?
$query="select category44.*,category22.catname from category44 left join category22 on category44.id=category22.id";
$sql->Query($query);
$rowno=$sql->rows;
for($i=0;$i<$rowno;$i++)
{
	$sql->Fetch($i);
	$rows=$sql->data;
?>
<tr>
	<td><? echo $rows['proname'];?></td>
	<td><? echo $rows['prosku'];?></td>
	<td><? echo $rows['proprice'];?></td>
	<td><? echo $rows['catname'];?></td>
	<td><a href="productclas.php?id=<?php echo $rows["id"];?>">Edit</a></td>
	<td><a href="productclaslist.php?id=<?php echo $rows["id"];?>&action=delete">Delete</a></td>
</tr>
<?
}
?>
</table>
</body>
</html>