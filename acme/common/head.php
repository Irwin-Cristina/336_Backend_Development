<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
  <?php if(isset($prodInfo['invName'])){ 
     echo "Modify $prodInfo[invName] ";
    } 
//    if(isset($prodInfo['invName'])){
//    echo "Delte $prodInfo[invName]";
//    }
     elseif(isset($invName)) { 
       echo $invName; } ?> |Acme, Inc.|Coyote and Roadrunner
</title>
<meta name="author" content="Cristina Irwin">
<meta name="description" content="Template for Acme website for CIT 336 BYU-Idaho">
<!-- Google API font reference -->    
<link href="https://fonts.googleapis.com/css?family=Kalam:700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<!-- external style references in the proper cascading order -->
<link href="/acme/css/normalize.css" rel="stylesheet"> <!-- normalize user agent/browser defaults -->
<link href="/acme/css/main.css" rel="stylesheet">  <!-- default styles - small/phone views -->   