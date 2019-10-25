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
      <main id="newProduct">
            <h1><?php if(isset($prodInfo['invName'])){
                   echo "Delete $prodInfo[invName] ";} ?></h1>
            <p class="message">Confirm Product Deletion. The delete is permanent.</p>
           
                <?php 
                if (isset($message)){
                  echo $message;
                } 
                 // $message = NULL;
                ?>
            
            <form class="simple" action="/acme/products/" method ="post">
                <fieldset id="productInfo">
                    <legend>
                        <span>Product Information</span> 
                    </legend>
                        <div class="group">
                            <label for="invName">Product Name</label>
                            <input type="text" readonly name="invName" id="invName"  
                                <?php if(isset($prodInfo['invName'])) {
                                   echo "value='$prodInfo[invName]'"; }
                                   ?>> 
                            <br>
                            <label for="invDescription">Product Description</label>
                            <br>
                            <textarea rows="5" cols="30" name="invDescription" id="invDescription" readonly><?php 
                            if(isset($prodInfo['invDescription'])) {
                                         echo $prodInfo['invDescription']; }?> 
                            </textarea>
                            <br>
                        </div>
                        <input type="submit" name="submit" id="regbtn" value="Delete Product">
                     <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="deleteProd">
                        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId']))
                           {echo $prodInfo['invId'];} ?>">
                </fieldset>
             </form>
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>