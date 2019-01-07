<?php 
require_once("include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
} else {
    $_POST['first_name'] = '';
    $_POST['last_name'] = '';
    $_POST['depot_name'] = '';
    $_POST['depot_location'] = '';
    $_POST['email'] = '';
    $_POST['phone_number'] = '';
    $_POST['username'] = '';
    $_POST['password'] = '';    
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
  <link rel="stylesheet" href="css/style.css" />
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
                <p>Already have an account?</p>
                <a class="btn get-started-btn" href="index.php">Sign In</a>
              </div>                
              <form id='register' name='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
                <h3 class="mr-auto">Register</h3>
                <p class="mb-3 mr-auto">Enter your details below.</p>
                <div><span class='error'></span></div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                      <input type="text" name="first_name" id="first_name" class="form-control form-desid" value='' placeholder="First Name" />
                    <span id='register_first_name_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" name="last_name" id="last_name" class="form-control" value=''  placeholder="Last Name" />
                    <span id='register_last_name_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="text" name="depot_name" id="depot_name" class="form-control" value=''  placeholder="Depot Name" />
                    <span id='register_depot_name_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="text" name="depot_location" id="depot_location" class="form-control" value=''  placeholder="Depot Location" />
                    <span id='register_depot_location_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="text" name="email" id="email" class="form-control" value=''  placeholder="Email" />
                    <span id='register_email_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="number" name="phone_number" id="phone_number" class="form-control" value=''  placeholder="Phone number" />
                    <span id='register_phone_number_errorloc' class='error'></span>
                  </div>
                </div>
<!--            <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="text" name="manager" id="manager" class="form-control" value=''  placeholder="Manager" />
                    <span id='register_txt_manager_errorloc' class='error'></span>
                  </div>
                </div>-->
                <input type="hidden" name="role_id" value="11" id="role_id" />
                <div class="dropdown-divider"></div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" value=''  placeholder="Username" />
                    <span id='register_username_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control form-desid" value=''  placeholder="Password" />
                    <span id='register_password_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
<!--                  <button class="btn btn-primary submit-btn">SIGN UP</button>-->
                  <input name="submitted" value="SIGN UP"  id="submit" class="btn btn-primary submit-btn button-md" type="submit" />
                </div>
                <div class="wrapper mt-2 text-gray">
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
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    
    
// ]]>
</script>


<script type='text/javascript'>
// <![CDATA[
        
    var frmvalidator  = new Validator("register");
	
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("first_name", "req", "First Name required");
    frmvalidator.addValidation("last_name", "req", "Last Name required");
	frmvalidator.addValidation("first_name", "alpha", "Only Alphabits");
    frmvalidator.addValidation("last_name", "alpha", "Only Alphabits");

    frmvalidator.addValidation("depot_name", "req", "Depot Name required");
	frmvalidator.addValidation("depot_name", "alpha", "Only Alphabits");

    frmvalidator.addValidation("depot_location", "req", "Depot Location required");
	frmvalidator.addValidation("depot_location", "alpha", "Only Alphabits");

    frmvalidator.addValidation("email", "req", "Email required");
    frmvalidator.addValidation("email", "email", "Invalid Email");

    frmvalidator.addValidation("phone_number", "num", "Phone Number required");
    frmvalidator.addValidation("phone_number", "minlen=10", "Min 10 numbers");
    frmvalidator.addValidation("phone_number", "maxlen=10", "Max 10 numbers");

    frmvalidator.addValidation("username", "req", "Username required");
    frmvalidator.addValidation("username", "alpha", "Only Alphabits");
    frmvalidator.addValidation("username", "minlen=3", "More than 3 letters");
    frmvalidator.addValidation("username", "maxlen=15", "Less than 15 letters");

    frmvalidator.addValidation("password", "req", "password required");
    frmvalidator.addValidation("password", "minlen=3", "More than 3 chars");
    frmvalidator.addValidation("password", "maxlen=15", "Less than 15 chars");
    
    
    function reset() {        
        document.getElementById("tank_number").value = "";
        document.getElementById("date_in").value = "";
        document.getElementById("in_time").value = "";
        document.getElementById("tank_status").value = "2";
        document.getElementById("cleaning_start_date").value = "";
        document.getElementById("cleaning_end_date").value = "";
        document.getElementById("cleaning_status").value = "";
        document.getElementById("estimate_sent_date").value = "";        
        document.getElementById("estimate_approved_date").value = "";
        document.getElementById("body_status").value = "Good";
        document.getElementById("repair_start_date").value = "0";
        document.getElementById("repair_end_date").value = "";     
        document.getElementById("is_test_due").value = "0";
        document.getElementById("test_date").value = "";    
        document.getElementById("test_type").value = "";
        document.getElementById("available_date").value = "";
        document.getElementById("date_out").value = "";        
    }
    

// ]]>
</script>
</html>