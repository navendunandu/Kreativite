<?php
include("../Assets/Connection/connection.php");
session_start();
include("./SessionValidation.php");

$selQry = "select * from tbl_locationlender ll inner join tbl_place p on ll.place_id = p.place_id where lender_id='".$_SESSION["lid"]."'";
$data = $con->query($selQry);
$row= $data->fetch_assoc();

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Meyawo landing page.">
    <meta name="author" content="Devcrud">
    <title>HOMEPAGE - <?php echo strtoupper($_SESSION["lname"]) ?></title>
    <!-- font icons -->
    <link rel="stylesheet" href="../Assets/Templates/Main/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Meyawo main styles -->
	<link rel="stylesheet" href="../Assets/Templates/Main/css/meyawo.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page Navbar -->
    <nav class="custom-navbar" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="logo" href="#">KREATIVITE</a>         
            <ul class="nav">
                <li class="item">
                    <a class="link" href="#home">Home</a>
                </li>
                <li class="item">
                    <a class="link" href="./AddLocation.php">Locations</a>
                </li>
                <li class="item">
                    <a class="link" href="./Bookings.php">Bookings</a>
                </li>
                <li class="item">
                    <a class="link" href="./Myprofile.php">My Profile</a>
                </li>
                <li class="item">
                    <a class="link" href="./MyComplaint.php">My Complaints</a>
                </li>
                <li class="item">
                    <a class="link" href="../Logout.php">Log Out</a>
                </li>
              
                <!-- <li class="item ml-md-3">
                    <a href="components.html" class="btn btn-primary">Components</a>
                </li> -->
            </ul>
            <a href="javascript:void(0)" id="nav-toggle" class="hamburger hamburger--elastic">
                <div class="hamburger-box">
                  <div class="hamburger-inner"></div>
                </div>
            </a>
        </div>          
    </nav><!-- End of Page Navbar -->

    <!-- page header -->
    <header id="home" class="header">
        <div class="overlay"></div>
        <div class="header-content container">
            <h1 class="header-title">
                <span class="up">HI!</span>
                <span class="down"><?php echo $_SESSION["lname"] ?></span>
            </h1>
            <p class="header-subtitle">Location Lender</p>            
            <!-- <a class="btn btn-primary" href='./Previouswork.php'>My Work</a> -->
            <!-- <button class="btn btn-primary">Visit My Works</button> -->
        </div>              
    </header><!-- end of page header -->

    <!-- about section -->
    <section class="section pt-0" id="about">
        <!-- container -->
        <div class="container text-center">
            <!-- about wrapper -->
            <div class="about">
                <div class="about-img-holder">
                    <img src="../assets/files/Loclender/Photo/<?php echo $row["lender_photo"] ?>" class="about-img" alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, meyawo Landing page">
                </div>
                <div class="about-caption">
                    <p class="section-subtitle">Who Am I ?</p>
                    <h2 class="section-title mb-3">About Me</h2>
                    <p>Name:
                        <?php echo $row["lender_name"] ?>      
                    </p>
                    <p>Email:
                        <?php echo $row["lender_email"] ?>      
                    </p>
                    <p>Contact:
                        <?php echo $row["lender_contact"] ?>      
                    </p>
                    <p>Place:
                        <?php echo $row["place_name"] ?>      
                    </p>
                </div>              
            </div><!-- end of about wrapper -->
        </div><!-- end of container -->
    </section> <!-- end of about section -->


    
   
    
    <!-- blog section -->
    <section class="section" id="blog">
        <!-- container -->
        <div class="container text-center">
            <h6 class="section-title mb-6">My Locations</h6>
            <!-- blog-wrapper -->
            <?php
                    $selQry2= "select * from tbl_locationdetails where lender_id='".$_SESSION["lid"]."'";
                    $data2 = $con->query($selQry2);
                    while($row2=$data2->fetch_assoc())
                    {
                
                ?>
            <div class="blog-card">
                <div class="blog-card-header">
                    <img src="../assets/files/loclender/Photo/<?php echo $row2['location_image']?>" class="blog-card-img" alt="<?php echo $row2["location_name"] ?>">
                </div>
                <div class="blog-card-body">
                    <h5 class="blog-card-title"><?php echo $row2["location_name"] ?></h6>

                    <!-- <p class="blog-card-caption">
                        <a href="#">By: Admin</a>
                        <a href="#"><i class="ti-heart text-danger"></i> 234</a>
                        <a href="#"><i class="ti-comment"></i> 123</a>
                    </p> -->
                    <p><?php echo $row2["location_address"] ?></p>

                   
                </div>
            </div><!-- end of blog wrapper -->

            <?php } ?>

        </div><!-- end of container -->
    </section><!-- end of blog section -->
                        
   

    <!-- footer -->
    <div class="container">
        <footer class="footer">       
            <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a href="../index.html">KREATIVITE</a></p>
        </footer>
    </div> <!-- end of page footer -->
	
	<!-- core  -->
    <script src="../Assets/Templates/Main/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="../Assets/Templates/Main/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="../Assets/Templates/Main/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Meyawo js -->
    <script src="../Assets/Templates/Main/js/meyawo.js"></script>

</body>
</html>
