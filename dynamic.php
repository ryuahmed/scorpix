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
{
    $_SESSION['valid'] = false ;
    $_SESSION['username']  = "" ;
}

if( isset($_SESSION["valid"]) )
{
   if($_SESSION["valid"]==true)
   {
    $username=$_SESSION['username']  ; 
   }
   else
   {
     $_SESSION['valid'] = false ;
        $_SESSION['username']  = "" ;
   }
}
?>
<!DOCTYPE html>
 <html>
  <head>
    <title>Home page</title>          
    <script src="jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/slideshow.css">
    <link rel="stylesheet" type="text/css" href="css/section_home.css">
    <link rel="stylesheet" type="text/css" href="css/modal_home.css">
    <link rel="stylesheet" type="text/css" href="css/pool.css">
    
    <link rel="stylesheet" type="text/css" href="css/dynamic.css">
    <link rel="stylesheet" type="text/css" href="css/show_time.css">
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

              </div>

              <div class="container" style="background-color:#f1f1f1">
                
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

        if($_SESSION['valid']  == true)
            {?>


          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><?php echo $_SESSION['username']  ?> </button>
          <a href="profile.php?name=<?php echo $username; ?>"><button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Profile</button>
            <?php

              $qry="SELECT count(*) as c
from inbox
where reciver ='$username' and seen is NULL";

            $no = $db_connect->query($qry) ;
            $nodata = $no->fetch_assoc(); 

            ?>
          <a href="message_list.php"><button style="width:auto;">Message <?php if($nodata['c']>0){echo "(".$nodata['c'].")";} ?></button>
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
      <div class="container ">
        <div align="center" >
          
          <a href="show_time.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Show Time</button></a>
          <a href="list.php?type=Up Coming"><button class="nav">Up Coming</button></a>
          <a href="ticket.php"><button class="nav">Ticket</button></a>        
          <a href="food.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Food</button></a>
          <?php
            if($_SESSION['valid'] == false)
            {
              ?><button onclick="document.getElementById('id01').style.display='block'" class="nav" name="type" type="submit" value="fav_HTML" >Buy Ticket</button><?php
            }
            if($_SESSION['valid'] == true)
            {
              ?><a href="buy.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Buy Ticket</button></a><?php

            }

          ?>

        </div>
      </div>
    </section>
    <section  class="container bodycont"  >
      <?php
          $mid = $_GET["name"]; 

          $user = 'root';
          $pass = '';
          $db = 'scorpix';

          $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

          $qry = "SELECT name,id,director,realease_date,run_time,cast,synop,type,status,poster
                  from movie
                  where movie.id = '$mid' 
                  " ;
          $print = $db_connect->query($qry) or die('bad query');

          $data = $print->fetch_assoc(); 
      ?>
      <h1 align="center"><?php echo $data["name"]; ?> </h1>

      <div class="dynamic_body">
      <img class="pic" src="image/poster/<?php echo $data['poster']?>.jpg" align="left">

      <div class="dynamic_container">
        <div class="field_text"> Name : <?php echo $data["name"]; ?></div>
        <div class="field_text">Run time : <?php echo $data["run_time"]; ?></div>
        <div class="field_text"> Realese Date :<?php echo $data["realease_date"]; ?></div>

        

        <hr>
        <div class="field_text"> Director : <?php echo $data["director"]; ?></div>
        <div class="field_text"> Cast : <?php echo $data["cast"]; ?></div>
        <hr>
        <div class="field_text">Sunopsis : <?php echo $data["synop"]; ?></div>
      </div>

      <?php

      $mid = $_GET["name"]; 

          $user = 'root';
          $pass = '';
          $db = 'scorpix';

          $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
          $id = $data['id'] ; 
          $qry = "SELECT h_type , time
                  FROM hall join now_showing 
                  where hall.h_id = now_showing.h_id and movie_id = '$mid'
                  " ;
          $time = $db_connect->query($qry) or die('bad query');
          $s = $time->num_rows  ; 
          $show = $time->fetch_assoc(); 

        
      ?>

      <div class="dynamic_time"> 

          <a href="dynamic.php?name=<?=$data['id'];?>">
            <button class="movie_name" ><?php echo $data["name"];?></button>
          </a>
          <?php

          if($s!=0)
          {
            while(1)
            {
              if ($s == 0)
                  break ; 

              $h=$show["h_type"] ; 
              if($h=='Normal')
              {
                ?> <button class="time Normal" ><?php echo $show["time"]; ?></button><?php
              }
              if($h=='Premium')
              {
                ?><button class="time premium" ><?php echo $show["time"]; ?></button><?php
              }
                if($h=='V.I.P.')
              {
                ?> <button class="time vip" ><?php echo $show["time"]; ?></button><?php
              }

           
                $show = $time->fetch_assoc() ;
                $s--; 
              }
            }
            else
            {
                $qry = "
                SELECT STATUS
                from movie
                where id = '$mid'
                  " ;
          $x = $db_connect->query($qry) or die('bad query');
          $status = $x->fetch_assoc(); 
    ?> <button class="time Normal" ><?php echo $status["STATUS"]; ?></button><?php
            }
          ?>
          <button class="time Normal" >Buy ticket</button>
      </div>
    </div>

    </section>
    <footer>
    
  
      <p id="footer">
        Scorpix Movie Hall , copyright &copy 
      </p>
    </footer>
              
  </body>
</html>
