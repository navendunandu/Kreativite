<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

//Insertion
if(isset($_POST["btn_submit"]))
{
	$photo = $_FILES["project-image"]["name"];
	$tmpPhoto = $_FILES["project-image"]["tmp_name"];
	move_uploaded_file($tmpPhoto,'../Assets/Files/Hiringteam/ProjectImg/'.$photo);
	
	$ins = "insert into tbl_projectdetails(project_title,project_details,project_image,hiring_id) values('".$_POST["project-title"]."','".$_POST["project-detail"]."','".$photo."','".$_SESSION["hid"]."')";
	
	if($con->query($ins))
	{
		echo "Project Added Successfully";
	}
	else
	{
		echo "Failed";
	}
}

//Delete
if(isset($_GET["delId"]))
{
	$delQry = "delete from tbl_projectdetails where project_id='".$_GET["delId"]."'";
	if($con->query($delQry))
	{
		echo "Deletion Success";
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
<title>Add Project</title>
</head>
<body>
	
<div class="container mt-5">
        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <table class="table table-bordered">
                <tr>
                    <td>Project Title:</td>
                    <td>
                        <input required type="text" name="project-title" id="project-title" class="form-control">
                        <div class="invalid-feedback">Please Fill this field</div>
                    </td>
                </tr>
                <tr>
                    <td>Project Details:</td>
                    <td>
                        <textarea required type="text" name="project-detail" id="project-detail" class="form-control"  pattern="[A-Za-z0-9\s,.]{1,50}"></textarea>
                        <div class="invalid-feedback">Requirement should not exceed 50 characters</div>
                    </td>
                </tr>
                <tr>
                    <td>Project Image:</td>
                    <td>
                        <input  type="file" name="project-image" id="project-image" class="form-control-file">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="btn_submit" value="Submit" id="btn_submit" class="btn btn-primary">
                    </td>
                    <td>
                        <input type="reset" name="btn_reset" id="btn_reset" value="Reset" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SI No</th>
                    <th>Project Name</th>
                    <th>Project Details</th>
                    <th>Project Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_projectdetails where hiring_id='".$_SESSION["hid"]."'";
                $selData = $con->query($selQry);
                while($row = $selData->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["project_title"] ?></td>
                    <td><?php echo $row["project_details"] ?></td>
                    <td><img src="../assets/files/Hiringteam/ProjectImg/<?php echo $row["project_image"]?>" width="100" /></td>
                    <td>
                        <a href="AddProject.php?delId=<?php echo $row["project_id"]?>" class="btn btn-danger">Delete</a>  <a href="ViewApplication.php?appId=<?php echo $row["project_id"] ?>" class="btn btn-primary">View Applications</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="./Feedback.php">Feedback</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded",function(){
            const form =document.querySelector(".needs-validation")
            form.addEventListener("submit",function(event){
                if(!form.checkValidity())
                {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add("was-validated")
            })
            
        })

        
    </script>
</body>
</html>


<?php
ob_flush();
include("Foot.php");

?>

