<?php

/* 
 * Products Model
 */



// Insert new category to database

function newCat($categoryName){
      // Create a connection object from the acme connection function
    $db = acmeConnect(); 
      // The SQL statement to be used with the database 
    $sql = 'INSERT INTO categories (categoryName)
         VALUES (:categoryName)'; 
      // The next line creates the prepared statement using the acme connection       
    $stmt = $db->prepare($sql);
      // The next line replace the placeholder in the SQL
      // statement with the actual values in the variables
      // and tells the database the type of data it is
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
      // Insert the data
    $stmt->execute();
      // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
      // Close the database interaction
    $stmt->closeCursor();
      // Return the indication of success (rows changed)
    return $rowsChanged;
    
}



// Insert site product data to database

function getProducts($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle){
        // Create a connection object from the acme connection function
    $db = acmeConnect(); 
        // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory (categoryId, invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, invVendor, invStyle)
     VALUES (:categoryId, :invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :invVendor, :invStyle )'; 
        // The next line creates the prepared statement using the acme connection       
    $stmt = $db->prepare($sql);
        // The next twelve lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
        // Insert the data
    $stmt->execute();
        // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
        // Close the database interaction
    $stmt->closeCursor();
        // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get basic product information from the inventory table for updating and deleting

function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}

//Selecting a single product based on id
// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo; //storing everything product related
}

//Update a product
function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, 
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId){
        // Create a connection object from the acme connection function
    $db = acmeConnect(); 
        // The SQL statement to be used with the database 
    $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, '
            . 'invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, '
            . 'invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, '
            . 'invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId'; 
        // The next line creates the prepared statement using the acme connection       
    $stmt = $db->prepare($sql);
        // The next twelve lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
    $stmt->execute();
        // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
        // Close the database interaction
    $stmt->closeCursor();
        // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Delete a product
function deleteProduct($invId){
        // Create a connection object from the acme connection function
    $db = acmeConnect(); 
        // The SQL statement to be used with the database 
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
        // The next line creates the prepared statement using the acme connection       
    $stmt = $db->prepare($sql);
        // The next twelve lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
    $stmt->execute();
        // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
        // Close the database interaction
    $stmt->closeCursor();
        // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Select Products By Category
function getProductsByCategory($type){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

//Retrieve information about a specific inventory item and return it to the controller.

function getProductDetail($type){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId=:invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products; 
    
}