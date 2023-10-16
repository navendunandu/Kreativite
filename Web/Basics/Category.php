<?php

include("../Assets/Connection/connection.php");



if(isset($_POST["btnsave"]))
{
		$insQry = "insert into tbl_category(category_name)values('".$_POST["txtCategory"]."')";
		if($con->query($insQry))
		{
				echo "Value Inserted";
		}
		else
		{
				echo "Insertion Failed";
		}
}


if(isset($_GET["delID"]))
{
		$delQry = "delete  from  tbl_category where category_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
				echo "Value Deleted";
				header("location:Category.php");
		}
		else
		{
				echo "Deletion Failed";
		}
}


	
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kreativite::Category</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="399" height="86" border="1" align="center">
    <tr>
      <td>Category Name</td>
      <td><label for="txtCategory"></label>
      <input type="text" name="txtCategory" id="txtCategory" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnsave" id="btnsave" value="Save" />
      <input type="reset" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<br />

<table border="1" align="center">
	<tr>
    	<th>SI NO</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    
    <?php
	
			$i=0;
			$selQry="select * from tbl_category";
			$data=$con->query($selQry);
			while($row=mysqli_fetch_array($data))
			{
				$i++;	
	?>
			<tr>
    				<td><?php echo $i?></td>
       				<td><?php echo $row["category_name"]?></td>
        			<td><a href="Category.php?delID=<?php echo $row["category_id"]?>">Delete</a>
    		</tr>
      <?php
	  
			}
			
	   ?>