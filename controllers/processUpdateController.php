<?php
include_once("../models/parts.php");

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
    $value = stripslashes($value);
}

class ProcessUpdateController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Parts();
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
     include '../views/updatePartsView.php';
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
	  $controller = new ProcessUpdateController();
    $message = "Processing your request...";
    
    array_filter($_POST, 'trim_value');
    $postfilter =    // set up the filters to be used with the trimmed post array
    array(
        'partID' => array('filter' => FILTER_SANITIZE_NUMBER_INT), 
        'newPartID' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'partSelector' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'partName' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),   
        'description' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES), 
        'cost' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'installationCost' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'partCategory' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'hiddenType' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'numberSold' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'numberAvailable' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'wholePrice' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'processor' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'os' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'antivirus' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'ram' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'memory_specs' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'gb' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'storage_specs' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'otherInfo' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES),
        'enclosure' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'power_unit' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'mother_board' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'monitor' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'mouse' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'keyboard' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'screen_size' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'battery_life' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
        'battery_specs' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'purchaseDate' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'updateButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
    );



    $post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
 
    $where = $post_array['partSelector'];

    if ($where == "new") {
           //For a new part, we need to perform a few things:    
           if ($post_array['newPartID'] == NULL || strlen($post_array['newPartID']) < 10 ) {
                $message = "Part ID must have 10 characters!";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }

           if ($post_array['partCategory'] == NULL || $post_array['partCategory'] == "" ) {
                $message = "You must select a part category to create new item!";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            }  
    }

            if ($post_array['partName'] == NULL || $post_array['partName'] == "" ) {
                $message = "You must provide a Part Name to create new item!";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            } 

            if ($post_array['cost'] == NULL || $post_array['cost'] == "" ) {
                $message = "Every part has a Public Price! You can't leave this field empty";

                //RELOAD SAME VIEW WITH MESSAGE!
                $controller->loadUpdateViewWithAlert($message,$post_array);
                return;
            } 

            if ($post_array['installationCost'] == NULL || $post_array['installationCost'] == "" ) {
                 $installationCost = 0;
            } 
            else $installationCost = $post_array['installationCost'];


            if ($where == "new") {
                $partID = $post_array['newPartID'];
            }
            else if ($where == "update") {
                $partID = $post_array['partID'];
            }
        
           $partName = $post_array['partName'];


           if(isset($post_array['description']) && $post_array['description'] != "") $description = $post_array['description'];
           else $description = "NULL";

           $cost = $post_array['cost'];

           //Process this new part by adding it to CSRSS_Parts:
           if ($where == "new") {
            $part_type = $post_array['partCategory'];
            $tmp = $controller->model->addNewPart($partID,$partName,$description,$part_type,$cost,$installationCost);
           }
           else if ($where == "update") {
            $part_type = $post_array['hiddenType'];
            $tmp = $controller->model->updateExistingPart($partID,$partName,$description,$cost,$installationCost);
           }
           
           if($tmp == "ERROR") {
            $controller->loadUpdateViewWithAlert("Sorry! We found a problem while trying to create/update Part ID.",$post_array);
            return;
           }
           else {
            $message = $tmp . "<br />";
           }

           //Now proceed to create new inventory instance:

           if(isset($post_array['numberSold']) && $post_array['numberSold'] != "" && $post_array['numberSold'] != "0")
               $numberSold = $post_array['numberSold'];
           else $numberSold = "0";

            $tmp = "To create/update an Inventory Instance ";
            if ($post_array['numberAvailable'] == NULL || $post_array['numberAvailable'] == "" ) {
                $tmp .= "you must provide a number of available items,";
            } 

            if ($post_array['wholePrice'] == NULL || $post_array['wholePrice'] == "" ) {
                $tmp .= "specify the whole price you paid to acquire this item.";
            }  

            $tmp = substr($tmp, 0, -1);
            if ($tmp != "To create/update an Inventory Instance") {
                $message .= $tmp;
            }
            else {
               $numberAvailable = $post_array['numberAvailable'];
               $wholePrice = $post_array['wholePrice'];

               //Add it to CSRSS_Inventory:
               if ($where == "new") {
                  $tmp = $controller->model->addPartToInventory($partID,$numberSold,$numberAvailable,$wholePrice);
      
                  if($tmp != "ERROR") {
                    $message .= $tmp . "<br />";

                    $tmp = "";
                    if ($post_array['purchaseDate'] == NULL || $post_array['purchaseDate'] == "" ) {
                      $tmp .= "To add an instance to the Purchase History, you must provide a valid purchase date!" . "<br />";
                    } 

                    if ($tmp != "") {
                      $message .= $tmp;
                    }
                    else {
                      $purchaseDate = $post_array['purchaseDate'];
                      //Add it to CSRSS_PurchaseHistory:
                      $message .= $controller->model->addPartToPurchaseHistory($partID,$purchaseDate,$numberAvailable) . "<br />";
                    }
                  }       
               }
               else if ($where == "update") {

                $tmp = "";
                if ($post_array['purchaseDate'] == NULL || $post_array['purchaseDate'] == "" ) {
                    $tmp .= "To add an instance to the Purchase History, you must provide a valid purchase date!" . "<br />";
                } 

                if ($tmp != "") {
                    $message .= $tmp;
                }
                else {
                    $purchaseDate = $post_array['purchaseDate'];
                    //Update CSRSS_Inventory and CSRSS_PurchaseHistory:
                    $message .= $controller->model->updateInventoryPart($partID,$numberSold,$numberAvailable,$wholePrice,$purchaseDate) . "<br />";
                }
               }
            }
               
           
            if($part_type == "desktop" || $part_type == "laptop") {

                $tmp = "To create a new computer item, you must specify ";
                if ($post_array['processor'] == NULL || $post_array['processor'] == "" ) {
                    $tmp .= "processor type,";
                } 
                if ($post_array['os'] == NULL || $post_array['os'] == "" ) {
                    $tmp .= "operating system,";
                } 
                if ($post_array['memory_specs'] == NULL || $post_array['memory_specs'] == "" ) {
                    $tmp .= "memory specifications,";
                } 
                if ($post_array['storage_specs'] == NULL || $post_array['storage_specs'] == "" ) {
                    $tmp .= "storage specifications,";
                }
                $tmp = substr($tmp, 0, -1);

                if ($tmp != "To create a new computer item, you must specify" ) {
                    $message .= $tmp . ". <br />";
                }
                else {
                      $processor = $post_array['processor'];
                      $os = $post_array['os'];
                      $memory_specs = $post_array['memory_specs'];
                      $storage_specs = $post_array['storage_specs'];

                      if(isset($post_array['antivirus']) && $post_array['antivirus'] != "")
                         $antivirus = $post_array['antivirus']; 
                      else  $antivirus = "NULL"; 

                      if(isset($post_array['ram']) && $post_array['ram'] != "")
                         $ram = $post_array['ram']; 
                      else  $ram = "NULL"; 

                      if(isset($post_array['gb']) && $post_array['gb'] != "")
                         $gb = $post_array['gb']; 
                      else  $gb = "NULL"; 
 
                      if(isset($post_array['otherInfo']) && $post_array['otherInfo'] != "")
                         $otherinfo = $post_array['otherInfo']; 
                      else  $otherinfo = "NULL"; 

                       //Add it to CSRSS_Computer:
                       if ($where == "new") {
                        $tmp = $controller->model->addNewComputerItem($partID,$processor,$os,$antivirus,$ram,$memory_specs,$gb,$storage_specs,$part_type,$otherinfo);
                       }
                       else if ($where == "update") {
                        $tmp = $controller->model->updateComputerItem($partID,$processor,$os,$antivirus,$ram,$memory_specs,$gb,$storage_specs,$part_type,$otherinfo);
                       }
                
                       if($tmp != "ERROR") {
                            $message .= $tmp . "<br />";

                            if($part_type == "desktop") {

                              if(isset($post_array['enclosure']) && $post_array['enclosure'] != "")
                                $enclosure = $post_array['enclosure'];
                              else $enclosure = "NULL";

                              if(isset($post_array['power_unit']) && $post_array['power_unit'] != "")
                                $power_unit = $post_array['power_unit'];
                              else $power_unit = "NULL";

                              if(isset($post_array['mother_board']) && $post_array['mother_board'] != "")
                                $mother_board = $post_array['mother_board'];
                              else $mother_board = "NULL";

                              if(isset($post_array['monitor']) && $post_array['monitor'] != "")
                                $monitor = $post_array['monitor'];
                              else $monitor = "NULL"; 

                              if(isset($post_array['mouse']) && $post_array['mouse'] != "")
                                $mouse = $post_array['mouse'];
                              else $mouse = "NULL";
                       
                              if(isset($post_array['keyboard']) && $post_array['keyboard'] != "")
                                $keyboard = $post_array['keyboard'];
                              else $keyboard = "NULL";

                              //Add it to CSRSS_DesktopComputer:
                              if ($where == "new") {
                                $message .= $controller->model->addNewDesktopItem($partID,$enclosure,$power_unit,$mother_board,$monitor,$mouse,$keyboard) . "<br />";
                              }
                              else if ($where == "update") {
                                $message .= $controller->model->updateDesktopItem($partID,$enclosure,$power_unit,$mother_board,$monitor,$mouse,$keyboard) . "<br />";
                              }                        
                            }
                            else if($part_type == "laptop") {

                              if(isset($post_array['screen_size']) && $post_array['screen_size'] != "")
                                $screen_size = $post_array['screen_size'];
                              else $screen_size = "NULL"; 

                              if(isset($post_array['battery_life']) && $post_array['battery_life'] != "")
                                $battery_life = $post_array['battery_life'];
                              else $battery_life = "NULL";
                       
                              if(isset($post_array['battery_specs']) && $post_array['battery_specs'] != "")
                                $battery_specs = $post_array['battery_specs'];
                              else $battery_specs = "NULL";

                              //Add it to CSRSS_LaptopComputer:
                              if ($where == "new") {
                                $message .= $controller->model->addNewLaptopItem($partID,$screen_size,$battery_life,$battery_specs) . "<br />";
                              }
                              else if ($where == "update") {
                                $message .= $controller->model->updateLaptopItem($partID,$screen_size,$battery_life,$battery_specs) . "<br />";
                              }                
                            }
                            else {
                              $message .= " Impossible to get here!" . "<br />";
                            }
                       }
                }
            } 
  
  //Done!
  $controller->loadViewWithMessage($message);
  return;  
}

?>