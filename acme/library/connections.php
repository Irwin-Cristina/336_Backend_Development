<?php

/* 
 * Database connections
 */
function acmeConnect(){
 $server = "localhost";
 $database = "acme";
 $user = "iClient";
 $password = "sMx5FUBkC4C2pVET";
 $dsn = 'mysql:host='.$server.';dbname='.$database;
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 
 try {
  $acmeLink = new PDO($dsn, $user, $password, $options);
  //echo '$acmeLink worked successfully >br>';
  return $acmeLink;
 } catch (PDOException $exc) {
   header('location:/acme/view/500.php'); 
   exit;
 }
}

