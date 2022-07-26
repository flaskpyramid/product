<?php
ini_set("display_errors","on");
ini_set("error_reporting",E_ALL & ~E_NOTICE);
require_once("dbclass.php");
$sql=new MySQL_class();
$sql->Create("admin_training");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(isset($_POST['save']))
{
	$id=$_POST["id"];
	$proname=$_POST["proname"];
	$prosku=$_POST["prosku"];
	$proprice=$_POST["proprice"];
	$category=$_POST["category"];
	
	if((isset($id)) && ($id!=""))
	{
		$query="update category44 set proname='".$proname."',prosku='".$prosku."',proprice='".$proprice."',category='".$category."' where id='".$id."'";
		$sql->Update($query);
	}
	else
	{
		$query="insert into category44 set proname='".$proname."',prosku='".$prosku."',proprice='".$proprice."',category='".$category."'";
		$sql->Insert($query);
	}
	header("Location:productclaslist.php");
}
$id=$_GET['id'];
if((isset($id)) && ($id!=""))
{
$qry="select category44.*, category22.catname from category44 left join category22 on category44.id= category22.id where id='".$id."'";
$sql->QueryRow($qry);
$row=$sql->data;
}
?>
<form method="post" action="">
<table>
<tr>
		<td>Product Name</td>
		<td><input type="text" name="proname" id="proname" value="<? echo $row['proname'];?>"></td>
</tr>
<tr>
		<td>Product SKU</td>
		<td><input type="text" name="prosku" id="prosku" value="<? echo $row['prosku'];?>"></td>
</tr>
<tr>
		<td>Product Price</td>
		<td><input type="text" name="proprice" id="proprice" value="<? echo $row['proprice'];?>"></td>
</tr>
<tr>
		<td> Category:</td>
		<?
		$qry1="select * from category22";
		$sql->Query($qry1);
		$rowno=$sql->rows;
		?>
		<td><select name="id" id="id">
		<?
		if((isset($id)) && ($id!=""))
		{
			$qry="select category44.*,category22.catname from category44 left join category22 on category44.id= category22.id where id='".$id."'";
			$sql->Query($qry);
			$rows=$sql->data;
		
		?>
		<option value="<? echo $rows['id'];?>"><? echo $rows['catname'];?></option>
		<?
		}
		else
		{
			for($i=0;$i<$rowno;$i++)
			{
				$sql->Fetch($i);
				$rowss=$sql->data;
				?>
				<option value="<? echo $rows['id'];?>"><?php echo $rows['catname'];?></option>
				<?
			}
		}
		?>
		</select>
		</td>
</tr>
<tr>
		<td colspan="2"><center>
		<input type="hidden" name="id" value="<?php echo $rows['id'];?>">
		<?php
		if((isset($id))  &&  ($id!=""))
		{
		?>
		<input type="submit" name="save" value="Update">
		<?
		}
		else
		{
			?>
		<input type="submit" name="save" value="insert">
		<?
		}
		?>
		</center>
		</td>
</tr>
</table>
</form>
</body>
<html>