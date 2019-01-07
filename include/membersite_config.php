<?PHP
require_once("./include/fg_membersite.php");
error_reporting(0);
$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('satyanaraink@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'needate1_needa',
                      /*password*/'needa123#',
                      /*database name*/'needate1_ian_project',
                      /*table name*/'user_registration');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>