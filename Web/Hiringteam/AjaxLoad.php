<?php
include("../Assets/Connection/Connection.php");
session_start();

   $selQry = "select * from tbl_chat c inner join tbl_hiringteam u on (c.team_from_id=u.hiring_id or c.team_to_id=u.hiring_id) where (c.user_from_id='".$_GET["cid"]."' or c.user_to_id='".$_GET["cid"]."') order by chat_id";
   $result=$con->query($selQry);
   while ($row=$result->fetch_assoc()) {

    if($row["team_to_id"]==$_SESSION["hid"])
    {
        $selQry1 = "select * from tbl_userregistration where user_id='".$_GET["cid"]."'";
        $result1=$con->query($selQry1);
        $row1=$result1->fetch_assoc();
?>

<div class="chat-message is-received">
    <img src="../assets/files/user/Photo/<?php echo $row1["userreg_photo"] ?>" alt="">
    <div class="message-block">
        <span><?php echo $row1["userreg_name"] ?></span>
        <div class="message-text"><?php echo $row["chat_content"] ?></div>
    </div>
</div>
    <div class="chat-message" style="margin: 0px; padding: 0px" >
    </div>

<?php
   }
   else if($row["team_from_id"]==$_SESSION["hid"]){
   
        ?>
    <div class="chat-message is-sent">
        <img src="../Assets/Files/Hiringteam/Photo/<?php echo $row["hiring_photo"] ?>" alt="">
        <div class="message-block">
            <span><?php echo $row["hiring_name"] ?></span>
            <div class="message-text"><?php echo $row["chat_content"] ?></div>
        </div>
    </div>
    <div class="chat-message" style="margin: 0px; padding: 0px" >
    </div>
        <?php
    }
   }
?>