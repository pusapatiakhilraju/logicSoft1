<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite
{
    var $admin_email;
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $login_as;
    var $depot_name;
    var $depot_id;
    
    var $error_message;
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'YourWebsiteName.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
       // echo "Inside registered user"; exit();
                
        $formvars = array();
        
       // if(!$this->ValidateRegistrationSubmission())
        //{
        //    return false;
       // }
        $confirm_code = rand(1000, 9999);
        $this->CollectRegistrationSubmission($formvars);
        $formvars['confirm_code'] = $confirm_code; 
        //echo "Inside registered user"; exit();
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }
        
        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

	function validateTankNumber($tankNumber) {
        //echo "inside validate tank number"; exit();
        $valueOfCharacters = array(
            'A' => 10,
            'B' => 12,
            'C' => 13,
            'D' => 14,
            'E' => 15,
            'F' => 16,
            'G' => 17,
            'H' => 18,
            'I' => 19,
            'J' => 20,
            'K' => 21,
            'L' => 23,
            'M' => 24,
            'N' => 25,
            'O' => 26,
            'P' => 27,
            'Q' => 28,
            'R' => 29,
            'S' => 30,
            'T' => 31,
            'U' => 32,
            'V' => 34,
            'W' => 35,
            'X' => 36,
            'Y' => 37,
            'Z' => 38
        );

         $num_length=0;
        if(strlen($tankNumber) != 11) return 0;

        $alphabets = substr($tankNumber, 0, 4);
        $numbers = substr($tankNumber, 4, 6);

        if(strlen($alphabets) != 4) return 0;
        $num_length += strlen($numbers);

        $last_digit = substr($tankNumber, 10, 1);

        $num_length += strlen($last_digit);
        if($num_length != 7) return 0;

        $sumA = 0;

        for ($i = 0; $i <= 3; $i++) {
            $encode_value_for_alphabits[$i] = $valueOfCharacters[$alphabets[$i]];
                    $encode_value_for_tank_number[$i] = $valueOfCharacters[$alphabets[$i]];
        }
        $j = 0;
        for ($i = 4; $i <= 9; $i++) {       		
            //echo "tank number ->".$j."->".$encode_value_for_tank_number[$j];
            $encode_value_for_tank_number[$i] = $numbers[$j];
            $j = $j+1;		
        }
            $sum_of_step_one = 0;    	
        for ($i = 0; $i <= 9; $i++) {
            $two_power_values[$i] = pow(2, $i);
                    $step_one[$i] = $encode_value_for_tank_number[$i]*$two_power_values[$i];
                     $sum_of_step_one = $sum_of_step_one+$step_one[$i];   // A
        }   

        //echo "sum of step one ->".$sum_of_step_one;

        $step_two = $sum_of_step_one/11;  // B

        $step_three = intval($step_two); // C 

        $step_four = $step_three*11; // D

        $step_five = $sum_of_step_one-$step_four;  // E

        $last_digit_of_step_five = substr($step_five, -1);

        //display_error("step five ->".$step_five." last digit ->".$last_digit);
        if($last_digit_of_step_five == $last_digit) {
            return 1;
        } else {
            return 0;
        }
    }

    
    function AddTank()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        //echo "before ->".$_POST['depot_name'];            
        $this->CollectAddTankSubmission($formvars);
        
        //echo "after ->".trim($formvars['depot_name'],'"'); exit();
        if(!$this->SaveTankToDatabase($formvars))
        {
            //echo "returned false inside if again returning false"; exit();
            return false;
        }
        
      //  if(!$this->SendUserConfirmationEmail($formvars))
       // {
       //     return false;
      //  }
        
       // $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {

		
        if(empty($_GET['code']))
        {
            $this->HandleError("Please provide the confirm code");
            return false;
        }
		//echo "Inside confirm user ->".$_GET['code']; exit();
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $login_as = trim($_POST['login_as']);
        if(!isset($_SESSION)) { session_start(); }
        
        if($login_as == 'Admin') {
            if(!$this->CheckLoginInDBAforadmin($username, $password))
            {
                return false;
            }
        } else if($login_as == 'Depot Manager') {
            $depot_name = trim($_POST['depot_name']);           
            if(!$this->CheckLoginInDBAforuser($username, $password, $depot_name))
            {
                return false;
            }
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($this->depot_name);
        unset($this->depot_id);
        
        unset($_SESSION[$sessionvar]);
        session_destroy();
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDBAforadmin($username, $password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        $username = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        $qry = "Select * from user_registration where username='$username' and password='$pwdmd5' and confirmcode='y'";
        //echo "Query ->".$qry;
        $result = mysqli_query($this->connection, $qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $row = mysqli_fetch_assoc($result);
        
        $this->login_as = 'admin';
        $_SESSION['name_of_user']  = $row['first_name'];
        $_SESSION['email_of_user'] = $row['email'];
        $_SESSION['depot_id'] = '';
        $_SESSION['depot_name'] = '';
        
        return true;
    }
    
    function CheckLoginInDBAforuser($username, $password, $depot_name)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!isset($_SESSION)){ session_start(); }
        
        $depot_id = $this->getDepotID($depot_name);
        
        if($depot_id != false) {
            $username = $this->SanitizeForSQL($username);
            $pwdmd5 = md5($password);
            //$qry = "Select * from user_registration where username='$username' and password='$pwdmd5' AND depot_id='$depot_id' and confirmcode='y'";
            $qry = "Select * from user_registration where username='$username' and password='$pwdmd5' AND depot_id='$depot_id' ";
            //echo "Query ->".$qry;
            $result = mysqli_query($this->connection,$qry);
            
            if(!$result || mysqli_num_rows($result) <= 0)
            {
                $this->HandleError("Error logging in. The username or password does not match");
                return false;
            }
            
            $row = mysqli_fetch_assoc($result);
			if($row['confirmcode'] != 'y') {
				$this->HandleError("Error logging in. You need to confirm first before login by clicking on the confirmation link sent to your email id. ");
                return false;
			}
            $_SESSION = array();
            $_SESSION['name_of_user']  = $row['first_name'];
            $_SESSION['email_of_user'] = $row['email'];
            $_SESSION['depot_id'] = $row['depot_id'];
            $_SESSION['depot_name'] = $depot_name;
            
            $this->depot_name = $depot_name;
            $this->depot_id = $row['depot_id'];
            $this->login_as = 'user';
            
            if(isset($this->depot_name)) {
               // echo "set in session ->".$this->depot_name;  exit();
            } else {
                //echo "not set in session while login"; exit();
            }
            //echo "Success ->"; exit();
            
            return true;
        } else {
            return false;
        }
    }
    
    function getIncomingtanks($depotname = '')
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $qry = "SELECT incoming_tanks.*, concat(DATE_FORMAT(incoming_tanks.date_in, '%d/%b/%Y')) as date_in_v, "
                . "concat(DATE_FORMAT(incoming_tanks.cleaning_start_date, '%d/%b/%Y')) as cleaning_start_date_v, "
                . "concat(DATE_FORMAT(incoming_tanks.cleaning_end_date, '%d/%b/%Y')) as cleaning_end_date_v,"
                . "concat(DATE_FORMAT(incoming_tanks.estimate_sent_date, '%d/%b/%Y')) as estimate_sent_date_v, "
                . "concat(DATE_FORMAT(incoming_tanks.estimate_approved_date, '%d/%b/%Y')) as estimate_approved_date_v,"
                . "concat(DATE_FORMAT(incoming_tanks.repair_start_date, '%d/%b/%Y')) as repair_start_date_v, "
                . "concat(DATE_FORMAT(incoming_tanks.repair_end_date, '%d/%b/%Y')) as repair_end_date_v,"
                . "concat(DATE_FORMAT(incoming_tanks.test_date, '%d/%b/%Y')) as test_date_v,"
                . "concat(DATE_FORMAT(incoming_tanks.available_date, '%d/%b/%Y')) as available_date_v,"
                . "concat(DATE_FORMAT(incoming_tanks.date_out, '%d/%b/%Y')) as date_out_v, tank_status.tankstatus "
                . "FROM incoming_tanks, tank_status WHERE tank_status.id = incoming_tanks.tank_status ";
        
        if($depotname != '') {
            $qry .= " AND depot_name = '".$depotname."' ";
        }
        //echo "Query ->".$qry;
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $incoming_tanks = array();
        while($row = mysqli_fetch_assoc($result)) {
            $record = array();
			$record['id'] =  $row['id'];
            $record['tank_number'] =  $row['tank_number'];
            $record['date_in_v'] =  $row['date_in_v'];
			$record['date_in'] =  $row['date_in'];
            $record['in_time'] =  $row['in_time'];

            $record['cleaning_start_date_v'] =  $row['cleaning_start_date_v'];
            $record['cleaning_end_date_v'] =  $row['cleaning_end_date_v'];
			$record['cleaning_start_date'] =  $row['cleaning_start_date'];
            $record['cleaning_end_date'] =  $row['cleaning_end_date'];

            $record['cleaning_status'] =  $row['cleaning_status'];
            
            $record['repair_start_date_v'] =  $row['repair_start_date_v'];
            $record['repair_end_date_v'] =  $row['repair_end_date_v'];
			$record['repair_start_date'] =  $row['repair_start_date'];
            $record['repair_end_date'] =  $row['repair_end_date'];

            $record['body_status'] =  $row['body_status'];
            
            $record['estimate_sent_date_v'] =  $row['estimate_sent_date_v'];
            $record['estimate_approved_date_v'] =  $row['estimate_approved_date_v'];
			$record['estimate_sent_date'] =  $row['estimate_sent_date'];
            $record['estimate_approved_date'] =  $row['estimate_approved_date'];

            $record['is_test_due'] =  $row['is_test_due'];
            $record['test_date'] =  $row['test_date'];
            $record['test_type'] =  $row['test_type'];
            $record['tank_status'] =  $row['tank_status'];
            $record['tankstatus'] =  $row['tankstatus'];

            $record['available_date'] =  $row['available_date'];
            $record['date_out'] =  $row['date_out'];
			$record['available_date_v'] =  $row['available_date_v'];
            $record['date_out_v'] =  $row['date_out_v'];

            $record['depot_name'] =  $row['depot_name'];
            $incoming_tanks[] = $record;
        }        
        return $incoming_tanks;
    }
        
    function getTankStatus()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $qry = "Select * from tank_status WHERE id NOT IN ('1', '35', '36', '30', '31')";
                
        //echo "Query ->".$qry;
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $tank_status = array();
        while($row = mysqli_fetch_assoc($result)) {
            $tank_status[$row['id']] =  $row['tankstatus'];            
        }
        
        return $tank_status;
    }
    
    
    
    function getDepotID($depot_name)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $qry = "Select * from registered_depots where depot_name='$depot_name' ";
        //echo "Query ->".$qry;
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The depot name or location does not match");
            return false;
        }
        
        $row = mysqli_fetch_assoc($result);
        if($row['id'] != '') {            
            return $row['id'];
        } else {            
            return false;
        }
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
		//echo "confirm code ->".$confirmcode; exit();
        $result = mysqli_query($this->connection,"Select first_name, email from user_registration where confirmcode='$confirmcode'");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        $user_rec['first_name'] = $row['first_name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysqli_query($this->connection,$qry))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);
        
        $qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysqli_query($this->connection,$qry))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysqli_query($this->connection,"Select * from $this->tablename where email='$email'");  

        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysqli_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['first_name']);
        
        $mailer->Subject = "Welcome to ".$this->depot_name;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['first_name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->depot_name." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "LogicSoft\r\n".
        $this->depot_name;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['first_name'];
        
        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->depot_name."\r\n".
        "Name: ".$user_rec['first_name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "username:".$user_rec['username']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("username","req","Please fill in UserName");
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['first_name'] = $this->Sanitize($_POST['first_name']);
        $formvars['last_name'] = $this->Sanitize($_POST['last_name']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['phone_number'] = $this->Sanitize($_POST['phone_number']);
        $formvars['depot_name'] = $this->Sanitize($_POST['depot_name']);
        $formvars['depot_location'] = $this->Sanitize($_POST['depot_location']);
        $formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['password'] = $this->Sanitize($_POST['password']);        
    }
    
    function CollectAddTankSubmission(&$formvars)
    {
        $formvars['customer_id'] = $this->Sanitize($_POST['customer_id']);
        $formvars['branch_id'] = $this->Sanitize($_POST['customer_id']);
        $formvars['tank_number'] = $this->Sanitize($_POST['tank_number']);
        $formvars['date_in'] = $this->Sanitize($_POST['date_in']);
        $formvars['in_time'] = $this->Sanitize($_POST['in_time']);
        $formvars['tank_status'] = $this->Sanitize($_POST['tank_status']);
        $formvars['cleaning_start_date'] = $this->Sanitize($_POST['cleaning_start_date']);
        $formvars['cleaning_end_date'] = $this->Sanitize($_POST['cleaning_end_date']);
        $formvars['cleaning_status'] = $this->Sanitize($_POST['cleaning_status']);
        $formvars['estimate_sent_date'] = $this->Sanitize($_POST['estimate_sent_date']);
        $formvars['estimate_approved_date'] = $this->Sanitize($_POST['estimate_approved_date']);
        $formvars['body_status'] = $this->Sanitize($_POST['body_status']);
        $formvars['repair_start_date'] = $this->Sanitize($_POST['repair_start_date']);    
        $formvars['repair_end_date'] = $this->Sanitize($_POST['repair_end_date']);    
        $formvars['is_test_due'] = $this->Sanitize($_POST['is_test_due']);    
        $formvars['test_date'] = $this->Sanitize($_POST['test_date']); 
        $formvars['test_type'] = $this->Sanitize($_POST['test_type']); 
        $formvars['available_date'] = $this->Sanitize($_POST['available_date']);   
        $formvars['date_out'] = $this->Sanitize($_POST['date_out']);   
        $formvars['depot_name'] = $this->Sanitize(trim($_POST['depot_name'], '"'));        
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'], $formvars['first_name']);
        
        $mailer->Subject = "Your registration with ".$this->depot_name;
        
        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirm_code'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->depot_name."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Logicsoft\r\n".
        $this->depot_name;
        
        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['first_name'];
        
        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->depot_name."\r\n".
        "Name: ".$formvars['first_name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        //if(!$this->Ensuretable())
        //{
        //    return false;
        // }
       
        //if(!$this->IsFieldUnique($formvars, 'email'))
        //{
        //    $this->HandleError("This email already registered");
         //   return false;
       // }
         //echo "save to db"; exit();
        if(!$this->checkUsernameExists($formvars))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }        
        //echo "save to db"; exit();
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function SaveTankToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        //if(!$this->Ensuretable())
        //{
        //    return false;
        // }
        if($this->IsTankAlreadyIn($formvars, 'tank_number'))
        {
            $this->HandleError("This tank already in");
            //echo "inside if tank already in"; exit();
            return false;
        } 
        
        if($this->IsTankAlreadyAdded($formvars, 'tank_number'))
        {
            $this->HandleError("This tank already added for date: ".$formvars['date_in']);
            //echo "inside if tank already in"; exit();
            return false;
        } 
		
		if($this->validateDateIn($formvars) == false) {
            return false;
        }
        
        if($this->validateTimeIn($formvars) == false) {
            return false;
        }
        
        if($this->validateCleaningDetails($formvars) == false) {
            return false;
        }
        
        if($this->validateEstimateDetails($formvars) == false) {
            return false;
        }
        
        if($this->validateRepairDetails($formvars) == false) {
            return false;
        }
        
        if($this->validateTestDetails($formvars) == false) {
            return false;
        }
        
        if($this->validateAvailableDate($formvars) == false) {
            return false;
        }
        
        if($this->validateDateoutDate($formvars) == false) {
            return false;
        }
             
			 
        if(!$this->InsertTankIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }

	function validateDateIn($formvars) {        
        if($formvars['date_in'] == '') {
            $this->HandleError("Date In Should be selected");
            return false;
        } else {
			return true;
		}
    }
    
    function validateTimeIn($formvars) {        
        if($formvars['in_time'] == '') {
            $this->HandleError("Time In Should be selected");
            return false;
        } else {
			return true;
		}
    }

	
    function validateCleaningDetails($formvars) {
        $date_in = '';
        $cleaning_start_date = '';
        $cleaning_end_date = '';
        $cleaning_status = $formvars['cleaning_status'];
        
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);        
              
        if($formvars['cleaning_start_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_start_date']);
            $cleaning_start_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_start_date = '';
        }
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($cleaning_start_date != '') {
            if(strtotime($date_in) > strtotime($cleaning_start_date)) {                  
                $this->HandleError("Cleaning Start Date cannot be less than Date In");
                return false;
            } else if(strtotime($cleaning_start_date) > strtotime($cleaning_end_date)) {
                $this->HandleError("Cleaning End Date cannot be less than Cleaning Start Date ");
                return false;
            } else if($cleaning_status == 'Unclean' || $cleaning_status == 'Outside Clean' || $cleaning_status == 'Dedicated' || $cleaning_status == 'Not To Clean (NTC)') {
                $this->HandleError("Invalid Cleaning Status should be selected as 'Cleaned - Awaiting Survey' or 'Cleaned - Surveyor Approved' ");
                return false;
            }
        } else if($cleaning_start_date == '') {
            if($cleaning_status == 'Cleaned - Awaiting Survey' || $cleaning_status == 'Cleaned - Surveyor Approved') {
                $this->HandleError("Please Select Cleaning Dates");
                return false;
            }
        }
        return true;
    }
    
    function validateEstimateDetails($formvars) {
        $date_in = '';
        $estimate_sent_date = '';
        $estimate_approved_date = '';        
        
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);        
              
        if($formvars['estimate_sent_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['estimate_sent_date']);
            $estimate_sent_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $estimate_sent_date = '';
        }
        
        if($formvars['estimate_approved_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['estimate_approved_date']);
            $estimate_approved_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $estimate_approved_date = '';
        }
        
        if($estimate_sent_date != '') {
            if(strtotime($date_in) > strtotime($estimate_sent_date)) {                  
                $this->HandleError("Estimate Sent Date cannot be less than Date In");
                return false;
            } else if(strtotime($estimate_sent_date) > strtotime($estimate_approved_date)) {
                $this->HandleError("Estimate Approved Date cannot be less than Estimate Sent Date ");
                return false;
            } 
        } 
        return true;
    }
    
    
    function validateRepairDetails($formvars) {
        $date_in = '';
        $cleaning_end_date = '';
        $repair_start_date = '';
        $repair_end_date = '';        
        $body_status = $formvars['body_status'];
        $tank_status = $formvars['tank_status'];
        
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);   
        
        $date_to_check = $date_in;
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($cleaning_end_date != '') {
            $date_to_check = $cleaning_end_date;
        }
              
        if($formvars['repair_start_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_start_date']);
            $repair_start_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_start_date = '';
        }
        
        if($formvars['repair_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_end_date']);
            $repair_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_end_date = '';
        }
        
        if($repair_start_date != '' || $repair_end_date != '') {
            if(strtotime($date_to_check) > strtotime($repair_start_date)) {
                $this->HandleError("Repair Start Date cannot be less than Cleaning Date or Date In");
                return false;
            } else if($repair_end_date != '') {
                if(strtotime($repair_start_date) > strtotime($repair_end_date)) {
                    $this->HandleError("Repair End Date cannot be less than Repair Start Date ");
                    return false;
                }
            } 
        } else {
            if($body_status == 'Damaged') {
                if($tank_status == '25' || $tank_status == '29') {
                    $this->HandleError("Repair Start Date, Repair End Date should be selected");
                    return false;
                }
            }
        }
        return true;
    }
    
    
    function validateTestDetails($formvars) {
        
        $date_in = '';
        $cleaning_end_date = '';
        $test_date = '';                
        $is_test_due = $formvars['is_test_due'];
        $test_type = $formvars['test_type'];
                
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);   
        
        $date_to_check = $date_in;
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($cleaning_end_date != '') {
            $date_to_check = $cleaning_end_date;
        }
        
        if($formvars['test_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['test_date']);
            $test_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $test_date = '';
        }
                        
        if($test_date != '') {
            if($is_test_due == 'No') {
                $this->HandleError("Is Test Due should be Selected Yes");
                return false;
            } else if($test_type == '') {
                $this->HandleError("Test Type should be selected");
                return false;                
            } else {
                if(strtotime($date_to_check) > strtotime($test_date)) {
                    $this->HandleError("Test Date cannot be less than Date In and Cleaning Date");
                    return false;
                } 
            }
        } else {
            if($is_test_due == 'Yes') {
                if($test_type == '') {
                    $this->HandleError("Test Type should be selected");
                    return false;                
                } else if($tank_status == '25' || $tank_status == '29') {
                    $this->HandleError("Test Date should be selected");
                    return false;
                }
            }
        }
        return true;
    }
    
    function validateAvailableDate($formvars) {
        $date_in = '';
        
        $cleaning_end_date = '';        
        $repair_end_date = '';
        $test_date = '';  
        
        $available_date = '';  
                     
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);   
        
        $date_to_check = $date_in;
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($cleaning_end_date != '') {
            $date_to_check = $cleaning_end_date;
        }
        
        if($formvars['repair_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_end_date']);
            $repair_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_end_date = '';
        }
        
        if($repair_end_date != '') {
            $date_to_check = $repair_end_date;
        }
        
        if($formvars['test_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['test_date']);
            $test_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $test_date = '';
        }
        
        if($test_date != '') {
            $date_to_check = $test_date;
        }       
        
           
        if($formvars['available_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['available_date']);
            $available_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $available_date = '';
        }
        
        if($available_date != '') {
            if(strtotime($date_to_check) > strtotime($available_date)) {                  
                $this->HandleError("Available Date cannot be less than Date In, Cleaning date, Repair Date and Test Date");
                return false;
            } 
        }
        return true;
    }
    
    function validateDateoutDate($formvars) {
        $date_in = '';
        $cleaning_end_date = '';        
        $repair_end_date = '';
        $test_date = '';  
        $available_date = '';  
        $date_out = '';  
        $tank_status = $formvars['tank_status'];
                     
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);    
        
        $date_to_check = $date_in;
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($cleaning_end_date != '') {
            $date_to_check = $cleaning_end_date;
        }
        
        if($formvars['repair_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_end_date']);
            $repair_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_end_date = '';
        }
        
        if($repair_end_date != '') {
            $date_to_check = $repair_end_date;
        }
        
        if($formvars['test_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['test_date']);
            $test_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $test_date = '';
        }
        
        if($test_date != '') {
            $date_to_check = $test_date;
        }     
           
        if($formvars['available_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['available_date']);
            $available_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $available_date = '';
        }
        
        if($formvars['date_out'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['date_out']);
            $date_out = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $date_out = '';
        }
        
        if($date_out != '') {
            if($tank_status != '29') {
                $this->HandleError("Tank Status should be selected 'Tank Out' ");
                return false;
            } else if(strtotime($date_in) > strtotime($date_out)) {
                $this->HandleError("Date Out cannot be less than Date In");
                return false;
            } else if($available_date != '') {
                if(strtotime($available_date) > strtotime($date_out)) {
                    $this->HandleError("Date Out cannot be less than Available Date");
                    return false;
                }
            } else if($date_to_check != '') {
                if(strtotime($date_to_check) > strtotime($date_out)) {
                    $this->HandleError("Date Out cannot be less than Date In, Cleaning date, Repair Date and Test Date");
                    return false;
                }
            }
        } else {
            if($tank_status == '29') {
                $this->HandleError("Date Out Should be selected if tank status is 'Tank Out' ");
                return false;
            }
        }
        return true;
    }
    
    function IsFieldUnique($formvars, $fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select username from $this->tablename where $fieldname='".$field_val."'";
        $result = mysqli_query($this->connection,$qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function checkUsernameExists($formvars)
    {   
        $username = $this->SanitizeForSQL($formvars['username']);
        $depot_name = $this->SanitizeForSQL($formvars['depot_name']);
        
        $qry = "select id from registered_depot where depot_name = '".$depot_name."'";
        $result = mysqli_query($this->connection,$qry);
        $depot_id = '';
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $depot_id = $row['id'];
        }
        
        if($depot_id != '') {
            $qry1 = "select username from user_registration where username = '".$username."' AND depot_id = '".$depot_id."' ";
            $result1 = mysqli_query($this->connection,$qry1);   
            if($result1 && mysqli_num_rows($result1) > 0)
            {
                return false;
            }
        }
        return true;
    }
    
    function IsTankAlreadyIn($formvars, $fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $depot_name = $formvars['depot_name'];
        $qry = "SELECT * FROM incoming_tanks where $fieldname='".$field_val."' AND tank_status NOT IN ('29','30') AND depot_name = '".$depot_name."' ";
        //echo "SQL ->".$qry; exit();
        $result = mysqli_query($this->connection,$qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return true;
        }
        return false;
    }
    
    function IsTankAlreadyAdded($formvars)
    {
        //$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $tank_number = $this->SanitizeForSQL($formvars['tank_number']);        
		$sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);   
        
        $depot_name = $formvars['depot_name'];
        
        $qry = "SELECT * FROM incoming_tanks where tank_number='".$tank_number."' AND date_in = '".$date_in."' AND depot_name = '".$depot_name."' ";
        //echo "SQL ->".$qry; exit();
        $result = mysqli_query($this->connection,$qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return true;
        }
        return false;
    }
    
    function DBLogin()
    {       
        $this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd);
        
        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysqli_select_db($this->connection,$this->database))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysqli_query($this->connection,"SET NAMES 'UTF8'"))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysqli_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
        $qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        if(!mysqli_query($this->connection,$qry))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    } 
    
    function InsertIntoDB(&$formvars)
    {    
        //$confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        //echo "inside insert into DB"; exit();
        //$formvars['confirmcode'] = $confirmcode;
        $address = '';
        $insert_query = 'insert into registered_depots(
                depot_name,
                location,
                manager_name,
                address,                
                created_date                
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['depot_name']) . '",
                "' . $this->SanitizeForSQL($formvars['depot_location']) . '",
                "' . $this->SanitizeForSQL($formvars['first_name']) . '",
                "' . $this->SanitizeForSQL($address) . '",                
                "' . date('Y-m-d') . '"
                )';  
        //echo "insert query ->".$insert_query; exit();
        if(!mysql_query($insert_query, $this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }  
             
        $depot_id = mysql_insert_id($this->connection);
        
        //$confirmcode = 'n';
        $insert_query1 = 'insert into user_registration(
                first_name,
                last_name,
                email,
                phone_number,
                manager,
                username,
                password,
                confirmcode,
                depot_id,
                created_date
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['first_name']) . '",
                "' . $this->SanitizeForSQL($formvars['last_name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                "' . $this->SanitizeForSQL($formvars['first_name']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $this->SanitizeForSQL($formvars['confirm_code']) . '",
                "' . $depot_id . '",
                "' . date('Y-m-d') . '"
                )';    
        //echo "insert query ->".$insert_query1; exit();
        if(!mysql_query( $insert_query1 ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query1");
            return false;
        }        
        return true;
    }
    
    function InsertTankIntoDB(&$formvars)
    {    
        //$confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        //echo "date in before ->".$formvars['date_in'];

		//echo "Insert in db"; exit();
        $sep = '/';
        list($day, $month, $year) = explode($sep, $formvars['date_in']);
        $date_in = sprintf("%04d-%02d-%02d", $year, $month, $day);
        //echo "date in after ->".$txt;
              
        if($formvars['cleaning_start_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_start_date']);
            $cleaning_start_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_start_date = '';
        }
        
        if($formvars['cleaning_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['cleaning_end_date']);
            $cleaning_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $cleaning_end_date = '';
        }
        
        if($formvars['estimate_sent_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['estimate_sent_date']);
            $estimate_sent_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $estimate_sent_date = '';
        }
        
        if($formvars['estimate_approved_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['estimate_approved_date']);
            $estimate_approved_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $estimate_approved_date = '';
        }
                
        if($formvars['repair_start_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_start_date']);
            $repair_start_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_start_date = '';
        }
        
        if($formvars['repair_end_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['repair_end_date']);
            $repair_end_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $repair_end_date = '';
        }
               
        
        if($formvars['test_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['test_date']);
            $test_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $test_date = '';
        }
        
        if($formvars['available_date'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['available_date']);
            $available_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $available_date = '';
        }
        
        if($formvars['date_out'] != '') {
            list($day, $month, $year) = explode($sep, $formvars['date_out']);
            $date_out = sprintf("%04d-%02d-%02d", $year, $month, $day);
        } else {
            $date_out = '';
        }
                
        $depot_name = trim($formvars['depot_name'], '"');
        // $formvars['confirmcode'] = $confirmcode;
        $confirmcode = 'n';
        $insert_query = 'insert into incoming_tanks(
                customer_id,
                BranchID,
                tank_number,
                date_in,
                in_time,
                tank_status,
                cleaning_start_date,
                cleaning_end_date,
                cleaning_status,
                estimate_sent_date,
                estimate_approved_date,
                body_status,
                repair_start_date,
                repair_end_date,
                is_test_due,
                test_date,
                test_type,
                available_date,
                date_out,
                depot_name
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['customer_id']) . '",
                "' . $this->SanitizeForSQL($formvars['branch_id']) . '",
                "' . $this->SanitizeForSQL($formvars['tank_number']) . '",
                "' . $this->SanitizeForSQL($date_in) . '",
                "' . $this->SanitizeForSQL($formvars['in_time']) . '",
                "' . $this->SanitizeForSQL($formvars['tank_status']) . '",
                "' . $this->SanitizeForSQL($cleaning_start_date) . '",
                "' . $this->SanitizeForSQL($cleaning_end_date) . '",
                "' . $this->SanitizeForSQL($formvars['cleaning_status']) . '",
                "' . $this->SanitizeForSQL($estimate_sent_date) . '",
                "' . $this->SanitizeForSQL($estimate_approved_date) . '",
                "' . $this->SanitizeForSQL($formvars['body_status']) . '",
                "' . $this->SanitizeForSQL($repair_start_date) . '",
                "' . $this->SanitizeForSQL($repair_end_date) . '",
                "' . $this->SanitizeForSQL($formvars['is_test_due']) . '",
                "' . $this->SanitizeForSQL($test_date) . '",
                "' . $this->SanitizeForSQL($formvars['test_type']) . '",
                "' . $this->SanitizeForSQL($available_date) . '",
                "' . $this->SanitizeForSQL($date_out) . '",
                "' . $depot_name . '"
                )';
        //echo $insert_query;  exit();
        if(!mysql_query( $insert_query ,$this->connection))
        {
            //echo "inside if";
           //  exit();
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
        //exit();
        return true;
    }
    
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
}
?>