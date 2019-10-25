<?php
//Test if user is not logged in
 
 if(!$_SESSION['loggedin']) {
      header('location:/acme/'); 
      exit;
 }
 if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
 
?>
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
        <?php echo $navList; ?>
      </nav>
        
      <main>
          
        <h1><?php echo $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname'];?></h1>
        
        <?php
        if (isset($message)) {
            echo $message;
          }
//          if (isset($_SESSION['message'])) {
//            echo $_SESSION['message'];
//          }
          ?>
        
        <p><span id="admin">You are logged in.</span></p>
             <ul>
                 <li><span class="bold">First name:</span> <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
                 <li><span class="bold">Last name:</span> <?php echo $_SESSION['clientData']['clientLastname'];?></li>
                 <li><span class="bold">Email:</span> <?php echo $_SESSION['clientData']['clientEmail'];?></li>
             </ul>
            
        <div class="group">
            <p><a href="../accounts?action=update">Update Account Information</a></p>

        </div>
        
        
            <?php
        if($_SESSION['clientData']['clientLevel']>1)  {
            echo '<h2 class="indent"> Adminstration Functions</h2>'.
                 '<div class="group">'.
                    '<p>Use this link to administer products and categories.</p>'.
                    '<p><a href="../products/">Manage Products</a></p>'.
                 '</div>';
            }
            ?>
        <h3 id="reviews">Product Reviews</h3>
         
         <div class="reviewlogin ">
            <p><?php echo $_SESSION['clientData']['clientFirstname'];?> Reviews of Acme Product</p> 
         </div>
<!--         only seen if logged in-->


            <?php if (isset($message)){
            echo $message;}
            echo $buildReviewbyclient; ?>
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>