<?php

/* 
 * Accounts Model
 */

// Insert site visitor data to database

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    $db = acmeConnect();
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
     VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
      // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
      // The next four lines replace the placeholders in the SQL
      // statement with the actual values in the variables
      // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
      // Insert the data
    $stmt->execute();
      // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
      // Close the database interaction
    $stmt->closeCursor();
      // Return the indication of success (rows changed)
    return $rowsChanged;
  }
  
  //Check for an existing email address in Clients list on data base
  
  function checkExistingEmail($clientEmail) {
      $db = acmeConnect();
      $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
      $stmt->execute();
      $matchEmail = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      //return $matchEmail;
      
      
 if(empty($matchEmail)){
      return 0;
//        echo 'Nothing Found';
//        exit;
   } else {
    return 1;
//        echo 'Match found';
//        exit;
     }
  }
  
  
function checkCurrentEmail($clientEmail){
    $db = acmeConnect();
    $sql = 'SELECT clientId FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $response = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $response;
}
  // Get client data based on an email address
function getClient($clientEmail){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
    
}

// Get basic client information from the client table for updating and deleting
function getclientBasics() {
   $db = acmeConnect();
   $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientPassword FROM clients ORDER BY clientId ASC';
   $stmt = $db->prepare($sql);
   $stmt->execute();
   $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $clients;
}


//The first function will need to handle the update of the account information as 
//submitted to the controller from the account update form. It will only need to 
//update the firstname, lastname and email values based on the clientId.
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId){
        // Create a connection object from the acme connection function
    $db = acmeConnect(); 
        // The SQL statement to be used with the database 
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :cid'; 
        // The next line creates the prepared statement using the acme connection       
    $stmt = $db->prepare($sql);
        // The next twelve lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
     $stmt->bindValue(':cid', $clientId, PDO::PARAM_INT);
        // Insert the data
    $stmt->execute();
        // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
        // Close the database interaction
    $stmt->closeCursor();
        // Return the indication of success (rows changed)
    return $rowsChanged;
}


// The second function will be similar to the function that was previously built to get client 
// information based on the email address. However, this function will get the client 
// information based on the clientId.

// Get client data based on clientId.
function getclientInfo($clientId){
    $db = acmeConnect();
    $sql = 'SELECT * 
         FROM clients
         WHERE clientId = :cid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':cid', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientInfo;
}



//The third function will need to update the password (as a hash) as submitted to the controller from the change 
//password form, based on the clientId. Be sure that after submitting the new password 
//to check the clients table to make sure the password is a hash as part of your testing.

function updatePassword ($clientPassword, $clientId){
    $db = acmeConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :cid';
      // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
      // The next four lines replace the placeholders in the SQL
      // statement with the actual values in the variables
      // and tells the database the type of data it is
    
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':cid', $clientId, PDO::PARAM_INT);

      // Insert the data
    $stmt->execute();
      // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
      // Close the database interaction
    $stmt->closeCursor();
      // Return the indication of success (rows changed)
    return $rowsChanged;
  }
  
