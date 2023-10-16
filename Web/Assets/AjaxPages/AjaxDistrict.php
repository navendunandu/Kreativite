<option value="">Select District</option>
<?php
include("../Connection/connection.php");
$selQry="select * from tbl_district where state_id=".$_GET['sid'];
$result=$con->query($selQry);
while($row=$result->fetch_assoc())
{
	?>
	<option value="<?php echo $row['district_id']?>"><?php echo $row['district_name']?></option>
    <?php
}
?>