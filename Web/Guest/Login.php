<?php
include("../Assets/Connection/connection.php");
session_start();
if (isset($_POST["btn_submit"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  //Admin
  $selAdmin = "select * from tbl_adminregistration where adminregistration_email = '" . $email . "' and adminregistration_password = '" . $password . "' ";
  $resAdmin = $con->query($selAdmin);
  //User
  $selUser = "select * from tbl_userregistration where userreg_email = '" . $email . "' and userreg_password = '" . $password . "' ";
  $resUser = $con->query($selUser);
  //Hiring team
  $selHirer = "select * from tbl_hiringteam where hiring_email='" . $email . "' and hiring_password = '" . $password . "' and hiring_vstatus =1 ";
  $resHirer = $con->query($selHirer);

  //Location Lender
  $selLender = "select * from tbl_locationlender where lender_email='" . $email . "' and lender_password='" . $password . "' and lender_status =1";
  $resLender = $con->query($selLender);
  if ($resAdmin->num_rows > 0) {
    $row = $resAdmin->fetch_assoc();
    $_SESSION['aid'] = $row["adminregistration_id"];
    $_SESSION["aname"] = $row["adminregistration_name"];
    header('location: ../Admin/homepage.php');
  } else if ($resUser->num_rows > 0) {
    $row = $resUser->fetch_assoc();
    $_SESSION["uid"] = $row["user_id"];
    $_SESSION["uname"] = $row["userreg_name"];
    header("location: ../User/homepage.php");
  } else if ($resHirer->num_rows > 0) {
    $row = $resHirer->fetch_assoc();
    $_SESSION["hid"] = $row["hiring_id"];
    $_SESSION["hname"] = $row["hiring_name"];
    header("location: ../hiringteam/homepage.php");

  } else if ($resLender->num_rows > 0) {
    $row = $resLender->fetch_assoc();
    $_SESSION["lid"] = $row["lender_id"];
    $_SESSION["lname"] = $row["lender_name"];
    header("Location:../Location Lender/Homepage.php");
  } else {
    echo "Inavalid Entry";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Assets/Templates/Admin/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../Assets/Templates/Admin/img/favicon.png">
  <title>
    KREATIVITE
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../Assets/Templates/Admin/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../Assets/Templates/Admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../Assets/Templates/Admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../Assets/Templates/Admin/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav
          class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
              KREATIVITE
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
              data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                    href="../index.html">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      Sign Up
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="./UserRegistration.php">Artist</a></li>
                      <li><a class="dropdown-item" href="./hirereg.php">Hiring Team</a></li>
                      <li><a class="dropdown-item" href="./loclenderreg.php">Location Lender</a></li>
                    </ul>
                  </div>
                </li>
              </ul>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  <form class="needs-validation" role="form" method="post" novalidate>
                    <label>Email</label>
                    <div class="mb-3">
                      <input required type="email" name="email" class="form-control" placeholder="Email" aria-label="Email"
                        aria-describedby="email-addon">
                        <div class="invalid-feedback">Please enter a valid email</div>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input required type="password" name="password" class="form-control" placeholder="Password"
                        aria-label="Password" aria-describedby="password-addon">
                        <div class="invalid-feedback">Invalid Password</div>
                    </div>
                    <div class="text-center">
                      <input type="submit" name="btn_submit" class="btn bg-gradient-info w-100 mt-4 mb-0"
                        value='Sign in' />
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="../index.html#register" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                  style="background-image:url('../Assets/Templates/Admin/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            
          </a>
        </div>
        
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright ©
            <script>
              document.write(new Date().getFullYear())
            </script> KREATIVITE.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../Assets/Templates/Admin/js/core/popper.min.js"></script>
  <script src="../Assets/Templates/Admin/js/core/bootstrap.min.js"></script>
  <script src="../Assets/Templates/Admin/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../Assets/Templates/Admin/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../Assets/Templates/Admin/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
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
  </script>
</body>

</html>