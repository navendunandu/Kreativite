<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");


if (isset($_POST["btn_submit"])) {
    $insQry = "insert into tbl_complaint(complaint_title,complaint_content,hiring_id,lender_id,complaint_from) values('" . $_POST["complaint-title"] . "','" . $_POST["complaint-content"] . "','" . $_SESSION["hid"] . "','".$_GET["complaintId"]."','Hiring-team')";
    if($con->query($insQry))
    {
        echo "Success";
    }
    else
    {
        echo "Failed";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint-Hiring Team</title>
</head>

<body>
<div class="container">
        <form method="post" class="needs-validation" novalidate>
            <table class="table">
                <tr>
                    <td>Complaint Title</td>
                    <td>
                        <input required type="text" class="form-control" name="complaint-title">
                        <div class="invalid-feedback">Plese fill this field</div>
                    </td>
                </tr>
                <tr>
                    <td>Complaint Details</td>
                    <td>
                        <textarea required oninput="textval()" class="form-control" name="complaint-content" id="complaint-content" cols="30" rows="10" maxlength="100"></textarea>
                        <span id="target"></span>
                        <div class="invalid-feedback">Please fill this field</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-primary" value="Submit" name="btn_submit">
                    </td>
                    <td>
                        <input type="reset" class="btn btn-secondary" value="Reset" name="btn_reset">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</body>
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

</html>

<?php
ob_flush();
include("Foot.php");

?>