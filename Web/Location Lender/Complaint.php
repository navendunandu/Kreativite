<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
    $insQry = "insert into tbl_complaint(complaint_title,complaint_content,lender_id,hiring_id,complaint_from) values('".$_POST["complaint-title"]."','".$_POST["complaint-content"]."','".$_SESSION["lid"]."','".$_GET["complaintId"]."','Lender')";
    if($con->query($insQry))
    {
        echo "Complaint Submitted";
    }
    else
    {
        echo "Complaint Failed";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
</head>
<body>
<div class="container mt-5">
        <form method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="complaint-title">Complaint Title</label>
                <input required type="text" class="form-control" id="complaint-title" name="complaint-title">
                <div class="invalid-feedback">Please fill this field</div>
            </div>
            <div class="form-group">
                <label for="complaint-content">Complaint Content</label>
                <textarea required class="form-control" id="complaint-content" name="complaint-content" rows="5" oninput="textval()"></textarea>
                <span id="target"></span>
                <div class="invalid-feedback">Please fill this field</div>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
            <button type="reset" class="btn btn-secondary" name="btn_reset">Reset</button>
        </form>


        
    
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

        function textval()
        {
            const area =document.querySelector("#complaint-content")
            let target =document.querySelector("#target");
            let count =area.value.length
            target.textContent =`${count}/100`
        }
    </script>
</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>