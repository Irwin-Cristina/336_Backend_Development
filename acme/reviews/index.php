<?php

/* 
 REVIEW CONTROLLER
 */

session_start();
$_SESSION['message'] = NULL;

if (isset($_SESSION['clientData'])) {
//$clientId = $_SESSION['clientData']['clientData'];    
$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientScreenname = substr($clientFirstname, 0, 1) . $clientLastname;
}


// Get the database connection file
 require_once '../library/connections.php';
 // Get the functions library
 require_once '../library/functions.php';
// Get the acme model for use as needed
 require_once '../model/acme-model.php';
// Get the products model
 require_once '../model/products-model.php';
 // Get the image model
 require_once '../model/uploads-model.php';
 // Get the review model
 require_once '../model/reviews-model.php';
 
 
 // Collect GET and POST from browser
 $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

//Get categories and build Navigation
$categories = getCategories();
$navList = contructNav();

 

switch ($action) {
    // Add a new review
    case 'newreview':
        //Filter and store data
        $reviewText = filter_input(INPUT_POST,'reviewText', FILTER_SANITIZE_STRING);  
//        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
       // $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = $_SESSION['clientData']['clientId'];
        
        $prodId = filter_input(INPUT_GET, 'prodId', FILTER_SANITIZE_STRING);
        $products = getProductDetail($prodId);
        
        $getReviewbyinvid = getReviewbyinvid($prodId);
        $buildReview = buildReview($getReviewbyinvid);
        
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientscreenName = substr($clientFirstname, 0, 1) . $clientLastname;
        
        // Check for missing data
        if(empty($reviewText) || empty($invId) || empty($clientId)){
            $_SESSION['message'] = '<p class="notifyr">Review left blank, please try again.</p>';
            header("Location: /acme/products/?action=productDetail&prodId=$invId&type=$invId");
            //include '../view/product-detail.php';
            //include "/acme/products/?action=productDetail&prodId=$invId&type=$invId";
            exit; 
        }
        //Send the data to the model
        $regOutcome = newReview($reviewText, $invId, $clientId);
          
        //Check and report result
        if($regOutcome) {
            $_SESSION['message'] = "<p class='notifyb'>Thanks for reviewing.</p>";
            header("Location: /acme/products/?action=productDetail&prodId=$invId");
            exit;
        } else {
            $message = "<p class='notifyr'>Sorry, but the review failed. Please try again.</p>";
            include '../view/review.php';
            exit;
          }
         
     break;
     
    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        //$invName = filter_input(INPUT_GET,'invName', FILTER_VALIDATE_STRING);
        //$invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        //$clientId = $_SESSION['clientData']['clientId'];
        //$products = $getReviewbyclientid($reviewId);
        //$imageArray = $reviewByreviewidArray($reviewId);
        
//        $invidInfo = getReviewbyinvIdh($invId);
//        if(count($invidInfo)<1) {
//            $message = '<p class="notify">Sorry, no reviews could be found.</p>';
//        }
        
        $reviewByreviewidArray = getReviewbyreviewId($reviewId);
        if(count($reviewByreviewidArray)<1) {
            $message = '<p class="notifyr">Sorry, no reviews could be found.</p>';
        }        
       // echo $reviewByreviewidArray ['invName'];
       // exit;
//        $clientInfo = $getReviewbyclientid($clientId);
//            if(count($clientInfo)<1){
//                $message = '<p class="notify">Sorry, no reviews could be found.</p>';
//            }
        include '../view/edit-review.php';
        exit;
        break;
    
     
     
    // Deliver a view to edit a review 
    case 'editreview':
        // update, filter and store data
        $reviewId = filter_input(INPUT_POST,'reviewId', FILTER_SANITIZE_STRING);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        //$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_STRING);
        //$clientId = $_SESSION['clientData']['clientId'];
        $reviewByreviewidArray = getReviewbyreviewId($reviewId);

        // Check for missing data
        //echo $reviewId;
        //exit;
        
        if(empty($reviewId) || empty($reviewText)){
            $message = '<p class="notifyr">You left the review blank, please try again.</p>';
            
            include '../view/edit-review.php';
           //header('Location: /acme/reviews/?action=editreview');

            exit; 
            }
            
            //Send the data to the model
            $updateReview = updateReview($reviewId, $reviewText);

            //Check and report the results
            if($updateReview){
                //$message = "<p class = 'notifyb'>Thanks for updating your review.</p>";
                $_SESSION['message'] = "<p class = 'notifyb'>Thanks for updating your review.</p>";
              //  $_SESSION['message'] = "<p class = 'notifyb'>Thanks for updating your review.</p>";        
                header('Location: /acme/accounts/');
                 exit;
            } else {
                $message = "<p class='notifyr'>Sorry but the review update failed. Please try again.</p>";
                header('Location: /acme/reviews/?action=editreview');
                //include '../view/edit-review.php';
                exit;
                   }

            break;
            
    case 'delete':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
        //$prodId = filter_input(INPUT_GET, 'prodId', FILTER_SANITIZE_STRING);
        //$clientId = $_SESSION['clientData']['clientId'];
        //$clientId = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT);
        
        //$clientInfo = $getReviewbyclientid($clientId);
        $reviewByreviewidArray = getReviewbyreviewId($reviewId);
        if(count($reviewByreviewidArray)<1) {
            $message = '<p class="notifyr">Sorry, no reviews could be found.</p>';
        }    
        include '../view/delete-review.php';
        break;       
            
    // Handle the review deletion      
    case 'deletereview':
        
        //Delete, Filter and store data
        $reviewId = filter_input(INPUT_POST,'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
//        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
//         $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);

        //Send the data to the model
        $deleteReview = deleteReview($reviewId);

        //Check and report the result
            if($deleteReview){
                $message = "<p class='notify'>Review was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                 header('location: /acme/reviews/');
                 exit;
            } else {
                $message = "<p class='notify'>Error. Sorry, your review was not deleted. Please try again.</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/reviews/');
                //include '../view/delete-review.php';
                exit;
                }

            break;
 
 default:
    if($_SESSION['loggedin']) {
        header('location: /acme/accounts/');
        exit;
    } else{
        header('location: /acme');  
    }   
}
