<?PHP
    require_once("include/membersite_config.php");
    if(!$fgmembersite->CheckLogin()) {
        $fgmembersite->RedirectToURL("index.php");
        exit;
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
  <link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css" />
  <link rel="stylesheet" href="vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css" />
  <link rel="stylesheet" href="css/test.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  
  
  
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js">
</script>

<!--not required for now-->
<!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>-->


<!--<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.css"/>--> 
    


<style>
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #C5D5E3;
}
</style>
<style src='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>
</style>
    
<script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable();
    });
  </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_horizontal-navbar.html -->
    <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100 align-items-center">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center">
            <a class="navbar-brand brand-logo" href="#"><img src="images/logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="images/logo.png" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between flex-grow-1">
            
            <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="add_tank.php">Add Tank</a></li>
                    </ul>
                </nav>
                
<!--              <li class="nav-item dropdown d-none d-lg-flex nav-language">
                <div class="nav-link">
                  <span class="dropdown-toggle btn btn-sm" id="languageDropdown" data-toggle="dropdown">English
                    <i class="flag-icon flag-icon-gb ml-2"></i>
                  </span>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                    <a class="dropdown-item font-weight-medium">
                      French
                      <i class="flag-icon flag-icon-fr ml-2"></i>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item font-weight-medium">
                      Espanol
                      <i class="flag-icon flag-icon-es ml-2"></i>
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item font-weight-medium">
                      Arabic
                      <i class="flag-icon flag-icon-sa ml-2"></i>
                    </a>
                  </div>
                </div>
              </li>-->
              
              
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

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
          
          
          
          <div class="content-wrapper test" style="max-width: '1500px'">
          <div class="card">
            <div class="card-body">
                
              <h1 class="card-title">Incoming Tanks for Depot: <?php echo $_SESSION['depot_name']; ?> </h1>
                <form class="form-horizontal" action="export_data_for_user.php" method="post" name="upload_excel" enctype="multipart/form-data">
                          <input  type="submit"  name="Export" class="btn btn-success" value="export to excel" style="float: right"/>  
                </form>
              <div class="row">
                <div class="col-12 table-responsive">                  
                  <table id="table_id" class="table table-bordered table table-hover table-striped display">
                      <thead class="thead-dark">
                      <tr>
<!--                      <th>Branch</th>-->                          
                          <th>Tank Number</th>
                          <th>Date In|Out</th>
                          <th>Tank Status</th>
                          <th>Body Status</th>
                          <th>Cleaning </br> Status</th>
						  <th>Cleaning </br> Date</th>
                          <th>Repair </br> Date</th>
                          <th>Is Test </br> Due </br></th>
                          <th>Test </br>Date</br></th>
                          <th>Test </br>Type</br></th>
                          <th>Available </br>Date</br></th>   
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>    
                    <?php 
                        $depot_name = $_SESSION['depot_name'];                        
                        $incoming_tanks = $fgmembersite->getIncomingtanks($depot_name); 
                        //echo "count ->".count($incoming_tanks);
                        //foreach ($incoming_tanks as $key => $value) {
                        //    echo "key ->".$key;
                        //}
                        //echo "count ->".count($incoming_tanks);
                        if(count($incoming_tanks) >= 1) {
                            foreach ($incoming_tanks as $key => $value) {
                               // echo "key ->".$key;
                                $record = $value;
                    ?>
                        <tr>                           
                            <td>
                                  <?php echo $record['tank_number']; ?> 
                            </td>
                            <td>                                 
                                  <?php echo "In: ".$record['date_in_v']." </br>Out: ".$record['date_out_v'] ?>
                            </td>
                            <td><?php echo $record['tankstatus']; ?></td>
                            <td><?php echo $record['body_status']; ?></td>
                            <td><?php echo $record['cleaning_status']; ?></td>
							<td>
                              <?php echo "Start Dt.: ".$record['cleaning_start_date_v']."</br> End Dt.: ".$record['cleaning_end_date_v']; ?>
                            </td>
                            <td><?php echo "Start Dt.: ".$record['repair_start_date_v']."</br> End Dt.: ".$record['repair_end_date_v']; ?></td>
                            <td>
                                    <?php if($record['is_test_due'] == '1') {                                  
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                    ?>
                            </td>
                            <td>
                                    <?php
                                        echo $record['test_date_v'];
                                    ?>
                            </td>
                            <td>  <?php
                                        echo $record['test_type'];
                                    ?>
                            </td>
                            <td> 
                                    <?php
                                        echo $record['available_date_v'];
                                    ?>
                            </td>                            
                            <td>
                                    <?php
                                       // echo '';                                       
                                    ?>
                            </td>
                              
<!--                              <td>
                                <label class="badge badge-info">On hold</label>
                              </td>
                              <td>
                                <button class="btn btn-outline-primary">View</button>
                              </td>-->
                              
                        </tr> 
                        <?php        
                            }
                        }
                        ?>                   
                      
                    </tbody>
                  </table>
                   
                </div>
                  
              </div>
              
            </div>
              
          </div>
              
        </div>
          
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center d-sm-inline-block">Copyright © 2018 <a href="http://www.NeedaTechnologies.com/" target="_blank">NeedaTechnologies</a>. All rights reserved.</span>
            
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
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/data-table.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
