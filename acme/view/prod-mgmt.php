<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
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
        <?php 
         echo $navList; 
        ?>
      </nav>
        
      <main>
         <h1>Product Management</h1>
         <?php 
            if (isset($message)){
             echo $message;
            } 
             $message = NULL;
            ?>
         <p class="simple">Welcome to the product management page. Please choose and option below:</p>
            <ul>
                <li><a href="../products/?action=newCategory">Add a New Category</a></li>
                <li><a href="../products/?action=product">Add a New Product</a></li>
             </ul>
          <?php
            if (isset($message)) {
             echo $message;
            } if (isset($prodList)) {
              echo $prodList;
            }
            ?>
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>
<?php unset($_SESSION['message']); ?>