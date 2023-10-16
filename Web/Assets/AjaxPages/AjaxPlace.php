<option value="">Select Place</option>
<?php
include("../Connection/connection.php");
$selQry="select * from tbl_place where district_id=".$_GET['sid'];
$result=$con->query($selQry);
while($row=$result->fetch_assoc())
{
	?>
	<option value="<?php echo $row['place_id']?>"><?php echo $row['place_name']?></option>
    <?php
}
?>