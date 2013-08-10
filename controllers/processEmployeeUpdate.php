<?php
include_once("../models/employees.php");

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
    $value = stripslashes($value);
}

class ProcessEmployeeUpdate {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Employees();
    } 

    public function loadViewWithMessage($message)
	{
		 $message .= "";
		 include '../views/genericMessageView.php';
		 return;
	}

   public function loadUpdateViewWithAlert($alert,$content)
  {
     $alert .= "";
     $employees = $this->model->getAllEmployeesInfo();
     include '../views/updateEmployeesView.php';
     return;
  }

}

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first!";
	include '../views/loginView.php';
	return;
}
else if (!isset($_POST['newButton']) && !isset($_POST['updateButton']) ) {
	$message = "Controller called from bogus source! Exiting...";
	include '../views/loginView.php';
	return;
}
else
{   
	  $controller = new ProcessEmployeeUpdate();
    $message = "Processing your request...";
    
    array_filter($_POST, 'trim_value');
    $postfilter =    // set up the filters to be used with the trimmed post array
    array(
        'employeeID' => array('filter' => FILTER_SANITIZE_NUMBER_INT), 
        'newEmployeeID' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'employeeSelector' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'firstName' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH), 
        'lastName' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'firstDayWork' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'online_fee' => array('filter' => FILTER_SANITIZE_NUMBER_INT), 
        'service_fee' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'base_salary' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'phone' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'isAdmin' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'address' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES), 
        'username' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'updateButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)
    );



    $post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
 
    $where = $post_array['employeeSelector'];

    if ($where == "new") {
           //For a new employee, we need to perform a few things:    
           if ($post_array['newEmployeeID'] == NULL || strlen($post_array['newEmployeeID']) < 5 ) {
                $message = "Employee ID must have 5 characters!";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }

           if ($post_array['username'] == NULL || $post_array['username'] == "" ) {
                $message = "You must provide a Username to create new employee!";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }  

            if ($post_array['firstDayWork'] == NULL || $post_array['firstDayWork'] == "" ) {
                $message = "Every employee started working at some point! and we need to know to calculate the seniority of this employee";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }
    }

            if ($post_array['firstName'] == NULL || $post_array['firstName'] == "" ) {
                $message = "Every employee has a First Name! You can't leave this field empty";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            } 

            if ($post_array['lastName'] == NULL || $post_array['lastName'] == "" ) {
                $message = "Every employee has a Last Name! You can't leave this field empty";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }



            if ($where == "new") {
                $employeeID = $post_array['newEmployeeID'];
                $username = $post_array['username'];
            }
            else if ($where == "update") {
                $employeeID = $post_array['employeeID'];
            }
        

           $firstName = $post_array['firstName'];
           $lastName = $post_array['lastName'];
           $firstDayWork = $post_array['firstDayWork'];

           if(isset($post_array['online_fee']) && $post_array['online_fee'] != "") $onlinefee = $post_array['online_fee'];
           else $onlinefee = "NULL";

           if(isset($post_array['service_fee']) && $post_array['service_fee'] != "") $servicefee = $post_array['service_fee'];
           else $servicefee = "NULL";

           if(isset($post_array['isAdmin']) && $post_array['isAdmin'] == "1") $isAdmin = 1;
           else $isAdmin = 0;

           if(isset($post_array['base_salary']) && $post_array['base_salary'] != "") $baseSalary = $post_array['base_salary'];
           else $baseSalary = "NULL";

           if(isset($post_array['address']) && $post_array['address'] != "") $address = $post_array['address'];
           else $address = "NULL";

           if(isset($post_array['phone']) && $post_array['phone'] != "") $phone = $post_array['phone'];
           else $phone = "NULL";
           
           //Process this new employee by adding it to CSRSS_Employees:
           if ($where == "new") {
            $tmp = $controller->model->addNewEmployee($employeeID,$username,$onlinefee,$isAdmin,$firstName,$lastName,$firstDayWork,$baseSalary,$address,$phone);
           }
           else if ($where == "update") {
            $tmp = $controller->model->updateEmployee($employeeID,$onlinefee,$servicefee,$isAdmin,$firstName,$lastName,$firstDayWork,$baseSalary,$address,$phone);
           }
           
           if($tmp == "ERROR") {
            $controller->loadUpdateViewWithAlert("Sorry! We found a problem while trying to create/update Employee ID.",$post_array);
            return;
           }
           else {
            $message = $tmp . "<br />";
           }          
  
  //Done!
  $controller->loadViewWithMessage($message);
  return;  
}

?>