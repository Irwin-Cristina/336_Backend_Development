<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}


//Build a drop down menu using the $catList array
$catList = "<select name='categoryId'>";
$catList .="<option>Choose a Category</option>";
    foreach ($categories as $category) {
      $catList .= "<option value='$category[categoryId]'";
    if(isset($categoryId)){
      if($category['categoryId'] === $categoryId){
        $catList .= ' selected ';
       }
     } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }  
 }  
 $catList .= ">$category[categoryName]</option>";
 }
 $catList .= "</select>";
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
                       echo "Modify $prodInfo[invName] ";
                     } 
                     elseif(isset($invName)) { 
                        echo $invName;}?></h1>
                <?php 
                if (isset($message)){
                  echo $message;
                } 
              //$message = NULL;
                ?>
            <p class="message">Modify the product below. All fields are required!</p>
            <form class="simple" action="../products/" method ="post">
                <fieldset id="productInfo">
                    <legend>
                        <span>Product Information</span> 
                    </legend>
                        <div class="group">
                        <p>Select Category</p>
                            <?php 
                              echo $catList; 
                            ?>
                            <br>
                            <label for="invName">Product Name</label>
                            <input type="text" name="invName" id="invName"  
                                <?php if(isset($invName)){ 
                                   echo "value='$invName'"; 
                                } elseif(isset($prodInfo['invName'])) {
                                   echo "value='$prodInfo[invName]'"; }
                                   ?> required> 
                            <br>
                            <label for="invDescription">Product Description</label>
                            <br>
                            <textarea rows="5" cols="30" name="invDescription" id="invDescription" required><?php 
                            if(isset($invDescription)){
                                     echo $invDescription;
                                  } elseif(isset($prodInfo['invDescription'])) {
                                      echo $prodInfo['invDescription']; }
                                  ?> 
                            </textarea>
                            <br>
                            <!-- value="acme/images/no-image.png" -->
                            <label for="invImage">Product Image (path to image)</label>
                            <input type="text" name="invImage" id="invImage" 
                                <?php if(isset($invImage)){
                                    echo "value='$invImage'";
                                } elseif(isset($prodInfo['invImage'])) {
                                    echo "value='$prodInfo[invImage]'"; }
                                ?> required> 
                            <br>
                            <!-- value="acme/images/no-image.png" -->
                            <label for="invThumbnail">Product Thumbnail (path to thumbnail)</label>
                            <input type="text" name="invThumbnail"  id="invThumbnail"
                                <?php if(isset($invThumbnail)){
                                    echo "value='$invThumbnail'";
                                } elseif(isset($prodInfo['invThumbnail'])) {
                                    echo "value='$prodInfo[invThumbnail]'"; }
                                ?> required>  
                            <br>
                            <label for="invPrice">Product Price</label>
                            <input 
                                type="number" step="0.01" name="invPrice" id="invPrice" 
                                <?php if(isset($invPrice)){
                                    echo "value='$invPrice'";
                                } elseif(isset($prodInfo['invPrice'])) {
                                    echo "value='$prodInfo[invPrice]'"; }
                                ?> required>
                            <br>
                            <label for="invStock"># in Stock (numbers only)</label>
                            <input type="number" min="1" name="invStock" id="invStock" title="Only numbers" 
                                <?php if(isset($invStock)){
                                    echo "value='$invStock'";
                                } elseif(isset($prodInfo['invStock'])) {
                                    echo "value='$prodInfo[invStock]'"; }
                                ?> required> 
                            <br>
                            <label for="invSize">Shipping Size</label>
                            <input type="number" min="1" name="invSize" id="invSize"  
                                <?php if(isset($invSize)){
                                    echo "value='$invSize'";
                                } elseif(isset($prodInfo['invSize'])) {
                                    echo "value='$prodInfo[invSize]'"; } 
                                ?> required>  
                                      
                            <br>
                            <label for="invWeight">Weight (lbs.)</label>
                            <input type="number" min="1" name="invWeight" id="invWeight"  
                                <?php if(isset($invWeight)){
                                    echo "value='$invWeight'";
                                } elseif(isset($prodInfo['invWeight'])) {
                                    echo "value='$prodInfo[invWeight]'"; }
                                ?> required> 
                            <br>
                            <label for="invLocation">Location (city name)</label>
                            <input type="text" name="invLocation" id="invLocation" 
                                <?php if(isset($invLocation)){
                                    echo "value='$invLocation'";
                                } elseif(isset($prodInfo['invLocation'])) {
                                    echo "value='$prodInfo[invLocation]'"; }
                                ?> required> 
                            <br>
                            <label for="invVendor">Vendor Name</label>
                            <input type="text" name="invVendor"  id="invVendor" 
                                <?php if(isset($invVendor)){
                                    echo "value='$invVendor'";
                                } elseif(isset($prodInfo['invVendor'])) {
                                    echo "value='$prodInfo[invVendor]'"; }
                                ?> required> 
                            <br>
                            <label for="invStyle">Primary Material</label>
                            <input type="text" name="invStyle" id="invStyle" 
                                <?php if(isset($invStyle)){
                                    echo "value='$invStyle'";
                                } elseif(isset($prodInfo['invStyle'])) {
                                    echo "value='$prodInfo[invStyle]'"; }
                                ?> required>  
                            <br>
                        </div>
                        <input type="submit" name="submit" id="regbtn" value="Update Product">
                     <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="updateProd">
                        <input type="hidden" name="invId" 
                               value="
                            <?php if(isset($prodInfo['invId'])){ 
                                echo $prodInfo['invId'];
                            } elseif(isset($invId)){ 
                                echo $invId; } ?>">
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