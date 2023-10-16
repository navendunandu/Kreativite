<?php
include("../Assets/Connection/connection.php");
//Insertion
if(isset($_POST["btn_submit"]))
{
	if($_POST["txt_update"]=="")
	{
		$insertSubQuery = "insert into tbl_subcategory(subcategory_name,category_id) value('".$_POST["subcategory"]."','".$_POST["category"]."')";
		if($con->query($insertSubQuery))
		{
			echo "Insertion Success";
		}
		else
		{
			echo "Insertion Failed";
		}
	}
	else
	{
		$update="update tbl_subcategory set subcategory_name='".$_POST["subcategory"]."' where subcategory_id='".$_POST["txt_update"]."'";
		$con->query($update);
		header("location:Subcategory.php");
	}
}

//Deletion

if(isset($_GET["DelId"]))
{
	$delSubQuery = "delete from tbl_subcategory where subcategory_id='".$_GET["DelId"]."'";
	if($con->query($delSubQuery))
	{
		echo "Deletion Success";
	}
	else
	{
		echo "Deletion Failed";
	}
}

//Updation
$ename = "";
$eid="";
if(isset($_GET["edit"]))
{
	$selquery1 = "select * from tbl_subcategory where subcategory_id='".$_GET["edit"]."'";
	$row1 = $con->query($selquery1);
	$data1= $row1->fetch_assoc(); 
	$ename = $data1["subcategory_name"];
	$eid = $data1["subcategory_id"];
	
}

?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form method="POST">
	<table border="2">
    	<tr>
        	<td>Choose Category</td>
            <td>
            	<select name="category" id="category">
                	<option value=" ">Choose a category</option>
                    <?php
					$selCategoryQuery = "select * from tbl_category";
					$categoryData = $con->query($selCategoryQuery);
					while($category =$categoryData->fetch_assoc())
					{
					?>
                    <option value="<?php echo $category["category_id"]?>"><?php echo $category["category_name"]?></option>
                    <?php
					}
					
					?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Subcategory</td>
            <td>
            	<input type="text" name="subcategory" id="sub-category" value="<?php echo $ename?>" />
                  <input type="hidden" name="txt_update" id="txt_update" value="<?php echo $eid?>" />
            </td>
        </tr>
        <tr>
        	<td>
            	<input type="submit" value="Submit" name="btn_submit" id="btn_submit" />
            </td>
            <td>
            	<input type="reset" value="Reset" name="btn_reset" id="btn_reset" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>

<table border="2" align="center">
	<tr>
    	<td>S.No</td>
        <td>Subcategory</td>
        <td>Action</td>
    </tr>
<?php
$i=0;
$selSubcategoryQuery = "select * from tbl_subcategory";
$subCatData = $con->query($selSubcategoryQuery);
while($subCatRow = $subCatData->fetch_assoc())
{
	$i++

?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $subCatRow["subcategory_name"]?></td>
<td><a href="Subcategory.php?DelId=<?php echo $subCatRow["subcategory_id"]?>">Delete</a> | <a href="Subcategory.php?edit=<?php echo $subCatRow["subcategory_id"]?>">Edit</a></td>
</tr>


<?php } ?>