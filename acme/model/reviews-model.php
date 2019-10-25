<?php

/* 
 * Reviews Model
 */

//Insert a review
function newReview($reviewText, $invId, $clientId) {
    $db = acmeConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
            VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    //$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
    
//Get reviews for a specific inventory item
function getReviewbyinvid($invId){
    $db = acmeConnect();
    $sql = 'SELECT reviewText, reviewDate, clients.clientFirstname, clients.clientLastname  
         FROM reviews
         JOIN clients on clients.clientId = reviews.clientId
         WHERE reviews.invId = :invId
         ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewbyinvidArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewbyinvidArray;
    }
    
    
    
//Get reviews written by a specific client/pull up in admin view/good
function getReviewbyclientid($clientId){
    $db = acmeConnect();
    $sql = 'SELECT reviewText, reviewId, reviewDate, clients.clientFirstname, clients.clientLastname  
         FROM reviews
         JOIN clients on clients.clientId = reviews.clientId
         WHERE reviews.clientId = :clientId
         ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewbyclientidArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewbyclientidArray;
    }


    
    //Get a specific reviewId-to pull up correct on delete and edit view
    function getReviewbyreviewId($reviewId){
    $db = acmeConnect();
    $sql = 'SELECT reviewText, reviewId, reviewDate, invName
         FROM reviews
         JOIN inventory on reviews.invId = inventory.invId
         WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewByreviewidArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewByreviewidArray;
    }
    
    
    //Get a review based on invId//Holly
    function getReviewbyinvIdh($invId){
    $db = acmeConnect();
    $sql = 'SELECT reviewText, reviewId, reviewDate, clients.clientFirstname, clients.clientLastname
         FROM reviews
         JOIN inventory ON reviews.invId = inventory.invId
         JOIN clients ON reviews.clientId = clients.clientId
         WHERE inventory.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invidInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invidInfo;
    }
    

//Update a specific review
function updateReview($reviewId, $reviewText){
    $db = acmeConnect(); 
    $sql = 'UPDATE reviews  
            SET reviewText = :reviewText, reviewDate = NOW() 
            WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
    }    
    
    

//Detete a specific review
 function deleteReview($reviewId){
     $db = acmeConnect();
     $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
     $stmt->execute();
     $rowsChanged = $stmt->rowCount();
     $stmt->closeCursor();
     return $rowsChanged;
    }
    
