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
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" type="text/css" href="css/slideshow.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/section_home.css">
    <link rel="stylesheet" type="text/css" href="css/modal_home.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
        <script src="jquery-3.3.1.js"></script>

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
            
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><?php echo $_SESSION['username']  ?> </button>
          <a href="profile.php?name=<?php echo $username; ?>"><button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Profile</button>
            <?php

              $qry="SELECT count(*) as c
from inbox
where reciver ='ryu' and seen is NULL";

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
      </div>
    </header>



    <div id="showcase">
      <div class="container">
        <div align="center" >
          <div id="cont_nav">
            <a href="show_time.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Show Time</button></a>
            <a href="list.php?type=Up Coming"><button class="nav">Up Coming</button></a>
            <a href="ticket.php"><button class="nav">Ticket</button></a>         
          <a href="food.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Food</button></a>
          <a href="buy.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Buy Ticket</button></a>
        </div>
      </div>
  </section>
    <section  class="container bodycont"  >
      <?php


          $username = $_SESSION["username"]; 

          $user = 'root';
          $pass = '';
          $db = 'scorpix';

          $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

          $qry = "SELECT First_name,Last_name,User_name,Email,Password,Phone_no,Birth_date,position,dp
                  FROM User
                  WHERE User_name = '$username'
                  " ;

          $print = $db_connect->query($qry) or die('bad query');

          $data = $print->fetch_assoc(); 
      ?>
      <h1 align="center"><?php echo $data["User_name"]; ?> </h1>
      <img class="pic" src="image/user/<?php echo $data['dp']?>" align="left">
      <div>
        <div>User name : <?php echo $data["User_name"]; ?></div>
        <div>First name : <?php echo $data["First_name"]; ?></div>
        <div>Last name : <?php echo $data["Last_name"]; ?></div>
      </div>
      <hr>
      <div>Email : <?php echo $data["Email"]; ?></div>
      <div>Phone Number : <?php echo $data["Phone_no"]; ?></div>
      <div>Birth date : <?php echo $data["Birth_date"]; ?></div>
      <div>Passowrd : **********   <span onclick="document.getElementById('pass').style.display='block'" class="see">Change Password</span></div>
      <div>Position : <?php echo $data["position"]; ?></div>
      <hr>


      <div> 
        <h1 align="center">Watched List </h1>


          <?php

          $qry = "SELECT User_name,name,poster
                  FROM watchlist
                  where User_name = '$username'
                  " ;

          
          $watched = $db_connect->query($qry) or die('bad query');

          $watchedcount = $watched->num_rows ; 
          $watched_data = $watched->fetch_assoc();  

         for($x=0 ; $x<$watchedcount ; $x++ )
          {?>         
              <div class="boxes">
                     <div class="gallery">
                        <a href="dynamic.php?name=<?=$watched_data['id'];?>">
                        <img src="image/poster/<?php echo $watched_data['poster']?>.jpg">
                        </a>
                         <div class="desc"><?php echo $watched_data['name'];?></div>
                      </div>
                  </div>
           <?php

          $watched_data = $watched->fetch_assoc();  
          }
      ?>
      </div>
          
      <?php  
      if(isset($_GET['error']))
      {
          $e=$_GET['error'];
        ?><div id="pass" class="modalwrong" >
          <form class="modal-content animate" action="change.php" method="POST">

              <div class="imgcontainer">
              <div class="container"><?php
          if($e=="confirm")
          { 
          ?><div class='red'>Password did not matched</div><?php
          
          }
         if($e=='old')
          {
          ?><div class='red'>Wrong Password</div><?php
          }
        }
        else
        {?>
              <div id="pass" class="modal " >
            
            <form class="modal-content animate" action="change.php" method="POST">

              <div class="imgcontainer">
              <div class="container"><?php
        }

    ?>
                <label for="uname"><b>Old Password</b></label>
                <input type="password" placeholder="Old Password" name="opsw" required>

                <label for="psw"><b>New Password</b></label>
                <input type="password" placeholder="New Password" name="npsw" required>

                <label for="psw"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="cpsw" required>

                <button type="button" onclick="document.getElementById('pass').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit">Change</button>
                <label>
                </label>
              </div>

              <div class="container" style="background-color:#f1f1f1">
                
              </div>
            </form>
          </div>

    </section>
    <footer>
    
  
      <p id="footer">
        Scorpix Movie Hall , copyright &copy 
      </p>
    </footer>
              
  </body>
</html>


