<?PHP
require_once("include/membersite_config.php");

if(isset($_POST['submitted']))
{
	if($_POST['depot_name'] != '--Select Depot--') {
	   if($fgmembersite->Login())
	   {        
			$fgmembersite->RedirectToURL("viewall.php");      
	   } else {
			$error_message = $fgmembersite->GetErrorMessage();
	   }
    } else {
       $error_message = 'Please Select Depot Name';
    }
} else {
    $_POST['username'] = '';
    $_POST['password'] = '';
}

function connect() {
     //   return new PDO('mysql:host=localhost;dbname=needate1_depotsnapOG', 'needate1', 'BentOliver123$', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 1002 => "SET NAMES utf8"));
    $dbHost = 'localhost';
    $dbUsername = 'needate1_needa';
    $dbPassword = 'needa123#';
    $dbName = 'needate1_ian_project';
    return $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
}

function depot_cells_list($name, $selected_id=null, $all_option=false, $all=true, $from="") {  
    $db = connect();
    $drop_down = "<select class='form-control' name='depot_name' id='depot_name'>";
    $options = "<option>--Select Depot--</option>";
	$sql = "SELECT DISTINCT depot_name, id, location FROM registered_depots";                        
        $result = mysqli_query($db, $sql);  
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                if($row['depot_name'] != "") {
                    $options .= "<option>".$row['depot_name']."</option>";
                }
            }
        }
    $drop_down .= $options;    
    $drop_down .= "</select>"; 
    return $drop_down;
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
                
                <input type="hidden" name="login_as" value="Depot Manager" /> 
                <div class="form-group">
                  <div class="input-group">                                    
                      <label for='exampleSelectGender'>Depot Name:</label> 
                      <div class="input-group">
                          <?php echo depot_cells_list('depot_name', null, false, true, ""); ?>
						  <span id='login_depot_name_errorloc' class='error'></span>
                      </div>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name='username' value="<?php echo $_POST['username']; ?>" placeholder="Username" />
                    <span id='login_username_errorloc' class='error'></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" name='password' maxlength="50" class="form-control" value="<?php echo $_POST['password']; ?>" placeholder="Password" />
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

    frmvalidator.addValidation("depot_name","req","username required");
    frmvalidator.addValidation("depot_name","dontselect","Please Select"); 
    

    frmvalidator.addValidation("username","req","username required");    
    frmvalidator.addValidation("password","req","password required");
    
    frmvalidator.addValidation("username", "alpha", "Invalid username");
    frmvalidator.addValidation("username", "minlen=3", "Invalid username");
    frmvalidator.addValidation("username", "maxlen=15", "Invalid username");
    
    frmvalidator.addValidation("password", "req", "Invalid password");
    frmvalidator.addValidation("password", "minlen=3", "Invalid password");
    frmvalidator.addValidation("password", "maxlen=15", "Invalid password");

// ]]>
</script>
</html>
