
<!doctype html>
<html lang="en-us">
    <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $products['invName']; ?> Products | Acme, Inc.
    </title>
    <meta name="author" content="Cristina Irwin">
    <meta name="description" content="Template for Acme website for CIT 336 BYU-Idaho">
    <!-- Google API font reference -->    
    <link href="https://fonts.googleapis.com/css?family=Kalam:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <!-- external style references in the proper cascading order -->
    <link href="/acme/css/normalize.css" rel="stylesheet"> <!-- normalize user agent/browser defaults -->
    <link href="/acme/css/main.css" rel="stylesheet">  <!-- default styles - small/phone views -->   
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
        
      <main class="detail">
         <h1><?php echo $products['invName']; ?></h1>
         <p><a href='#reviews'>Reviews</a> appear at the bottom of the page.</p>
         
         
         
         <?php if(isset($prodDetail)) {echo $prodDetail;}?>
         
         <h2 id="thumbnailh3">Thumbnail</h2>
         <?php if(isset($showThumbnail)) {echo $showThumbnail;}?>
         
         <h3 id="reviews">Customer Reviews</h3>
         
         <div class="reviewlogin">
            <p>Product Reviews</p> 
          
         <?php if(!isset($_SESSION['loggedin'])) : ?>
                <p>Reviews can only be added if logged in.</p>
                <p><a href="/acme/accounts/?action=login">Login</a></p>
         </div>
         
         <?php endif; ?>
<!--         only seen if logged in-->
        <?php if(isset($message)){ echo $message;} 
          $message = NULL;
          ?>
            <?php if(isset($_SESSION['loggedin'])){
                echo
                "<form class='simple' action='../reviews/' method='post'>
                <div class='group'>
                <label for='screenName'>Screen Name:</label>
                <input type='text' name='screenName' id='screenName' readonly value='$clientScreenname'>
              
                <br>
                <textarea rows='5' cols='30' name='reviewText' id='reviewText' required></textarea>
                </div>
                <input type='submit' name='submit' id='regbtn' value='Review'>
                <input type='hidden' name='action' value='newreview'>
                <input type='hidden' name='clientId' value='$clientId'>
                <input type='hidden' name='invId' value='$prodId'> 
                 </form>";}
             echo $buildReview; ?>
                
       </div>        
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>