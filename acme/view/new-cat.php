<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
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
           // include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/nav.php";
          echo $navList; 
          ?>
      </nav>
        
      <main id="addCategory">
            <h1>Add Category</h1>
                <?php 
                if (isset($message)){
                 echo $message;
                } 
                 $message = NULL;
                ?>
            <h2 class="message">Add a new category of products below.</h2>
            
            <form class="alignForm" method="post">
                <fieldset>
                    <label for="categoryName">New Category Name</label>
                    <br>
                    <input type="text" name="categoryName" id="categoryName"
                      <?php if(isset($categoryName)){
                        echo "value='$categoryName'";
                      }
                      ?>required>
                </fieldset>
                    <input type= "submit" id="addCatergorybtn" value = "Add Category">
                    <!-- Add the action name - value pair -->
                    <input type="hidden"  name="action" value="newCategory">
            </form>
            
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>