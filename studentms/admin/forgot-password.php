<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $newpassword = md5($_POST['newpassword']);
  $sql = "SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $con = "update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('Password Berhasil Di ubah');</script>";
  } else {
    echo "<script>alert('Email Atau NO Handphone Tidak Valid');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Halaman Lupa Password</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("Password baru dengan konfirmasi password tidak sama  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="images/logo.svg">Admin
              </div>
              <h4>Pemulihan Password</h4>
              <h6 class="font-weight-light">Masukkan alamat Email dan No Handphone Untuk Mereset Password!</h6>
              <form class="pt-3" id="login" method="post" name="login">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" placeholder="Alamat Email" required="true" name="email">
                </div>
                <div class="form-group">

                  <input type="text" class="form-control form-control-lg" name="mobile" placeholder="No Handphone" required="true" maxlength="10" pattern="[0-9]+">
                </div>
                <div class="form-group">

                  <input class="form-control form-control-lg" type="password" name="newpassword" placeholder="Password Baru" required="true" />
                </div>
                <div class="form-group">

                  <input class="form-control form-control-lg" type="password" name="confirmpassword" placeholder="Konfirmasi Password" required="true" />
                </div>
                <div class="mt-3">
                  <button class="btn btn-success btn-block loginbtn" name="submit" type="submit">Reset</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">

                  <a href="login.php" class="auth-link text-black">Login?</a>
                </div>
                <div class="mb-2">
                  <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="icon-social-home mr-2"></i>Back Home </a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>
</html>