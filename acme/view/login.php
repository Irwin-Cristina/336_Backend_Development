<?php

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
        
      <main class="login">
         <h1>Acme Login</h1>
         
         <?php
          if (isset($message)) {
            echo $message;
          }
          ?>
         
         <form id="loginform" method="post" action ="/acme/accounts/">
             <fieldset>
                 <legend>My Account</legend>
                  <div class="group">
                    <label for="clientEmail">Email Address:</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder="Valid email address" 
                                <?php if(isset($clientEmail)){
                                    echo "value='$clientEmail'";
                                }?>required>
                            <br>
                    <label for="clientPassword">Password:</label>
                    
                            <input type="password" name="clientPassword" id="clientPassword" required
                                   pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"> <!--required title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character"-->
                            <br>
                            <span class="passwordWarning">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                            <br>
                  </div>
                  

                  <input type= "submit" id="loginButton"   value = "Login">
                  <input type="hidden" name="action" value="Login">
             </fieldset>
         </form>
         
         <form id="newMember" method="post" action="/acme/accounts/?action=registration">
         <h2>Not a member?</h2>
             <input type= "submit" id="accountButton" value = "Create an Account">
             <input type="hidden"  name="action" value="registration">
         </form>
         
      </main>
        
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
      </footer>
         <!-- current date -->
        <script src="../scripts/currentdatetest.js"></script>
    </body>
</html>