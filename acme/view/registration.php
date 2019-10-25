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
        
         <main class="content">
             <h1>ACME Registration</h1>
             <h3>All fields required</h3>
             
             <?php if (isset($message)) {echo $message;} ?>
             
             <form id="register" method="post" action="/acme/accounts/">
                 <fieldset>
                     <legend>Your Information</legend>
                        <div class="group">
                            <label for="clientFirstname">First Name:</label>
                            <input type="text" name="clientFirstname" id="clientFirstname"  placeholder="First Name" 
                                <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required> 
                            
                            <br>
                            <label for="clientLastname">Last Name:</label>
                            <input type="text" name="clientLastname" id="clientLastname"  placeholder="Last Name" 
                                <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
                            
                            <br>
                            <label for="clientEmail">Email Address:</label>
                            <input type="email" name="clientEmail"  id="clientEmail" placeholder="Valid email address" 
                                   <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                            <br>
                            <label for="clientPassword">Password:</label>
                            <input type="password" name="clientPassword"  id="clientPassword" required
                                   pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            <br>
                            <span class="passwordWarning">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                            <br>
                        </div>
                            <input type="submit" name="submit" id="regbtn" value="Register">
                             <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="register">
                        
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