<?php

   if (!session_id()) 
   {
    session_start();
  
  
   }
    if ($_SESSION['valid'] != true)
    { 
         // header('Location:home_page.php');

   //die();
    }

    $user = $_SESSION['name'] ;
    

   
?>
<!DOCTYPE html>
 <html>
  <head>
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/slideshow.css">
    <link rel="stylesheet" type="text/css" href="css/section_home.css">
    <link rel="stylesheet" type="text/css" href="css/modal_home.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  </head>

  <body>
    <header>
      <div class="container">
        <div id="logo">
          <h1><a href="home_page.php">Scorpix <a></h1>
        </div>
        <nav >
            
          
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><?php echo $user ?></button>
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Profile</button>
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Message</button>
          <a href="logout.php"><button type="submit" onclick="document.getElementById('id01').style.display='block'" style="width:auto;" formaction = "logout.php" >Logout</button><a>
          
      </div>
    </header>




    <section id="showcase">
      <div class="container">
      	<div align="center" >
          <div id="cont_nav">
            <a href="show_time.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Show Time</button></a>
            <a href="list.php?type=Up Coming"><button class="nav">Up Coming</button></a>
            <a href="ticket.php"><button class="nav">Ticket</button></a>        
            <button class="nav" name="type" type="submit" value="fav_HTML" >Food</button>
            <button class="nav" name="type" type="submit" value="fav_HTML" >Buy Ticket</button>
        </div>
      </div>
    </section>
    <section>

      <form class="payform">
        <div class="billshow">
          <?php
            $sql = $_GET["code"] ; 
            echo $sql ; 
          ?>         
              <a href="payment.php?code=<?=$qry;?>"><button class="button button4">Payment Method</button></a>
 
        </div>
        
      </form>
      
    </section>
    <footer>
    
  
      <p id="footer">
        Scorpix Movie Hall , copyright &copy 
      </p>
    </footer>
              
  </body>
</html>
