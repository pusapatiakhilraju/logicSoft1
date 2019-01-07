<?PHP
//include($path_to_root . "/includes/session.inc");
require_once("include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {       
        $fgmembersite->RedirectToURL("view_all.php");        
   } else {
        $error_message = $fgmembersite->GetErrorMessage();
   }
}
function connect() {
     //   return new PDO('mysql:host=localhost;dbname=needate1_depotsnapOG', 'needate1', 'BentOliver123$', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 1002 => "SET NAMES utf8"));
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'needa12#';
    $dbName = 'logic_soft';
    return $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Needa Technologies</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css" />
  <link rel="stylesheet" href="vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css" />
  <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
  <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
      <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller" id='fg_membersite'>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper auth p-0 theme-two">
        <div class="row d-flex align-items-stretch">
          <div class="col-md-6 banner-section d-none d-md-flex align-items-stretch justify-content-center">
            <div class="slide-content bg-1">
                <img src="images/logo.png" alt="logo" />
            </div>
          </div>
          <div class="col-12 col-md-6 h-100 bg-white">
            <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
              <div class="nav-get-started">
                <p>Don't have an account?</p>
                <a class="btn get-started-btn" href="register.php">Register</a>
              </div>
              <form action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' name='login' accept-charset='UTF-8'>
                <h3 class="mr-auto">Hello! let's get started</h3>
                <p class="mb-5 mr-auto">Enter your details below.</p>

				<?php 
                if($error_message != '') {
              ?>
              <div style="color:#FF0000; text-align: center"> <?php echo $error_message; ?> </div>
              <?php
                }
              ?>
                
         <!--        <div class="form-group">
                 <div class="input-group">                                    
                      <label for='exampleSelectGender'>Login As:</label> 
                      <div class="input-group">
                          <select class='form-control' name='login_as' id='login_as' >
                          <option>Depot Manager</option>
                          <option>Admin</option>      
                         </select>
                      </div>
                  </div>
                    
                </div>-->
                <input type="hidden" name="login_as" value="Admin" />
                <input type="hidden" name="depot_name" value="" />
                
               
                
                
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name='username' placeholder="Username" />
					<span id='login_username_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" name='password' maxlength="50" class="form-control" placeholder="Password" />
                    <span id='login_password_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" />
                    Remember me
                  <i class="input-helper"></i></label>
                </div>
                <div class="form-group">                  
                  <input name="submitted" value="SIGN IN" id="submit" class="btn btn-primary submit-btn button-md" type="submit" />
                </div>
                <div class="form-group">
                  <a class="" href="forgotpwd.html">Forgot password?</a>
                </div>
                <div class="wrapper mt-5 text-gray">
                  <p class="footer-text">Copyright © 2018 NeedaTechnologies. All rights reserved.</p>
                  <ul class="auth-footer text-gray">
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                  </ul>
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
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>
<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","username required");
    
    frmvalidator.addValidation("password","req","password required");

// ]]>
</script>
</html>
