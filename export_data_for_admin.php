<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'include/membersite_config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function xlsBOF() {
	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
}
function xlsEOF() {
	echo pack("ss", 0x0A, 0x00);
}
function xlsWriteNumber($Row, $Col, $Value) {
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	echo pack("d", $Value);
}
function xlsWriteLabel($Row, $Col, $Value) {
	$L = strlen($Value);
	echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
	echo $Value;
}
if(isset($_POST["Export"])) {
      $fgmembersite->DBLogin();
      //header('Content-Type: application/vnd.ms-excel');  
      //header('Content-Disposition: attachment; filename=data.xls');  
      //header("Pragma: no-cache"); 
      //header("Expires: 0");
      header('Content-Type: application/vnd.ms-excel');  
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");
      header("Content-Disposition: attachment; filename=\"export_".date("Y-m-d").".xls\"");
      header("Content-Transfer-Encoding: binary");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      xlsBOF();
      //$output = fopen("php://output", "w");  
      //fputcsv($output, array('Tank Number', 'Date In', 'Tank Status', 'Body Status', 'Cleaning Date','Repair Start Date','Repair end date','Estimate sent date','Estimate approve date','Is test Due','Test Date','test Type','Days Wait','Days on Clean','Days on Repair','Days on Available','Depot turn around'));  
      $headers_array = array('Depot Name', 'Tank Number', 'Date In', 'Tank Status', 'Body Status', 'Cleaning Date', 'Repair Start Date', 'Repair end date', 'Estimate sent date', 'Estimate approve date', 'Is test Due', 'Test Date', 'Test Type', 'Days Wait', 'Days on Clean', 'Days on Repair', 'Days on Available', 'Depot turn around');
      
      $i = 0;
      foreach ($headers_array as $value) {
          xlsWriteLabel(0, $i, $value);
          $i = $i+1;
      }
      //echo array_values($headers_array) . "\n";
      
      $i = 1;
      $query = "Select incoming_tanks.*, tank_status.tankstatus from incoming_tanks, tank_status where tank_status.id = incoming_tanks.tank_status ";  
      $result = mysql_query($query, $fgmembersite->connection);  
      while($row = mysql_fetch_assoc($result))  
      {  
           //fputcsv($output, $row);  
          //echo array_values($row) . "\n";
		  xlsWriteLabel($i, 0, $row['depot_name']);
          xlsWriteLabel($i, 1, $row['tank_number']);
          xlsWriteLabel($i, 2, $row['date_in']);
          xlsWriteLabel($i, 3, $row['tankstatus']);
          xlsWriteLabel($i, 4, $row['body_status']);          
          xlsWriteLabel($i, 5, $row['cleaning_end_date']);
          xlsWriteLabel($i, 6, $row['repair_start_date']);
          xlsWriteLabel($i, 7, $row['repair_end_date']);
          xlsWriteLabel($i, 8, $row['estimate_sent_date']);
          xlsWriteLabel($i, 9, $row['estimate_approved_date']);
          $is_test_due = 'No';
          if($row['is_test_due'] == '1') {
              $is_test_due = 'Yes';
          }
          xlsWriteLabel($i, 10, $is_test_due);
          xlsWriteLabel($i, 11, $row['test_date']);
          xlsWriteLabel($i, 12, $row['test_type']);
          
          // Days wait
          if ($row['cleaning_start_date'] != '0000-00-00' && $row['cleaning_end_date'] != '0000-00-00') {
                $date_in = date_create($row['date_in']);
                $cleaning_start_date = date_create($row['cleaning_start_date']);
                $interval = date_diff($date_in, $cleaning_start_date);
                //return $difference;
                //echo $interval->format('%a days'); 
                xlsWriteLabel($i, 13, $interval->format('%a days'));
          } else {
                 xlsWriteLabel($i, 13, $interval->format(''));
          }
          
          // Days on clean
          if ($row['cleaning_start_date'] != '' && $row['cleaning_end_date'] != '') {                                                
                $cleaning_start_date = date_create($row['cleaning_start_date']);
                $cleaning_end_date = date_create($row['cleaning_end_date']);
                $interval = date_diff($cleaning_end_date, $cleaning_start_date);
                //return $difference;
                //echo $interval->format('%a days'); 
                xlsWriteLabel($i, 14, $interval->format('%a days'));
          } else {
                xlsWriteLabel($i, 14, $interval->format(''));
          }
          
          // Days on Repair
          if ($row['repair_start_date'] != '' && $row['repair_end_date'] != '') {                                                
                $repair_start_date = date_create($row['repair_start_date']);
                $repair_end_date = date_create($row['repair_end_date']);
                $interval = date_diff($repair_end_date, $repair_start_date);
                //return $difference;
                //echo $interval->format('%a days'); 
                xlsWriteLabel($i, 15, $interval->format('%a days'));
          } else {
                xlsWriteLabel($i, 15, $interval->format(''));
          }
          
          // Days on Available
          if ($row['available_date'] != '' && $row['available_date'] != '0000-00-00') {
                $available_date = date_create(trim($row['available_date']));

                if($row['date_out'] != '' & $row['date_out'] != '0000-00-00') {
                    $date_out = date_create(trim($row['date_out']));
                    //echo "date out ->".$date_out;
                    $interval = date_diff($date_out, $available_date);
                    //echo $interval->format('%a days');
                    xlsWriteLabel($i, 16, $interval->format('%a days'));
                } else {
                    $available_date = date_create($row['available_date']);
                    $interval = date_diff($available_date, date('Y-m-d'));
                    //echo $interval->format('%a days');
                    xlsWriteLabel($i, 16, $interval->format('%a days'));
                }
                //return $difference;

            } else {
                xlsWriteLabel($i, 16, $interval->format(''));
            }
          xlsWriteLabel($i, 17, $interval->format(''));         
          $i = $i+1;
      }  
     xlsEOF();
 }  



?>

