
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
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/news_list.css">  </head>

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
      </div>
    </header>

          

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
          <div class="txt" align="center" >
          <?php 
          $msg_id=$_GET['msg_id'];



          $qry = "
                SELECT data,subject,sender,date
                FROM inbox 
                where msg_id='$msg_id'        
          " ;

          $msg = $db_connect->query($qry) ;
          $msgdata = $msg->fetch_assoc();

               $s= $msgdata["sender"];
             $qry = "
                SELECT position
                FROM user 
                where User_name='$s'
              " ;
              $sender = $db_connect->query($qry) ;
              $s = $sender->fetch_assoc();

                  $qry = " UPDATE inbox SET seen = '1' where msg_id = '$msg_id' ";
    $food = $db_connect->query($qry) or die('bad query');
          ?>
          <div class="bold listpace" align="left">Subject : <?php echo $msgdata['subject']; ?><div class="">date : <?php echo $msgdata['date']; ?></div><div class=""><?php if($s['position']!="User" || $s['position']!="Auto"){echo $s['position']; } echo " :";echo $msgdata['sender']; ?></div> </div>          <hr>



          <div class="" align="justify">

            <div class=""><?php echo $msgdata['data']; ?></div>

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


