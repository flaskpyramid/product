<?php
ini_set("display_errors","on");
ini_set("error_reporting",E_ALL & ~E_NOTICE);
require_once("dbclass.php");

$sql = new MySQL_class();
$sql->Create("admin_training");
?>
<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<script type="text/javascript">
function validation()
{
	
	if(document.getElementById("productname").value=="")
	{
		
		alert("product name cannot be blank.");
		return false;
	}
	if(document.getElementById("productcode").value=="")
	{
		alert("product code cannot be blank.");
		return false;
	}
	if(document.getElementById("productdescription").value=="")
	{
		
		alert("description cannot be blank.");
		return false;
	}
}

</script>
</head>
<body>
<?php

if(isset($_POST['save']))
{
$product_id=$_POST['product_id'];

	if((isset($product_id)) && ($product_id!=""))
	{
		$query	="UPDATE tbl_product set productname='".$_POST['productname']."', productcode='".$_POST['productcode']."', productdescription='".$_POST['productdescription']."', categ_id='".$_POST['categ_id']."' where product_id='".$product_id."'";
				$sql->Update($query);
				 
	}
	else
	{
	     $query= "insert into tbl_product set productname='".$_POST['productname']."', productcode='".$_POST['productcode']."', productdescription='".$_POST['productdescription']."', categ_id='".$_POST['categ_id']."'";
	     $sql->insert($query);
	}
	header("Location: productlist.php"); 
}
$product_id=$_GET['product_id'];
$qry="select tbl_product.*,tbl_category.categname from tbl_product LEFT JOIN tbl_category ON tbl_product.categ_id = tbl_category.categ_id where tbl_product.product_id='$product_id'";
$sql->QueryRow($qry);
$row = $sql->data;



?>
<center>
<form method="post" action="" onsubmit="return validation();">
<table>
<tr><td colspan="2"><center>Form</center></td></tr>
<tr><td>Product Name</td><td><input type="text" name="productname" id="productname" value="<?php echo $row['productname'];?>" /></td></tr>
<tr><td>Product Code</td><td><input type="text" name="productcode" id="productcode" value="<?php echo $row['productcode'];?>"/></td></tr>
<tr><td>category</td><td>
<select name="categ_id"><option >select</option>
                            
<?php
if((isset($product_id)) && ($product_id!=""))
{
?>
	<option value ="<?php echo $row['categ_id'];?>" selected="selected"><? echo $row['categname']; ?></option>
<?
}
?>
<?php
$query="select * from tbl_category";
 $sql->Query($query);
 $rowno= $sql->rows;
                            for($i=0;$i<$rowno;$i++)
                            {
								$sql->Fetch($i);
								$rows=$sql->data; 
							 ?>
                        <option value ="<?php echo $rows['categ_id'];?>"><? echo $rows['categname']; ?></option>
							<?
							}
							?>
							
							
						 
<tr><td> <input type="hidden" name="category" id="category" value="<?php echo $row['categ_id'];?>"/>											  						
<tr><td>Description</td><td><input type="text" name="productdescription" id="productdescription" value="<?php echo $row['productdescription'];?>"/></td></tr>
<tr><td colspan="2"><center>
<input type="hidden" name="product_id" id="product_id" value="<?php echo $row['product_id'];?>"/>
<?php
	if((isset($product_id)) && ($product_id!=""))
	{
?>
		<input type="submit" name="save" value="Update">
		<?php
	}
	else
	{
		?>
		<input type="submit" name="save" value="Save">
		<?php
	}
		?>
<center>	
</td></tr>
</table>
</form>

</center>
</body>
</html>
