<?php

$con=mysqli_connect("localhost","admin_training","admin_training","admin_training");
if(mysqli_connect_errno())
{
	echo "failed to connect to MYSQL:".mysqli_connect_errno();
}
else
{	
	//$query	= "select * from product1";
	$query	= "select product1.*, category1.catname from product1 left join category1 on product1.catid=category1.catid ";
	$result	= mysqli_query($con,$query);
	$rescnt	= mysqli_num_rows($result);
	
	
	/* echo "<pre>";
	print_r($resutlar);
	echo "</pre>"; */
} 
$pid=$_GET['pid'];
$action=$_GET['action'];

if((isset($action))&& ($action=="delete"))
{
	$dquery = "delete from product1 where pid='".$pid."'";
	mysqli_query($con,$dquery);
	header("location:productlisting.php");
}


?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<table border="1">
	<tr>
		<td>Product Name</td>
		<td>Product SKU</td>
		<td>Product Price</td>
		<td>Category Name</td>
	</tr>
	<?
	for($i=0;$i<$rescnt;$i++)
	{
		$resutlar = mysqli_fetch_array($result);
	?>
		<tr>
			<td><? echo $resutlar['pname']; ?></td>
			<td><? echo $resutlar['psku']; ?></td>
			<td><? echo $resutlar['price'];?></td>
			<td><? echo $resutlar['catname']; ?></td>
			<td><a href="productform.php?pid=<? echo $resutlar['pid']; ?>">Edit</a></td>
			<td><a href="productlisting.php?pid=<? echo $resutlar['pid']; ?>&action=delete">Delete</a></td>
		</tr>
	<?
	}
	?>
	
</table>

</body>
</html>