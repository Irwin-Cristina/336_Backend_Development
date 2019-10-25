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
            <h1>Add Product</h1>
                <?php 
                if (isset($message)){
                  echo $message;
                } 
                  $message = NULL;
                ?>
            <p class="message">Add a new product below. All fields are required!</p>
            <form class="simple" action="../products/" method ="post">
                <fieldset id="productInfo">
                    <legend>
                        <span>New Product Information</span> 
                    </legend>
                        <div class="group">
                        <p>Select Category</p>
                            <?php 
                              echo $catList; 
                            ?>
                            <br>
                            <label for="invName">Product Name</label>
                            <input type="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> required> 
                            <br>
                            <label for="invDescription">Product Description</label>
                            <br>
                            <textarea rows="5" cols="30" name="invDescription" id="invDescription" placeholder="Please write a description of the product" 
                                 required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea>
                            <br>
                            <label for="invImage">Product Image (path to image)</label>
                            <input type="text" name="invImage"  id="invImage" value="acme/images/no-image.png" 
                                <?php if(isset($invImag)){echo "value='$invImag'";} ?> required> 
                            <br>
                            <label for="invThumbnail">Product Thumbnail (path to thumbnail)</label>
                            <input type="text" name="invThumbnail"  id="invThumbnail" value="acme/images/no-image.png" 
                                <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>  
                            <br>
                            <label for="invPrice">Product Price</label>
                            <input 
                                type="number" step="0.01" name="invPrice" id="invPrice" 
                                <?php if(isset($invPrice)){echo "value='$invPrice'";}
                                
                                //// if(isset($checkinvPrice) && checkinvPrice!=0) {echo "value='$invPrice'";} 
//                                else {echo'placeholder="0.00"';}?> required>
                                    <!--pattern='(?:[^-][\d]{0,})\.([\d]{2})' -->
                                     
                            <br>
                            <label for="invStock"># in Stock (numbers only)</label>
                            <input type="number" min="1" name="invStock" id="invStock" title="Only numbers" 
                                <?php if(isset($invStock)){echo "value='$invStock'";} ?> required> 
                            <br>
                            <label for="invSize">Shipping Size</label>
                            <input type="number" min="1" name="invSize"  id="invSize" title="Please include x in input. Example 12x3x1" 
                                <?php if(isset($invSize)){echo "value='$invSize'";} ?> required> 
                                      
                            <br>
                            <label for="invWeight">Weight (lbs.)</label>
                            <input type="number" min="1" name="invWeight" id="invWeight"  
                                <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> required> 
                            <br>
                            <label for="invLocation">Location (city name)</label>
                            <input type="text" name="invLocation" id="invLocation" 
                                <?php if(isset($invLocation)){echo "value='$invLocation'";} ?> required> 
                                <!-- pattern="([A-Z][a-zA-Z]+,[ ]?[A-Z]{2})"-->
                            <br>
                            <label for="invVendor">Vendor Name</label>
                            <input type="text" name="invVendor"  id="invVendor" 
                                <?php if(isset($invVendor)){echo "value='$invVendor'";} ?> required> 
                            <br>
                            <label for="invStyle">Primary Material</label>
                            <input type="text" name="invStyle" id="invStyle" 
                                <?php if(isset($invStyle)){echo "value='$invStyle'";} ?> required>  
                            <br>
                        </div>
                        <input type="submit" name="submit" id="regbtn" value="Add Product">
                     <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="addNewproduct">
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