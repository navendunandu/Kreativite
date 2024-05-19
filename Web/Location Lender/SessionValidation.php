<?php 
if($_SESSION["lid"]=="")
{
    header("location:../Guest/Login.php");
}
?>