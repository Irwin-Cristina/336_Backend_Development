<!doctype html>
<html lang="en-us">
    <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $type; ?> Products | Acme, Inc.
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
        
      <main class="category">
          
          <h1><?php echo $type; ?> Products</h1>
          
          <?php if(isset($message)){ echo $message; } ?>
          <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
          
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>