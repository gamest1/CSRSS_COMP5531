<?php
include_once("../models/users.php");
include_once("../models/parts.php");

class LoginController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Users();

    } 
	
	public function login($username,$password)
	{
		
				if($this->model->login($username,$password)) {
					//Good!! You logged in! 
					$tmp = new Parts();
					$parts = $tmp->getAllParts();
					include '../views/mainView.php';
					return;
				}
				else {
					//Reload the loginView with a message:
					$message = "Wrong credentials! Please, try again.";
					include '../views/loginView.php';
					return;
				}
	}
}


session_start();

if(isset( $_SESSION['employeeID'] ))
{   
	//User is already logged in:
	$tmp = new Parts();
	$parts = $tmp->getAllParts();
    include '../views/mainView.php';
    return;
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = "You are crazy! You are invoking this with wrong post attributes!";
    include '../views/loginView.php';
    return;
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username: Please enter between 4 and 20 characters';
    include '../views/loginView.php';
    return;
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password: Please enter between 4 and 20 characters';
    include '../views/loginView.php';
    return;
}
/*** check the username has only alpha numeric characters or a . ***/
// elseif (ctype_alnum($_POST['username']) != true && )
// {
//     /*** if there is no match ***/
//     $message = "Username must be alpha numeric";
//     include '../views/loginView.php';
// }
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	//Okay, if everything is okay, process this login:
		$controller = new LoginController();
		$controller->login($username,$password);
   
}

?>