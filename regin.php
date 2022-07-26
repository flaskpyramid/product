<?php
ini_set("display_errors","on");
ini_set("error_reporting",E_ALL & ~E_NOTICE);
require_once("dbclass.php");

$sql =new MySQL_class();
$sql->Create("admin_training");

?>
<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<script type="text/javascript">
function validation()
{
	if(document.getElementById("firstname").value=="")
	{
		alert("First Name cannot be blank.");
		return false;
	}
	if(document.getElementById("lastname").value=="")
	{
		alert("Last Name cannot be blank.");
		return false;
	}
	if(document.getElementById("age").value=="")
	{
		alert("Age cannot be blank.");
		return false;
	}
	if(document.getElementById("username").value=="")
	{
		alert("User Name cannot be blank.");
		return false;
	}
	if(document.getElementById("password").value=="")
	{
		alert("Password cannot be blank.");
		return false;
	}
}
</script>

</head>
<body>
<?php
if(isset($_POST['save']))
{
	$id=$_POST["id"];
	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$age=$_POST["age"];
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	if((isset($id)) && ($id!=""))
	{
		$query="update namereg set firstname='".$firstname."',lastname='".$lastname."',age='".$age."',username='".$username."',password='".$password."' where id='".$id."'";
		$sql->Update($query);
	}
	else
	{
		$query="insert into namereg set firstname='".$firstname."',lastname='".$lastname."',age='".$age."',username='".$username."',password='".$password."'";
	
		$sql->Insert($query);
	}
	header("Location:reginlist.php");
}
$id=$_GET['id'];
$qry="select *from namereg where id='$id'";
$sql->QueryRow($qry);
$row = $sql->data;
?>
<center>
<form method="post" action="" onsubmit="return validation();">
<table>
<tr>
	<td colspan="2"><center>form</center></td>
</tr>
<tr>
	<td>First Name</td><td><input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname'];?>"></td>

</tr>
<tr>
	<td>Last Name</td><td><input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname'];?>"></td>

</tr>
<tr>
	<td>Age</td><td><input type="text" name="age" id="age" value="<?php echo $row['age'];?>"></td>

</tr>
<tr>
	<td>User Name</td><td><input type="text" name="username" id="username" value="<?php echo $row['username'];?>"></td>

</tr>
<tr>
	<td>Password</td><td><input type="password" name="password" id="password" value="<?php echo $row['password'];?>"></td>

</tr>
<tr>
	<td colspan="2"><center>
	<input type="hidden" name="id" value="<?php echo $row['id'];?>">
	<?php
		if((isset($id)) && ($id!=""))
		{
?>
			<input type="submit" name="save" value="Update" >
			<?php
		}
		else
		{
			?>
			<input type="submit" name="save" value="save">
		<?php
		}
		?>
			
		
	
	</center>
	</td>
</tr>
</table>
</center>

</body>
</html>