<?php
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!doctype html>
<html lang="en-us">
    <head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Image Management
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
          echo $navList; 
          ?>
      </nav>
        
      <main id="image-admin">
         <h1>Image Management</h1>
         <p>Welcome to the image management page. Please select one of the options below.</p>
         <h2>Add New Product Image</h2>
            <?php
            if (isset($message)) {
            echo $message;
            } ?>

        <form action="/acme/uploads/" method="post" enctype="multipart/form-data"> 

         <label for="invItem">Product</label><br>
            <?php echo $prodSelect; ?><br><br>
         <label>Upload Image:</label><br>
         <input type="file" name="file1"><br>
         <input type="submit" class="regbtn" value="Upload">
         <input type="hidden" name="action" value="upload">
        </form>
         <hr>
         <h2>Existing Images</h2>
         <p class="notifyr">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
             if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>
<?php unset($_SESSION['message']); ?>