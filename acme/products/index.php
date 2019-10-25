<?php
/*
 * Products Controller
 */

//Create or access a Session
session_start();
$_SESSION['message'] = NULL;

//Bring in sessions name for "screenname"on review form

if (isset($_SESSION['clientData'])) {
//$clientId = $_SESSION['clientData']['clientData'];    
$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientScreenname = substr($clientFirstname, 0, 1) . $clientLastname;
}

//    if($_SESSION['clientData']['clientLevel'] <= 1) {
//        header('location:/acme/');
//        exit;
//    }
           

// Get the database connection file
 require_once '../library/connections.php';
// Get the acme model for use as needed
 require_once '../model/acme-model.php';
  // Get the products model
 require_once '../model/products-model.php';
 // Get the functions library
 require_once '../library/functions.php';
 // Get the image model
 require_once '../model/uploads-model.php';
 // Get the reviews model
 require_once '../model/reviews-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 
// Get the array of categories
 $categories = getCategories();
 
 
// Build a navigation bar using the $categories array
//$navList = '<ul>';
//$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//    foreach ($categories as $category) {
//        $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//         }
//$navList .= '</ul>';

//Build Nav from functions.php
$navList = contructNav();

//Build a drop down menu using the $catList array
//$catList = "<select name='categoryId'>";
//$catList .="<option>Choose a Category</option>";
//    foreach ($categories as $category) {
//        $catList .= "<option value='$category[categoryId]'> $category[categoryName]</option>";
//        }
//        $catList .= "</select>";

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
            //if ($action == NULL) {
            //$action = 'home';
            // }
}
 
//Direct where to go
 
switch ($action){
    // directs to new-cat.php
    //case 'category':
      //  include '../view/prod-mgmt.php';
       // break;
    
    // directs to new-cat.php with message when input is blank
    case 'newCategory':
        // Filter and store the data
           $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
           
        // Check for missing data
        if(empty($categoryName)){
            $message = '<p class="notify">Please provide information for all empty form fields.</p>';
             
            include '../view/new-cat.php';
            exit;
             }
             
        // Send the data to the model
        $catOutcome = newCat($categoryName);
            
        // Check and report the result
            if($catOutcome === 1){
               $message = "<p class='notify'>Thanks for adding $categoryName.</p>";
               $_SESSION['message']=$message;
               header('location:/acme/products/');
               
               include '../view/prod-mgmt.php';
               exit;
               
            } else {
               $message = "<p class='notify'>Sorry $categoryName was not added. Please try again.</p>";
               include '../view/new-cat.php';
               exit; 
               }
               break;
               
    case 'product':
        include '../view/new-product.php';
        break;
               
    case 'addNewproduct':
        //Filter and store data
            $categoryId = filter_input(INPUT_POST,'categoryId', FILTER_SANITIZE_STRING);  
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT); 
//            FILTER_FLAG_ALLOW_FRACTION
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            
//      
        //Check for missing data
            if(empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
                $message = '<p class="notify">Please complete all information for the new item! Double check the category of the item.</p>';
                include '../view/new-product.php';
                exit;
            }
     
     
            //Send the data to the model
            $productOutcome = getProducts($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
       
            //Check and report the result
                if ($productOutcome === 1){
                    $message = "<p class='notifyb'>Thank you for adding $invName.</p>";
                    include '../view/prod-mgmt.php';
                    exit;
                    
                } else {
                    $message = "<p class='notify'>Error! Sorry $invName did not input correctly. Please try again.</p>";
                    include '../view/new-product.php';
                    exit;
                }
            break;
     
            
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
          if(count($prodInfo)<1){
            $message = '<p class="notify">Sorry, no product information could be found.</p>';
          }
          include '../view/prod-update.php';
          exit;
        break;
     
    case 'updateProd':
         //Update, Filter and store data
            $categoryId = filter_input(INPUT_POST,'categoryId', FILTER_SANITIZE_STRING);  
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT); 
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
        //Check for missing data
            if(empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
                $message = '<p class="notify">Please complete all information for the updated item! Double check the category of the item.</p>';
                include '../view/prod-update.php';
                exit;
            }
     
            //Send the data to the model
            $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, 
                    $invLocation, $invVendor, $invStyle, $invId);
       
            //Check and report the result
                if ($updateResult){
                    $message = "<p class='notify'>$invName was successfully updated. Thank you for updating $invName.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /acme/products/');
                    exit;
                } else {
                    $message = "<p class='notify'>Error. Sorry $invName did not update correctly. Please try again.</p>";
                    
                    include '../view/prod-update.php';
                    exit;
                }
        break;
    
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        
        
        
          if(count($prodInfo)<1){
            $message = '<p class="notify">Sorry, no prouct information could be found.</p>';
          }
          include '../view/prod-delete.php';
          exit;
        break;
        
    case 'deleteProd':
        //Delete, Filter and store data
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
     
            //Send the data to the model
            $deleteResult = deleteProduct($invId);
       
            //Check and report the result
                if ($deleteResult){
                    $message = "<p class='notify'>$invName was successfully deleted.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /acme/products/');
                    exit;
                } else {
                    $message = "<p class='notify'>Error. Sorry $invName did not deleted. Please try again.</p>";
                     $_SESSION['message'] = $message;
                    header('location: /acme/products/');
                    exit;
                }
        
        break;
        
    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if(!count($products)){
           $message = "<p class='notify'>Sorry, no $type products can be found.</p>";
        } else {
          $prodDisplay = buildProductsDisplay($products);
        }
        
      
        
  include '../view/category.php';
        break;
        
   case 'productDetail':
       
        $prodId = filter_input(INPUT_GET, 'prodId', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_STRING);
      
        $products = getProductDetail($prodId);
        $imageArray = getallThumbnail($prodId);
        
        $getReviewbyinvid = getReviewbyinvid($prodId);
        $buildReview = buildReview($getReviewbyinvid);
        
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        
        $clientscreenName = substr($clientFirstname, 0, 1) . $clientLastname;
        
        
        if(!count($products)){
           $message = "<p class='notifyr'>Sorry, no $prodId can be found.</p>";
        } else {
          $prodDetail = buildProductView($products);
        }
        if(!count($imageArray)){
           $message = "<p class='notifyr'> No $prodId thumbnails can be found.</p>";
        } else {
        $showThumbnail = buildthumbnails($imageArray);
        }
        if(!count($getReviewbyinvid)){
           $message = "<p class='notifyr'>There are no reviews for this product, please be the first.</p>";
        } else {
            $message = "<p class='notifyb'>Please add to the existing reviews.</p>";
        }



        
        
       
      include '../view/product-detail.php';
      break;
        
        
        
 
    default:
       $products = getProductBasics();
       if(count($products) > 0){
        $prodList = '<table>';
        $prodList .= '<thead>';
        $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
        $prodList .= '</thead>';
        $prodList .= '<tbody>';
       foreach ($products as $product) {
        $prodList .= "<tr><td>$product[invName]</td>";
        $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
        $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
       }
        $prodList .= '</tbody></table>';
       } else {
        $message = '<p class="notify">Sorry, no products were returned.</p>';
}
       
       
        include '../view/prod-mgmt.php';
      break;
        
}
