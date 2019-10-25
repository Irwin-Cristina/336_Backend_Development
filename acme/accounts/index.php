<?php
/*
 * Accounts Controller
 */

//Create or access a Session
session_start();
$_SESSION['message'] = NULL;


// Get the database connection file
 require_once '../library/connections.php';
// Get the acme model for use as needed
 require_once '../model/acme-model.php';
// Get the accounts model
 require_once '../model/accounts-model.php';
 // Get the functions library
 require_once '../library/functions.php';
 // Get the products model
 require_once '../model/products-model.php';
 // Get the image model
 require_once '../model/uploads-model.php';
 // Get the reviews model
 require_once '../model/reviews-model.php';
 
 
// Get the array of categories
$categories = getCategories();
$navList = contructNav();







$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
            //if ($action == NULL) {
            //$action = 'login';
            // }
}
 
 
 
//Direct where to go
 
switch ($action){
    // directs to login.php
    case 'login':
        include '../view/login.php';
        break;

    // directs to registration.php
    case 'registration':
        include '../view/registration.php';
        break;
    
    case 'Login':
    // Filter and store the data  
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      //$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);  
      $clientEmail = checkEmail($clientEmail);
        
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      $checkPassword = checkPassword($clientPassword);
      
      // For client reviews
      //$clientId = $_SESSION['clientData']['clientId'];

     // $getReviewbyclientid = getReviewbyclientid($clientId);
     // $buildReviewbyclient = buildReviewbyclient($getReviewbyclientid);
      
      // Check for missing data
     if(empty($clientEmail) || empty($checkPassword)){
        $_SESSION['message'] = '<p class="notifyr">Please provide correct information for all form fields.</p>';
        include '../view/login.php';
        exit;
     }
      
     // A valid password exists, proceed with the login process
     // Query the client data based on the email address
     $clientData = getClient($clientEmail);
     // Compare the password just submitted against
     // the hashed password for the matching client
     $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
     // If the hashes don't match create an error
     // and return to the login view
     if(!$hashCheck) {
        $_SESSION['message'] = '<p class="notifyr">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
     }
     // A valid user exists, log them in
     $_SESSION['loggedin'] = TRUE;
     // Remove the password from the array
     // the array_pop function removes the last
     // element from an array
     
     setcookie('firstname', $clientFirstname, strtotime('-1 year'), '/');
     
     array_pop($clientData);
     // Store the array into the session
     $_SESSION['clientData'] = $clientData;
     
     // For client reviews
      $clientId = $_SESSION['clientData']['clientId'];

      $getReviewbyclientid = getReviewbyclientid($clientId);
      $buildReviewbyclient = buildReviewbyclient($getReviewbyclientid);
     // Send them to the admin view
     header('Location: /acme/accounts');
     exit;
    break;
     
     //user NOT logged in
     //$_SESSION['loggedin'] = FALSE;
     //include 'acme/index.php';
     //exit;
       
    
   case 'logout';
    session_destroy();
    header('Location: /acme/accounts/?action=login');
    break;
        
    
    case 'register':
    // Filter and store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      
      //Checking for existing email address
      $existingEmail = checkExistingEmail($clientEmail);
      
        
      if($existingEmail){
         $message = '<p class="notifyb">That email address already exists. Do you want to login instead?</p>';
         include '../view/registration.php';
         exit;
         }
         
//      if($_SESSION['clientData']['clientEmail'] != $clientEmail && $existingEmail){
//        $message = '<p class="notice">That email address already exists. Is there another email address you wanted to use?</p>';
//        include '../view/client-update.php';
//        exit;
//        }
    
         
     // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p class="notifyr">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
        }
  
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
    
        // Check and report the result
            if($regOutcome){
                
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class='notifyb'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";        
               // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /acme/accounts/?action=login');
               // include '../view/login.php';
                exit;
                
            } else {
                $message = "<p class='notifyr'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
               }
        break;

    case 'update':
        include '../view/client-update.php';
        exit;
      break;
    
    case 'updateAccount':
        //Update, Filter and store data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = $_SESSION['clientData']['clientId'];
        //Checking for existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        $checkCurrentEmail = checkCurrentEmail($clientEmail);
        $checkEmail = checkEmail($clientEmail);
            if (!$checkEmail){
          $message = '<p class="notifyr">Please provide a valid email.</p>';
          include '../view/client-update.php';
          exit; 
          }
        

     //if $existingEmail = 1 AND $checkCurrentEmail with specific id, equals another clientId
        if($existingEmail && $checkCurrentEmail['clientId'] !=$clientId){
         $message = '<p class="notifyb">That email address already exists. Please use another email address?</p>';
         include '../view/admin.php';
         exit;
         }
         
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
          $message = '<p class="notifyr">You left a field blank, please try again.</p>';
          include '../view/client-update.php';
          exit; 
          }
        
        // Send the data to the model
        $updateClient = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    
        // Check and report the result
            if($updateClient){
                $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
                $_SESSION['clientData']['clientLastname'] = $clientLastname;
                $_SESSION['clientData']['clientEmail'] = $clientEmail;
                
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class = 'notifyb'>Thanks for updating $clientFirstname. Please use your email and password to login.</p>";        
               // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /acme/accounts/');
               // include '../view/login.php';
                exit;
                
            } else {
                $message = "<p class='notifyr'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
                 header('Location: /acme/accounts/?action=update');
                exit;
               }
        
        break;
    
    case 'changePassword':
        //Update, Filter and store data
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);
        $clientId = $_SESSION['clientData']['clientId'];
        if (!$checkPassword){
          $message = '<p class="notifyr">Please provide a valid password.</p>';
          include '../view/client-update.php';
          exit; 
          }
        
        // Check for missing data
        if(empty($clientPassword)){
          $message = '<p class="notifyr">Please provide information for all empty form fields.</p>';
          include '../view/client-update.php';
          exit; 
          }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        // Send the data to the model
        $updatePassword = updatePassword($hashedPassword, $clientId);
        // Check and report the result
            if($updatePassword){
            
                //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class ='notifyb'>Thanks for updating password. Please use your email and password to login.</p>";        
               // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /acme/accounts/');
               // include '../view/login.php';
                exit;
                
            } else {
                $message = "<p class='notifyr'>Sorry, the password update failed. Please try again.</p>";
                include '../view/client-update.php';
                exit;
               }
        
        break;
        
        
    default:
        
        //$clients = getclientBasics();
        $clientId = $_SESSION['clientData']['clientId'];

        $getReviewbyclientid = getReviewbyclientid($clientId);
        $buildReviewbyclient = buildReviewbyclient($getReviewbyclientid);
           
        
        
        include '../view/admin.php';
         break;
  
}
