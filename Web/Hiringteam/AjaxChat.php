<?php
include("../Assets/Connection/Connection.php");
session_start();

    $insQry="insert into tbl_chat(user_to_id,team_from_id,chat_date,chat_content) 
    values('".$_GET["id"]."','".$_SESSION["hid"]."',curdate(),'".$_GET["chat"]."')";
    if($con->query($insQry))
    {
        echo "sended";
    }
    else
    {
        echo "failed";
    }
    
?>