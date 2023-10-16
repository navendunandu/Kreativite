 <?php
$server="localhost";
$user="root";
$password="";
$db="db_film";
$con=mysqli_connect($server,$user,$password,$db);
if(!$con)
{
	echo "Database Error";
}
?>
