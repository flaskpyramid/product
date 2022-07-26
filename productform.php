<?
$con=mysqli_connect("localhost","admin_training","admin_training","admin_training");
if((isset($_POST['save'])) && ($_POST['save']=="insert"))
{
	if(mysqli_connect_errno())
		echo "failed to connect to Mysql".mysqli_connect_errno();
	else
	{
		$query="insert into product1 set pname='".$_POST['pname']."',psku='".$_POST['psku']."',price='".$_POST['price']."',catid='".$_POST['cat']."'";
		//echo "Product Name : ".$_POST['pname']."<br/> Product SKU :".$_POST['psku']."<br/> Product Price :".$_POST['price']."<br/> Product Category :".$_POST['cat'];
		
		mysqli_query($con,$query);
	}
	if((mysqli_affected_rows($con))>0)
		{
			header("location:productlisting.php");
			/* echo $catdata['catid'];
			echo $catdata['catname']; */
		}
		else
		{
			echo "not inserted";
		}
		
	exit;
}
if(isset($_POST['send']) && ($_POST['send']=="update"))

	{
		$pid=$_POST['pid'];
		$pname=$_POST['pname'];
		$psku=$_POST['psku'];
		$price=$_POST['price'];
		$catid=$_POST['catid'];
		
		
		$qry="UPDATE product1 set pname='".$pname."',psku='".$psku."',price='".$price."',catid='".$catid."' where pid='".$pid."'";
		$result=mysqli_query($con,$qry);
		if((mysqli_affected_rows($con))>0)
		{
			header("location:productlisting.php");
		}
		else
		{
			echo "not updated";
		}
		
		//print_r($_POST);
		exit;
	}
	$pid=$_GET['pid'];
	if((isset($pid)) && ($pid!=""))
		{
			//$qry="SELECT * from product1 where pid='".$pid."'";
			$qry = "select product1.*, category1.catname from product1 left join  category1 on product1.catid= category1.catid where pid='" . $pid . "'";
			$result=mysqli_query($con,$qry);
			$proddata=mysqli_fetch_assoc($result);
			
		}
		
?>
<!DOCTYPE html>
<html>
<body>
<form method="post" action="">
<table>
<tr>
<td>  Product Name:</td>
 <td> <input type="hidden" name="pid" id="pid" value="<? echo $proddata['pid'];?>"/>
 <input type="text" name="pname" id="pname" value="<? echo $proddata['pname'];?>"><br/> </td>
 </tr>
<tr> <td>Product SKU: </td>
 <td> <input type="text" id="psku" name="psku" value="<? echo $proddata['psku'];?>"><br/> </td>
 </tr>
 <td>  Product Price:</td>
 <td> <input type="text" name="price" id="price" value="<? echo $proddata['price'];?>"><br/> </td>
 </tr>
 <td>  Category:</td>
 <?
	$qry1="SELECT * from category1";
	$res=mysqli_query($con,$qry1);
	$rescnt=mysqli_num_rows($res);
	?>
 <td> <select name="catid" id="catid">
 
	<?
	if((isset($pid)) && ($pid!=" "))
	{
	$qry = "select product1.*, category1.catname from product1 left join  category1 on product1.catid= category1.catid where pid='" . $pid . "'";
	$result=mysqli_query($con,$qry);
	$cdata=mysqli_fetch_assoc($result);
	
		$catdata = mysqli_fetch_array($res);
		
		?>
			
  <option value="<? echo $cdata['catid']; ?>" selected /> <?php echo $cdata['catname']; ?> </option>
  <?
	
	}
else
	{
	for($i=0;$i<$rescnt;$i++)
	{
		$catdata = mysqli_fetch_array($res);
		
		?>
			
  <option value="<? echo $catdata['catid']; ?>"  /> <?php echo $catdata['catname']; ?> </option>
  <?
	}
	}
	?>
</select><br/> </td>
 </tr>
 <tr>
<td colspan="2" align="center">
<?php
if((isset($pid)) && ($pid!=" "))
{
?>
<input type="submit" name="send" value="update"/>
<?
}
else
{
?>
	<input type="submit" name="save" value="insert"/>
<?
}
 
?>
</td>
</tr>
 </table>
</form>
</body>
</html>