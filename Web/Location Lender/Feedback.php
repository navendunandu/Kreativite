<?php 
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
{
    $insQry = "insert into tbl_feedback(feedback_content,lender_id) values('".$_POST["feedback-content"]."','".$_SESSION["lid"]."')";
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
    <title>Feedback</title>
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center">Customer Feedback and Suggestions</h1>
        <p class="text-center">Help Us Grow with Your Valuable Feedback</p>
        <form method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="feedback">Enter your valuable insight</label>
                <textarea required class="form-control" name="feedback-content" id="feedback" rows="5" maxlength="100" oninput="textval()"></textarea>
                <span id="target"></span>
                <div class="invalid-feedback">Please Enter a Feedback</div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                <button type="reset" class="btn btn-secondary" name="btn_reset">Reset</button>
            </div>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('.needs-validation');

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            });
        });
        function textval()
        {
            const area =document.querySelector("#feedback")
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