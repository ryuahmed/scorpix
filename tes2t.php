<?php

            $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

    if (!session_id()) 
   {
    session_start();

   }

if( !isset($_SESSION["valid"]) )
    $_SESSION['valid'] = false ;


?>
<!DOCTYPE html>
 <html>
  <head>
    <title>Home page</title>          
    <script src="jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/section_home.css">
    <link rel="stylesheet" type="text/css" href="css/modal_home.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/ticket.css">



  </head>

  <body>
    <header>
      <div class="container">
        <div id="logo">
          <h1><a href="home_page.php">Scorpix <a></h1>

        </div>
        <nav >

          <?php 
          if($_SESSION['valid'] == false)
            {
          ?>
          <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

          <div id="id01" class="modal">
            
            <form class="modal-content animate" action="login.php" method="POST">
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img  src="image\avatar.png" alt="Avatar" class="avatar"  >
              </div>

              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit">Login</button>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
              </div>

              <div class="container" style="background-color:#f1f1f1">
                
                <span class="psw">Forgot <a href="#">password?</a></span>
              </div>
            </form>
          </div>



          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>

          <div id="id02" class="modal">
            <form class="modal-content animate" action="insert.php" method = "POST">
             <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="image/avatar.png" alt="Avatar" class="avatar">
              </div>
              <div class="container">
                <label for="fname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                <label for="lname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>
                <label for="uname"><b>User Name</b></label>
                <input type="text" placeholder="Enter User Name" name="uname" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>
                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" required>

                <label for="Pno"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="pno" required>
                <label for="bd"><b>Birth Date</b></label>
                <input type="text" placeholder="Enter Birth Date" name="bd" required>
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit">Sign Up</button>
              </div>

            </form>
          </div>


        <?php }

        if($_SESSION['valid'] == true)
          $username = $_SESSION['username'] ;
            {?>


          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><?php echo $_SESSION['username'] ?> </button>
          <a href="profile.php?name=<?php echo $username; ?>"><button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Profile</button>
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Message</button>
          <?php


            $pos=$_SESSION['username'] ;


            $qry = "SELECT position 
                    from user
                    where User_name= '$pos'" ;


            $pos = $db_connect->query($qry) ;
            $position_data = $pos->fetch_assoc(); 



            if($position_data['position'] == 'moderator')
            {

                       ?><button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Admin Panel</button><?php
              }
          ?>
          <a href="logout.php"><button type="submit" onclick="document.getElementById('id01').style.display='block'" style="width:auto;" formaction = "logout.php" >Logout</button><a>
         <?php } ?>
      </div>
    </header>

          <script>
          // Get the modal
          var modal = document.getElementById('id01');

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
          </script>
                    <script>
          // Get the modal
          var modal = document.getElementById('id02');

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
          </script>

    <section id="showcase">
      <div class="container">
        <div align="center" >
          
          <a href="user_show_time.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Show Time</button></a>
          <a href="list.php?type=Up Coming"><button class="nav">Up Coming</button></a>
          <a href="ticket.php"><button class="nav">Ticket</button></a>        
          <a href="food.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Food</button></a>
           <a href="buy.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Buy Ticket</button></a>


        </div>
      </div>
  </section>
    <section  class="container bodycont"  >
          <div class="txt" >
          <h1>Ticket</h1>
          <hr>
          Tickets are on sale one day in advance<br>
          And now you can purchase tickets online through our "Entertainment Card" available at the ticket counters.<br><br><br>
          

      You can book tickets over the phone through our member hotline and pick up your tickets conveniently right before the show from our exclusive platinum member counter once you become our Platinum Member.<br><br>

      <div class="bold">Ticket Price</div>
      <hr>
      <?php
            $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

            $qry = "SELECT m_type , time , price 
                    FROM ticket
                    where h_type = 'Normal'";

            $ticket = $db_connect->query($qry) ;   
            $tckt = $ticket->fetch_assoc();
      ?>
      <div class="bold"> Normal:</div>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();
      echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>

      For Premium seat 50 Taka willbe added<br><br>

      <?php
           

            $qry = "SELECT m_type , time , price 
                    FROM ticket
                    where h_type = 'Premium'";

            $ticket = $db_connect->query($qry) ;   
            $tckt = $ticket->fetch_assoc();
      ?>

      <div class="bold"> Premium:</div>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();
      echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>

      For Premium seat 50 Taka willbe added<br><br>


      <?php
           

            $qry = "SELECT m_type , time , price 
                    FROM ticket
                    where h_type = 'VIP'";

            $ticket = $db_connect->query($qry) ;   
            $tckt = $ticket->fetch_assoc();
      ?>

      <div class="bold"> VIP:</div>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();
      echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['m_type']?> Movies<br>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br>
      <?php $tckt = $ticket->fetch_assoc();?>
      <?php echo $tckt['time']?> shows <?php echo $tckt['price']?> taka <br><br>

      For Premium seat 100 Taka willbe added<br><br>


      Online Ticket:<br>
      Now you can purchase tickets online for any show any movie through our Entertainment Card & Debit/Credit card which will be available at STAR Cineplex's ticket counter.<br><br>

        </div>
    </section>
    <footer>
    
  
      <p id="footer">
        Scorpix Movie Hall , copyright &copy 
      </p>
    </footer>
              
  </body>
</html>


