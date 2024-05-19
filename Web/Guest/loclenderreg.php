<?php
include("../Assets/Connection/connection.php");

if (isset($_POST["btn_submit"])) {

    $selQry1 = "select * from tbl_userregistration where userreg_email='" . $_POST["lender-email"] . "' ";
    $data1 = $con->query($selQry1);

    $selQry2 = "select*from tbl_hiringteam where hiring_email ='" . $_POST["lender-email"] . "'";
    $data2 = $con->query($selQry2);

    $selQry3 = "select*from tbl_locationlender where lender_email='" . $_POST["lender-email"] . "'";
    $data3 = $con->query($selQry3);

    if (($data1->fetch_assoc()) || $data2->fetch_array() || $data3->fetch_assoc()) {
        ?>

        <script>
            alert("Email Already Exists")
        </script>

        <?php
    } else {

        $password = $_POST["lender-password"];
        $confirm = $_POST["lender-password-confirm"];
        if ($password == $confirm) {
            $photo = $_FILES["lender-photo"]["name"];
            $temPhoto = $_FILES["lender-photo"]["tmp_name"];
            move_uploaded_file($temPhoto, '../assets/files/Loclender/Photo/' . $photo);

            $proof = $_FILES["lender-file"]["name"];
            $temProof = $_FILES["lender-file"]["tmp_name"];
            move_uploaded_file($temProof, '../assets/files/Loclender/Proof/' . $proof);

            $insQuery = "insert into tbl_locationlender(lender_name,lender_contact,lender_address,lender_email,place_id,lender_photo,lender_proof,lender_password) values('" . $_POST["lender-name"] . "','" . $_POST["lender-contact"] . "','" . $_POST["lender-address"] . "','" . $_POST["lender-email"] . "','" . $_POST["lender-place"] . "','" . $photo . "','" . $proof . "','" . $_POST["lender-password"] . "')";

            if ($con->query($insQuery)) {
                echo "Insertion Success";
            } else {
                echo "Insertion Failed";
            }
        } else {
            echo "Password Mismatch";
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
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
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
                style="background-image: url('../assets/templates/admin/img/curved-images/loc-len.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                            <p class="text-lead text-white">Unlock the Spotlight: Register Your Location for Film
                                Shooting!</p>
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
                                        <label for="lender-name">Name:</label>
                                        <input pattern="^[A-Z]+[a-zA-Z ]*$"
                                            title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"
                                            type="text" class="form-control" name="lender-name" id="lender-name"
                                            required>
                                        <div class="invalid-feedback">Please enter a name with only Alphabets,Spaces and
                                            First Letter Must Be Capital Letter</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-contact">Contact:</label>
                                        <input required type="text" class="form-control" name="lender-contact"
                                            id="lender-contact" pattern="[7-9]{1}[0-9]{9}"
                                            title="Phone number with 7-9 and remaing 9 digit with 0-9">
                                        <div class="invalid-feedback">Please enter a phone number with 7-9 and remaing 9
                                            digit with 0-9</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-email">Email:</label>
                                        <input required type="email" class="form-control" name="lender-email"
                                            id="lender-email">
                                        <div class="invalid-feedback">Please enter a valid email</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-address">Address:</label>
                                        <input required type="text" class="form-control" name="lender-address"
                                            id="lender-address">
                                        <div class="invalid-feedback">Please enter your address</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-state">State:</label>
                                        <select required class="form-control" name="lender-state" id="lender-state"
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
                                        <div class="invalid-feedback">Please choose your state</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-district">District:</label>
                                        <select required class="form-control" name="lender-district"
                                            id="lender-district" onchange="getPlace(this.value)">
                                            <option value="">Choose District</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose your district</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-place">Place:</label>
                                        <select required class="form-control" name="lender-place" id="lender-place">
                                            <option value="">Choose Place</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose your place</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-photo">Photo:</label>
                                        <input required type="file" class="form-control" name="lender-photo"
                                            id="lender-photo">
                                        <div class="invalid-feedback">Please upload yout photo</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-file">Proof:</label>
                                        <input required type="file" class="form-control" name="lender-file"
                                            id="lender-file">
                                        <div class="invalid-feedback">Please upload your proof</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-password">Password:</label>
                                        <input required type="password" class="form-control" name="lender-password"
                                            id="lender-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                        <div class="invalid-feedback">Password must contain at least one number and one
                                            uppercase and lowercase letter, and at least 8 or more characters</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lender-password-confirm">Confirm Password:</label>
                                        <input required type="password" class="form-control"
                                            name="lender-password-confirm" id="lender-password-confirm">
                                        <div class="invalid-feedback">Password mismatch</div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <label for="terms-conditions" class="form-check-label">I agree to <a
                                                href="./terms.html">terms and conditions</a>:</label>
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
                            </script> KREATIVITE
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
                    $("#lender-district").html(html);
                }
            });
        }

        //Place
        function getPlace(sid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?sid=" + sid,
                success: function (html) {
                    $("#lender-place").html(html);
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