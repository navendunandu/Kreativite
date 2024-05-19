<?php
include("../Assets/Connection/connection.php");



if (isset($_POST["btn_submit"])) {
  $selQry1 = "select * from tbl_userregistration where userreg_email='" . $_POST["user-email"] . "' ";
  $data1 = $con->query($selQry1);

  $selQry2 = "select*from tbl_hiringteam where hiring_email ='" . $_POST["user-email"] . "'";
  $data2 = $con->query($selQry2);

  $selQry3 = "select*from tbl_locationlender where lender_email='" . $_POST["user-email"] . "'";
  $data3 = $con->query($selQry3);

  if (($data1->fetch_assoc()) || $data2->fetch_array() || $data3->fetch_assoc()) {
    ?>
    <script>
      alert("Email already exist")
    </script>

    <?php
  } else {



    $password = $_POST["user-password"];
    $passwordConfirm = $_POST["user-password-confirm"];
    if ($password == $passwordConfirm) {
      //Photo uploading
      $photo = $_FILES['user-photo']['name'];
      $tempphoto = $_FILES['user-photo']['tmp_name'];
      move_uploaded_file($tempphoto, '../assets/files/user/Photo/' . $photo);

      //Proof Uploading
      $proof = $_FILES['user-file']['name'];
      $tmpProof = $_FILES['user-file']['tmp_name'];
      move_uploaded_file($tmpProof, '../assets/files/user/Proof/' . $proof);

      $insQuery = "insert into tbl_userregistration(userreg_name,userreg_contact,userreg_email,userreg_address,place_id,userreg_photo,userreg_proof,usertype_id,userreg_password,userreg_gender) values('" . $_POST["user-name"] . "','" . $_POST["user-contact"] . "','" . $_POST["user-email"] . "',
		'" . $_POST["user-address"] . "','" . $_POST["user-place"] . "','" . $photo . "','" . $proof . "','" . $_POST["user-type"] . "','" . $_POST["user-password"] . "','" . $_POST["gender"] . "') ";

      if ($con->query($insQuery)) {
        echo "Insertion Success";
      } else {
        echo "Insertion Failed";
      }
    } else {
      echo "Passwords not matching";
    }

  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Assets/Templates/Admin/img/apple-icon.png">
  <!-- <link rel="icon" type="image/png" href="../Assets/Templates/Admin/img/favicon.png"> -->
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
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../index.html">
              <i class="fa fa-chart-pie opacity-6  me-1"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="./Login.php">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('../assets/templates/admin/img/curved-images/user-reg.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Welcome!</h1>
              <p class="text-lead text-white">Step into the Spotlight: Your Path to a Film Industry Career Begins Here!
                Register Now for Exclusive Job Opportunities!</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">

              <div class="card-body">
                <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                  <div class="mb-3">
                    <label for="user-name">Name:</label>
                    <input required type="text" class="form-control" name="user-name" id="user-name"
                      title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter"
                      pattern="^[A-Z][a-zA-Z ]*$">
                    <div class="invalid-feedback">Please enter a valid name with the first letter as a capital letter.
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="user-contact">Contact:</label>
                    <input required type="text" class="form-control" name="user-contact" id="user-contact"
                      pattern="[789][0-9]{9}" title="Phone number should start with 7, 8, or 9 and be 10 digits long">
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number starting with 7, 8, or 9.
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="user-email">Email:</label>
                    <input required type="email" class="form-control" name="user-email" id="user-email">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-address">Address:</label>
                    <input required type="text" class="form-control" name="user-address" id="user-address">
                    <div class="invalid-feedback">Please enter your address.</div>
                  </div>
                  <div class="mb-3">
                    <label>Gender:</label>
                    <div class="form-control custom-radio custom-control">
                      <input required class="custom-control-input" type="radio" name="gender" id="male" value="male">
                      <label class="custom-control-label" for="male">Male</label>
                      <input required class="custom-control-input" type="radio" name="gender" id="female"
                        value="female">
                      <label class="custom-control-label" for="female">Female</label>
                      <input required class="custom-control-input" type="radio" name="gender" id="others" value="other">
                      <label class="custom-control-label" for="others">Other</label>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="user-state">State:</label>
                    <select required class="form-control" name="user-state" id="user-state"
                      onchange="getDistrict(this.value)">
                      <option value="">Choose State</option>
                      <?php
                      // State select
                      $selStateQry = "select * from tbl_state";
                      $stateData = $con->query($selStateQry);
                      while ($stateRow = $stateData->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $stateRow["state_id"] ?>">
                          <?php echo $stateRow["state_name"] ?>
                        </option>
                      <?php } ?>
                    </select>
                    <div class="invalid-feedback">Please select a state.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-district">District:</label>
                    <select required class="form-control" name="user-district" id="user-district"
                      onchange="getPlace(this.value)">
                      <option value="">Choose District</option>
                    </select>
                    <div class="invalid-feedback">Please select a district.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-place">Place:</label>
                    <select required class="form-control" name="user-place" id="user-place">
                      <option value="">Choose Place</option>
                    </select>
                    <div class="invalid-feedback">Please select a place.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-photo">Photo:</label>
                    <input required type="file" class="form-control" name="user-photo" id="user-photo">
                    <div class="invalid-feedback">Please upload a photo.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-file">File:</label>
                    <input required type="file" class="form-control" name="user-file" id="user-file">
                    <div class="invalid-feedback">Please upload a file.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-type">User Type:</label>
                    <select required class="form-control" name="user-type" id="user-type">
                      <option value="">Choose Usertype</option>
                      <?php
                      $selUserTypeQuery = "select * from tbl_usertype";
                      $userTypeData = $con->query($selUserTypeQuery);
                      while ($userTtpeRow = $userTypeData->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $userTtpeRow["usertype_id"] ?>">
                          <?php echo $userTtpeRow["usertype_name"] ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                    <div class="invalid-feedback">Please select a user type.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-password">Password:</label>
                    <input required type="password" class="form-control" name="user-password" id="user-password"
                      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    <div class="invalid-feedback">Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</div>
                  </div>
                  <div class="mb-3">
                    <label for="user-password-confirm">Confirm Password:</label>
                    <input required type="password" class="form-control" name="user-password-confirm"
                      id="user-password-confirm">
                    <div class="invalid-feedback">Passwords do not match.</div>
                  </div>
                  <div class="mb-3 form-check">
                    <label for="terms-conditions" class="form-check-label">I agree to <a href="./terms.html">terms and conditions</a>:</label>
                    <input required type="checkbox" class="form-check-input" name="terms-conditions"
                      id="terms-conditions">
                    <div class="invalid-feedback">Please agree to the terms and conditions.</div>
                  </div>
                  <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Sign-Up" name="btn_submit">
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="./Login.php"
                      class="text-dark font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-4 mx-auto text-center">

          </div>
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-dribbble"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-twitter"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-instagram"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-pinterest"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-github"></span>
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
  </main>
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
  <script src="../Assets/JQ/jQuery.js"></script>
  <script>
    function getDistrict(sid) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
        success: function (html) {
          $("#user-district").html(html);
        }
      });
    }

    //Place
    function getPlace(sid) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxPlace.php?sid=" + sid,
        success: function (html) {
          $("#user-place").html(html);
        }
      });
    }
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