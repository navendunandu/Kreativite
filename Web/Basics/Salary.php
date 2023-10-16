<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
$firstname = "";
$lastname = "";
$gender = "";
$relation = "";
$department = "";
$bsalary = 0;
$name ="";
$ta="";
$da="";
$hra="";
$lic="";
$pf="";
$ded="";
$net="";
if(isset($_POST["submit_btn"]))
{
	$firstname =$_POST["fname"];
	$lastname =$_POST["lname"];
	$gender=$_POST["gender"];
	$relation=$_POST["relation"];
	$department=$_POST["department"];
	$bsalary=$_POST["bsalary"];
	
	if($gender == "female" && $relation == "Married")
	{
		$name = "Mrs"."".$firstname." ".$lastname;
		}
	else if($gender == "female" && $relation == "Single")
	{
		$name = "Ms"." ".$firstname." ".$lastname;
		}
		else
		{
			$name = "Mr"." ".$firstname." ".$lastname;
			}	
			
			if($bsalary <5000)
			{
				$ta = (30/100)* $bsalary;
				$da =  (25/100)*$bsalary;
				$hra= (20/100)*$bsalary;
				$lic = (15/100)*$bsalary;
				$pf = (10/100)*$bsalary;
				}
				else if($bsalary >=5000 && $bsalary<10000)
				{
					$ta = (35/100)*$bsalary;
					$da =  (30/100)*$bsalary;
					$hra= (25/100)*$bsalary;
					$lic = (20/100)*$bsalary;
					$pf = (15/100)*$bsalary;
				}
				else
				{
					$ta = (40/100)*$bsalary;
					$da =  (35/100)*$bsalary;
					$hra= (30/100)*$bsalary;
					$lic = (25/100)*$bsalary;
					$pf = (20/100)*$bsalary;
					}
					
					$ded = $lic + $pf;
					$net = $bsalary + $ta + $da + $hra - ($ded);

}

?>
<form method="POST">
<div>
<label for="fname">Enter First Name:</label>
<input type="text" name="fname" id="fname" />
</div>
<div>
<label for="lname">Enter Last Name:</label>
<input type="text" name="lname" id="lname" />
</div>
<p>Gender:</p>
<div>
<label for="male">Male:</label>
<input type="radio" name="gender" id="male" value="Male" />
<label for="female">Female:</label>
<input type="radio" name="gender" id="female" value="female" />
</div>
<p>Martial:</p>
<div>
<label for="single">Single:</label>
<input type="radio" name="relation" id="single" value="Single" />
<label for="married">Married:</label>
<input type="radio" name="relation" id="married" value="Married" />
</div>
<p>Department:</p>
<select name="department">
<option value="CS">Computer Science</option>
<option value="Math">Mathematics</option>
<option value="Commerce">Commerce</option>
<option value="Psychology">Psychology</option>
</select>
<div>
<label for="bsalary">Basic Salary:</label>
<input type="text" name="bsalary" id="bsalary" />
</div>
<input type="submit" name="submit_btn" value="Submit" />
<div>
<p>F Name:<?php echo $name; ?> </p>
<p>Gender:<?php echo $gender; ?></p>
<p>Relation:<?php echo $relation; ?></p>
<p>Department:<?php echo $department; ?></p>
<p>Basic Salary:<?php echo $bsalary; ?></p>
<p>TA:<?php echo $ta; ?></p>
<p>DA:<?php echo $da; ?></p>
<p>HRA:<?php echo $hra; ?></p>
<p>LIC:<?php echo $lic; ?></p>
<p>PF:<?php echo $pf; ?></p>
<p>Deduction:<?php echo $ded; ?></p>
<p>NET:<?php echo $net; ?></p>

</div>
</form>
</body>
</html>