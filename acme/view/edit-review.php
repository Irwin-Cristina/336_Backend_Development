<!doctype html>
<html lang="en-us">
    <head>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/head.php"; ?>
    </head>
    
    <body>
      <header>
         <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/header.php"; ?>
      </header>
        
      <nav> 
        <?php 
           // include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/nav.php";
          echo $navList; 
          ?>
      </nav>
        
      <main class="category">
         <h1>Review of <?php if(isset($reviewByreviewidArray['invName'])) { echo "$reviewByreviewidArray[invName]";}?></h1>
         
         <?php if (isset($message)) {echo $message;}?>
        
        
            <?php if(isset($_SESSION['loggedin'])); ?>
         <div class="group">
         <form class="simple" action="/acme/reviews/" method="post">
             <?php if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
             echo "<h2 class='welcome'>Welcome " . $_SESSION['clientData']['clientFirstname'];} ?></h2>
              <h3 class="edit">Edit</h3>
             <label for="reviewText">Product Review</label>
             <br>
         <textarea rows="5" cols="30" name="reviewText" id="reviewText" required><?php if(isset($reviewByreviewidArray['reviewText'])){echo $reviewByreviewidArray['reviewText'];}?></textarea><br>   
             
         <input type="submit" name="submit" id="reviewupdatebtn" value="Edit">
         <!--Action key value pair-->
         <input type="hidden" name="action" value="editreview">
         <input type="hidden" name="reviewId" value="<?php if(isset($reviewByreviewidArray['reviewId'])){echo $reviewByreviewidArray['reviewId'];}?>">
        </form>
        </div>
         
         
         
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>