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
   
    <main>
        <h1>Welcome to Acme!</h1>
        <div class="imageholder">
            <section id="maintitle">
                <h2>Acme Rocket</h2>
                <p>Quick lighting fuse</p>
                <p>NHTSA approved seat belts</p>
                <p>Mobile launch stand included</p>
                <a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a>
            </section>
            
            <figure class="image">
                <img src="/acme/images/site/rocketfeature.jpg" alt="Coyote and Rocket">
            </figure>
        </div>
            
            
            <article>
                <h3>Acme Rocket Reviews</h3>
                <ul>
                    <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                    <li>"That thing was fast!" (4/5)</li>
                    <li>"Talk about fast delivery." (5/5)</li>
                    <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                    <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                </ul>
            </article>
            
            <aside>
                <h3>Featured Recipes</h3>
                <br>
                <div class="recipecontainer">
                    <figure>
                        <img src="/acme/images/recipes/bbqsand.jpg" alt="Image of Pulled Roadrunner BBQ sandwich">
                        <figcaption><a href="#">Pulled Roadrunner BBQ</a></figcaption>
                    </figure>
               
                    <figure>
                        <img src="/acme/images/recipes/potpie.jpg" alt="Image of Roadrunner pot pie">
                        <figcaption><a href="#">Roadrunner Pot Pie</a></figcaption>
                    </figure>

                    <figure>
                        <img src="/acme/images/recipes/soup.jpg" alt="Image of Roadrunner soup">
                        <figcaption><a href="#">Roadrunner Soup</a></figcaption>
                        </figure>
                    
                    <figure>
                        <img src="/acme/images/recipes/taco.jpg" alt="Image of Roadrunner taco">
                        <figcaption><a href="#">Roadrunner Tacos</a></figcaption>
                        </figure>
                </div>
            </aside>
        
        
       
        
        
    </main>      
    
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>
    </footer>
        
        <!-- current date -->
        <script src="/acme/scripts/currentdatetest.js"></script>
        
    </body>
   
    
</html>