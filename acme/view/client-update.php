<?php
//Test if user is not logged in
 
 if(!$_SESSION['loggedin']) {
      header('location:/acme/'); 
      exit;
 }
?><!doctype html>
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
        
      <main>
         <h1><?php echo $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname'];?></h1>
         
         <?php if (isset($message)){
                  echo $message;
                } 
                ?>
         <h2 class="message">Please update your information below.</h2>
         <form class="simple" action="../accounts/" method ="post">
                <fieldset id="clientInfo">
                    <legend>
                        <span>Update Client Information</span>
                    </legend>
                        <div class="group">
                            <label for="clientFirstname">First Name:</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" value="<?php echo $_SESSION['clientData']['clientFirstname']; ?>" required> 
                            
                            <br>
                            <label for="clientLastname">Last Name:</label>
                            <input type="text" name="clientLastname" id="clientLastname" value="<?php echo $_SESSION['clientData']['clientLastname']; ?>" required>
                            
                            <br>
                            <label for="clientEmail">Email Address:</label>
                            <input type="email" name="clientEmail"  id="clientEmail" value="<?php echo $_SESSION['clientData']['clientEmail']; ?>" required>
                            <br>
                         </div>
                         <input type="submit" name="submit" id="clientbtn" value="Update Account">
                             <!-- Add the action name - value pair -->
                         <input type="hidden" name="action" value="updateAccount">
                        
                 </fieldset>
         </form>
         <form class="simple" action="../accounts/" method ="post">
              <fieldset id="passwordInfo">
                    <legend>
                        <span>Update Password</span> 
                    </legend>
                        <div class="group">
                            <label for="clientPassword">Password:</label>
                            <input type="password" name="clientPassword"  id="clientPassword" required
                                   pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            <br>
                            <span class="passwordWarning">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                            <br>
                        </div>
                        <input type="submit" name="submit" id="passwordbtn" value="Change Password">
                             <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="changePassword">
                        <input type="hidden" name="invId" 
                               value="
                            <?php 
//                            if(isset($clientData['clientPassword'])){ 
//                                echo $clientData['clientPassword'];
//                            } elseif(isset($clientPassword)){ 
//                                echo $clientPassword; } ?>">
                        
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