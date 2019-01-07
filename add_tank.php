<?PHP
    require_once("include/membersite_config.php");
    if(!$fgmembersite->CheckLogin()) {
        $fgmembersite->RedirectToURL("index.php");
        exit;
    }
    $error_message = '';
    $success_message = '';
    if(isset($_POST['submitted'])) {
        //echo "inside submit"; exit();
        if($_POST['tank_number'] == '') {
            $error_message = 'Tank Number should be entered';
        } else if($_POST['date_in'] == '') {
            $error_message = 'Date In should be selected';
        } else if($fgmembersite->validateTankNumber($_POST['tank_number']) == '1') {
            if($fgmembersite->AddTank())
            {
                 //$fgmembersite->RedirectToURL("thank-you.html");
                $success_message = "Tank Added Successfully";
            } else {
				//echo "error message ->".$fgmembersite->GetErrorMessage();
				//echo "cleaning status after submit->".$_POST['cleaning_status'];
                $error_message = $fgmembersite->GetErrorMessage();
            }
        } else {
            $error_message = 'Invalid Tank Number';
        }
    } else {
        $_POST['tank_number'] = '';
        $_POST['date_in'] = '';
        $_POST['in_time'] = '';
        $_POST['cleaning_start_date'] = '';
        $_POST['cleaning_end_date'] = '';
        $_POST['estimate_sent_date'] = '';
        $_POST['estimate_approval_date'] = '';
        $_POST['body_status'] = '';
        $_POST['repair_start_date'] = '';
        $_POST['repair_end_date'] = '';
        $_POST['test_date'] = '';
        $_POST['available_date'] = '';
        $_POST['date_out'] = '';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Needa Technologies</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css"/>
  <link rel="stylesheet" href="vendors/iconfonts/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css"/>
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css"/>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css"/>
  <!-- endinject -->
   <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all"/>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>

  <link rel="shortcut icon" href="images/favicon.png" />
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all"/>
  <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all"/>
  <link href="css/main.css" rel="stylesheet" media="all"/>
  <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
  <script src='js/script.js' type='text/javascript'> </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100 align-items-center">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center">
            <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.png" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between flex-grow-1">
            <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">
                
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="viewall.php">View All</a></li>
                    </ul>
                </nav>

              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  <img src="https://via.placeholder.com/39x39" alt="profile"/>
                  <span class="nav-profile-name"><?php echo $fgmembersite->UserFullName(); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item">
                    <i class="icon-settings text-primary mr-2"></i>
                    Settings
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href='logout.php'>
                    <i class="icon-logout text-primary mr-2"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="icon-menu text-dark"></span>
            </button>
          </div>
        </div>
      </div> 
    </nav>
    
<!--    <div style="color:#FF0000; text-align: 'right'"> New Tank Added Successfully </div>-->
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
              
              <div style="color:#FF0000; text-align: center" id='error_message' > <?php if($error_message != '') { echo $error_message; } ?> </div>
             
              <div style="color:#008000; text-align: center"> <?php if($success_message != '') { echo $success_message; } ?> </div>
              
            <div class="card-body">
                
              <h4 class="card-title">Add Incoming Tank</h4>
              
              <div class="row">
                  <form class="forms-sample" name='add_tank' id='add_tank'  onsubmit='return validateForm()' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
                    
                    <?php 
                        if(isset($_SESSION['depot_name'])) {
                              $depot_name = $_SESSION['depot_name']; 
                        } else {
                           $depot_name = ''; 
                        }
                        //echo "depot name in add->".$depot_name;
                    ?>
                    
                    <input type="hidden" name="customer_id" value='1' />
                    <input type="hidden" name="branch_id" value='1' />
                    <input type="hidden" name="depot_name" value='"<?php echo $depot_name; ?>"' />
                    <div class="col-6 table-responsive">
                      <div class="form-group">
                        <label for="TankNumber">Tank Number</label>
                        <input type="text" class="form-control" id="tank_number" name="tank_number" onblur='validate_tanknumber()' value='<?php echo $_POST['tank_number']; ?>' placeholder="Tank Number" />
                      </div>
                      
                      <div class="form-group">                        
                            <label class="label">Date In</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="date_in" id="date_in" onblur='validateDateIn()' value='<?php echo $_POST['date_in']; ?>'/>
                                
                            </div>                                           
                      </div>
                      
                      <div class="form-group">
                        <label for="Date">In Time</label>
                        <input class="form-control" name="in_time" id="in_time" onblur='validateInTime()'  value='<?php echo $_POST['in_time']; ?>' placeholder="hh/mm" />
                      </div>
                      <div class="form-group">
                        <label for="status">Tank Status</label>
                        <select class="form-control" name="tank_status" id="tank_status" value='<?php echo $_POST['in_time']; ?>'>
                            <?php $tank_status = $fgmembersite->getTankStatus(); 
                                if(count($tank_status) > 0) {
                                    foreach ($tank_status as $key => $value) {                                                                                 
                            ?>
                            <option value='<?php echo $key; ?>' <?php if($_POST['tank_status'] != '' && $_POST['tank_status'] == $key) { ?> selected <?php } ?> ><?php echo $value; ?></option>
                            <?php        
                                }
                            }
                            ?>
                        </select>
                      </div>                        
                                              
                        <div class="form-group">                        
                            <label class="label">Cleaning Start Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="cleaning_start_date" id="cleaning_start_date" onblur='validateCleaningStartDate()' value='<?php echo $_POST['cleaning_start_date']; ?>' />
                                
                            </div>                                           
                        </div>

                        <div class="form-group">                        
                            <label class="label">Cleaning End Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="cleaning_end_date" id="cleaning_end_date" onblur='validateCleaningEndDate()' value='<?php echo $_POST['cleaning_end_date']; ?>' />
                                
                            </div>                                           
                        </div>
                      
                      <div class="form-group">
                        <label for="status">Cleaning Status</label>
                          <select class="form-control" id="cleaning_status" name="cleaning_status" id="cleaning_status" onchange='validateCleaningStatus()'>
							<?php if($_POST['cleaning_status'] != '') { ?>
							<option value="<?php echo $_POST['cleaning_status']; ?>" selected><?php echo $_POST['cleaning_status']; ?></option>
							<?php } ?>
                            <option value="Unclean">Unclean</option>
                            <option value="Outside Clean">Outside Clean</option>
                            <option value="Dedicated">Dedicated</option>
                            <option value="Not To Clean (NTC)">Not To Clean (NTC)</option>
                            <option value="Cleaned - Awaiting Survey">Cleaned - Awaiting Survey</option>
                            <option value="Cleaned - Surveyor Approved">Cleaned - Surveyor Approved</option>
                          </select>
                      </div>
                        
                      <div class="form-group">                        
                            <label class="label">Estimate Sent Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="estimate_sent_date" id="estimate_sent_date" onblur='validateEstimateSentDate()' value='<?php echo $_POST['estimate_sent_date']; ?>' />
                                
                            </div>                                           
                      </div>
                        
                      <div class="form-group">                        
                            <label class="label">Estimate Approved Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="estimate_approved_date" id="estimate_approved_date" onblur='validateEstimateApprovedDate()' value='<?php echo $_POST['estimate_approved_date']; ?>'/>
                                
                            </div>                                           
                      </div>                        
                    </div>
                                        
                    <div class="col-6 table-responsive">   
                        
                        <div class="form-group">
                        <label for="status">Body Status</label>
                          <select class="form-control" id="body_status" name="body_status" id="body_status">							
							<option value="Good" <?php if($_POST['body_status'] != '' && $_POST['body_status'] == 'Good') { ?> selected <?php } ?> >Good</option>
							<option value="Damaged" <?php if($_POST['body_status'] != '' && $_POST['body_status'] == 'Damaged') { ?> selected <?php } ?> >Damaged</option>
                                                       
                          </select>
                        </div>
                                        
                        
                        <div class="form-group">                        
                            <label class="label">Repair Start Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="repair_start_date" id="repair_start_date" onblur='validateRepairStartDate()' value='<?php echo $_POST['repair_start_date']; ?>'/>
                                
                            </div>                                           
                        </div>

                        <div class="form-group">                        
                            <label class="label">Repair End Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="repair_end_date" id="repair_end_date" onblur='validateRepairEndDate()' value='<?php echo $_POST['repair_end_date']; ?>' />
                                
                            </div>                                           
                        </div>
                      
                      <div class="form-group">
                        <label for="status">Is Test Due</label>
                          <select class="form-control" name="is_test_due" id="is_test_due">							
							<option value="No" <?php if($_POST['is_test_due'] != '' && $_POST['is_test_due'] == 'No') { ?> selected <?php } ?> >No</option>
							<option value="Yes" <?php if($_POST['is_test_due'] != '' && $_POST['is_test_due'] == 'Yes') { ?> selected <?php } ?> >Yes</option>                            
                          </select>
                      </div>
                      
                      <div class="form-group">                        
                            <label class="label">Test Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="test_date" id="test_date" onblur='validateTestDate()' value='<?php echo $_POST['test_date']; ?>'/>
                                
                            </div>                                           
                      </div> 
                      
                      <div class="form-group">
                          <label for="status">Test Type</label>
                          <select class="form-control" id="test_type" name="test_type" id="test_type" onchange='validateTestType()'>							
                            <option value="">--Select Test Type--</option>
                            <option value="2.5 year test" <?php if($_POST['test_type'] != '' && $_POST['test_type'] == '2.5 year test') { ?> selected <?php } ?> >2.5 year test</option>
                            <option value="5 year test" <?php if($_POST['test_type'] != '' && $_POST['test_type'] == '5 year test') { ?> selected <?php } ?>>5 year test</option>                            
                          </select>
                      </div>
                      
                      <div class="form-group">                        
                            <label class="label">Available Date</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="available_date" id="available_date" onblur='validateAvailableDate()' value='<?php echo $_POST['available_date']; ?>'/>
                                
                            </div>                                           
                      </div>
                      <div class="form-group">                       
                            <label class="label">Date Out</label>
                            <div class="input-group-icon">
                                <input class="input--style-4 js-datepicker" type="text" name="date_out" id="date_out" onblur='validateDateout()' value='<?php echo $_POST['date_out']; ?>'/>
                                
                            </div>                                           
                      </div> 
                                             
                    </div>
                    
                    <input type="submit" name="submitted" class="btn btn-primary mr-2" value="Add Tank" />
                    <button class="btn btn-light">Cancel</button> 
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.NeedaTechnologies.com/" target="_blank">Needa Technologies</a>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <script src="js/dropify.js"></script>
  <script src="js/dropzone.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/data-table.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
    <script src="js/global.js"></script>
  <!-- End custom js for this page-->
  

<script type='text/javascript'>
// <![CDATA[
        
    //var frmvalidator  = new Validator("add_tank");
	
    //frmvalidator.EnableOnPageErrorDisplay();
    //frmvalidator.EnableMsgsTogether();
    //frmvalidator.addValidation("tank_number","req","*");
    //frmvalidator.addValidation("date_in","req","*");
    //frmvalidator.addValidation("in_time","regexp=2[0-9]:2[0-9]","*");
    
    
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
</body>

</html>