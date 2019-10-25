<figure class="logo">
    <img src="/acme/images/site/logo.gif" alt="Logo for Acme, Inc."> 
</figure>
            
<div class="folder">
    <?php 
//    if(isset($cookieFirstname)){echo "<span> Welcome $cookieFirstname</span>";} ?>
    
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
     echo "<a href='/acme/accounts/'>Welcome " . $_SESSION['clientData']['clientFirstname']. "</a><br>";
      echo "<a href='/acme/accounts/?action=logout'><span id='myAccount'>Logout</span></a>";
     
    } else {
        echo '<a href="/acme/accounts/?action=login"><img src="/acme/images/site/account.gif" alt="red folder"><span id="myAccount">My Account</span></a>';
    }
?>
</div>