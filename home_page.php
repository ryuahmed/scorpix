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



            if($position_data['position'] == 'Moderator')
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


          <?php


            $qry = "SELECT link,caption
                    from slideshow
                    where status='active'" ;
            $link = $db_connect->query($qry) ;
            $dot=$link->num_rows ; 

            $slidelink = $link->fetch_assoc();
          ?>

          <div class="slideshow-container">
       

            <?php 

        for($x=0 ; $x<$dot ; $x++ )
          {
            ?>

            <div class="mySlides fade">

                    <img class="z" src="image/slideshow/<?php echo $slidelink['link']?>.jpg" style="width:100%">
                      <div class="text"><?php echo $slidelink['caption']?></div>
                  </div>


            <?php 
        
            $slidelink = $link->fetch_assoc(); 
          }

      ?>

            

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

          </div>


          <div style="text-align:center" class="t">
            <?php 

        for($x=0 ; $x<$dot ; $x++ )
          {
            ?><span class="dot" onclick="currentSlide(<?php echo $x ; ?>)"></span><?php 
          }

      ?>
            
          </div>
        </div>
      </div>

        <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusSlides(n) {
              showDivs(slideIndex += n);
            }

            function currentSlide(n) {
              showDivs(slideIndex = n);
            }

            function showDivs(n) {
              var i;
              var x = document.getElementsByClassName("mySlides");
              if (n > x.length) {slideIndex = 1}    
              if (n < 1) {slideIndex = x.length}
              for (i = 0; i < x.length; i++) {
                 x[i].style.display = "none";  
              }
              x[slideIndex-1].style.display = "block"; 
              setTimeout(5000)  
            }

            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";  
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
                setTimeout(carousel, 5000); // Change image every 2 seconds
            }
        </script>
    </section>





    <section  class="container bodycont"  >

      <div id="ibuttom_container" align="left">

        <button class="ibuttom" id='all'onclick="openCity(event, 'All')">All movie</button>
        <button class="ibuttom" onclick="openCity(event, 'Now')">Now showing</button>
        <button class="ibuttom" onclick="openCity(event, 'Up')">Upcoming</button>
        <button class="ibuttom" onclick="openCity(event, 'Sp')">Special</button>  



        <?php


            $qry = "SELECT movie.poster ,movie.name ,movie.id
          FROM movie join poster
          WHERE 
          movie.id = poster.movie_id and
          poster.show_pic = 'active'";

            $all = $db_connect->query($qry) ;


            $qry = "SELECT movie.poster ,movie.name ,movie.id
          FROM movie join poster
          WHERE  movie.status = 'Now Showing'  and
          movie.id = poster.movie_id and
          poster.show_pic = 'active'";
            $now = $db_connect->query($qry) ;

      $qry = "SELECT movie.poster ,movie.name ,movie.id
          FROM movie join poster
          WHERE  movie.status = 'Up Coming'  and
          movie.id = poster.movie_id and
          poster.show_pic = 'active'";
            $up = $db_connect->query($qry) ;

      $qry = "SELECT movie.poster ,movie.name,movie.id 
          FROM movie join poster
          WHERE  movie.status = 'Special'  and
          movie.id = poster.movie_id and
          poster.show_pic = 'active'" ;
            $sp = $db_connect->query($qry) ;

            $nowcount = $now->num_rows ; 
            $upcount = $up->num_rows; 
            $spcount = $sp->num_rows; 

            $alldata = $all->fetch_assoc();
            $nowdata = $now->fetch_assoc();
            $updata = $up->fetch_assoc();
            $spdata = $sp->fetch_assoc();
            
          ?>


        <div id="All" class="ibuttomcontent" >

          <?php 

        for($x=0 ; $x<4 ; $x++ )
          {
            ?>
              <div class="boxes">
                     <div class="gallery">
                        <a href="dynamic.php?name=<?=$alldata['id'];?>">
                        <img src="image/poster/<?php echo $alldata['poster']?>.jpg">
                        </a>
                         <div class="desc smalltext" ><?php echo $alldata['name']?></div>
                      </div>
                  </div>

            <?php 

            $alldata = $all->fetch_assoc();
          }

      ?>     
 
    <a href="list.php?type=All Movie List"> <i class="right"></i></a>
  
        </div>



        <div id="Now" class="ibuttomcontent">

                    <?php 

        for($x=0 ; $x<$nowcount && $x<4; $x++ )
          {
            ?>
                      <div class="boxes">
                         <div class="gallery">
                            <a href="dynamic.php?name=<?=$nowdata['id'];?>">
                              <img src="image/poster/<?php echo $nowdata['poster']?>.jpg">
                            </a>
                             <div class="desc smalltext"><?php echo $nowdata['name']?></div>
                          </div>
                      </div>
            <?php 

            $nowdata = $now->fetch_assoc();
          }

      ?>
      <a href="list.php?type=Now Showing"> <i class="right"></i></a>        
    </div>
        

        <div id="Up" class="ibuttomcontent">

                    <?php 

        for($x=0 ; $x<$upcount && $x<4 ; $x++ )
          {
            ?>
                      <div class="boxes">
                         <div class="gallery">
                             <a href="dynamic.php?name=<?=$alldata['id'];?>">
                            <img src="image/poster/<?php echo $updata['poster']?>.jpg">
                            </a>
                             <div class="desc smalltext"><?php echo $updata['name']?></div>
                          </div>
                      </div>
            <?php 

            $updata = $up->fetch_assoc();
          }

      ?>
      <a href="list.php?type=Up Coming"> <i class="right"></i></a>        
        </div>

        <div id="Sp" class="ibuttomcontent">

                    <?php 

        for($x=0 ; $x<$spcount && $x<4 ; $x++ )
          {
            ?>
                      <div class="boxes">
                         <div class="gallery">
                            <a href="dynamic.php?name=<?=$alldata['id'];?>">
                            <img src="image/poster/<?php echo $spdata['poster']?>.jpg">
                            </a>
                             <div class="desc smalltext"><?php echo $spdata['name']?></div>
                          </div>
                      </div>
            <?php 

            $spdata = $sp->fetch_assoc();
          }

      ?>
      <a href="list.php?type=Special"> <i class="right"></i></a>        
        </div>

      <div class="ibuttom_container news" align="left">
        <button class="ibuttom noHover">News</button>
        <button class="ibuttomnews noHover"> b</button>
        <a href="news_list.php"><button class="ibuttom">more</button></a>

        <?php


          $qry = "
                SELECT news_id,title,description,added
                FROM news 
                ORDER by added DESC         
          " ;

          $news = $db_connect->query($qry) ;
          $newsdata = $news->fetch_assoc();

          ?>
          <div class="hotnews">
            <span class="bold "> <?php echo $newsdata['title']; ?></span>
            <div class="smalltext">date : <?php echo $newsdata['added']; ?></div>
            <div class="newsdiscropp"><?php echo $newsdata['description']; ?></div>
            <a href="news.php?news_id=<?=$newsdata['news_id'];?>" class="see">see more</a>

          </div>


          <div class="morenews">
              <?php

              $newsdata = $news->fetch_assoc();

              for($x=1 ; $x<$news->num_rows && $x<4; $x++)
              {
      
                ?>
                <div class="fewnews bold"><?php echo $newsdata['title']; ?><div class="smalltext">date : <?php echo $newsdata['added']; ?></div><a href="news.php?news_id=<?=$newsdata['news_id'];?>" class="see">see more</a> </div>

             
                 <?php       
                 $newsdata = $news->fetch_assoc();
               }?>



            </div>
        </div>
      <script>

          document.getElementById("all").click();    //auto click

          //content cahnge
          function openCity(evt, cityName)
          {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("ibuttomcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("ibuttom");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" now", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " now";
        }


          // Add active class to the current button (highlight it)
          var header = document.getElementById("ibuttom_container");
          var btns = header.getElementsByClassName("ibuttom");
          for (var i = 0; i < btns.length; i++) 
          {
            btns[i].addEventListener("click", function() {
              var current = document.getElementsByClassName("this");
              current[0].className = current[0].className.replace(" this", "");
              this.className += " this";
            });
          }
      </script>

      </div>

      <div class="right_container">

        
        <div class="right_sec">
          <div class="reight_sec_container_header">Notice</div>

            <div class="right_container_of_text">Scorpix is open seven days a week including Tuesdays. </div>
   

        </div>
        
        
        <div name="R1" id="R1" class=right_sec>
          <?php

            $qry = "
            SELECT tag , ques ,pid
            FROM show_this_poll  join poll
            WHERE poll_id=pid and poll_sec = 'R1'
                ";

            $R1 = $db_connect->query($qry) ;
            $R1data = $R1->fetch_assoc() ;
            $R1id = $R1data['pid'];

            ?>
            <div class="reight_sec_container_header"><?php echo $R1data['tag']; ?></div>
            <div class="right_container_of_text">

              <div class="vote_sub"><?php echo $R1data['ques']; ?></div>
              <div id="R1_inside">
                 <?php

                  if(isset($_SESSION['username']))
                  {
                    $uname = $_SESSION['username'];
                  }
                  else
                    $uname  = "" ;                  
                  $qry = "
                          SELECT uid
                          FROM poll_vote
                          WHERE uid='$uname' and pid='$R1id'
                      ";
                  $R1option = $db_connect->query($qry) ;
                  $numb = $R1option->num_rows ; 
                  if($numb==1)
                  {

                    $qry = "
                            SELECT COUNT(*) as vote ,pid,op
                            FROM poll_vote
                            GROUP by  op,pid
                            HAVING pid = $R1id
                      ";
                    $vote = $db_connect->query($qry) or die('bad query');
                    $total=0 ;
                    $numb=0 ; 
                    $option =[]; 
                    $percent = [] ; 
                    $data = [] ; 
                    while($vote_data = $vote->fetch_assoc())
                        {
                          $option[$numb] = $vote_data['op'];
                          $data[$numb] = $vote_data['vote'];
                          $total = $total+$vote_data['vote'];
                          $numb++;
                        }

                    $qry = "
                            SELECT p_option
                            FROM poll_option
                            where pid = $R1id 
                      ";
                    $op = $db_connect->query($qry) or die('bad query');

                    ?><table class ="poll_table"><?php 

                    while($op_data = $op->fetch_assoc())
                        {
                          for($x=0 ; $x<$numb ; $x++)
                              {
                                  $flag=0;
                                  if($op_data['p_option']==$option[$x])
                                  {
                                    $flag=1 ;
                                    $percent[$x]  = 100*$data[$x]/$total ; 
                                    ?> 
                                    <tr>                     
                                    <th class ="poll_table smalltext" align="left"><label ><?php echo $op_data['p_option']; ?> : </label></th>
                                    <th class="smalltext"> <?php echo number_format((float)$percent[$x] , 1, '.', ''); ?> % </th>
                                    <th align="left"><img src ="image/poll.png"  class ="right_container_of_text" width="<?php echo $percent[$x] ;  ?>%" height = "5"></th>
                                    </tr>               
                                    <?php                                    
                                    break ; 
                                  }                                
                              }
                          if($flag==0)
                          {
                            ?> 
                            <tr>                     
                            <th class ="poll_table smalltext" align="left"><label ><?php echo $op_data['p_option']; ?> : </label></th>
                            <th> 0% </th>
                            <th align="left"><img src ="image/poll.png"  class ="right_container_of_text" width="0%" height = "5"></th>
                            </tr>               
                            <?php  
                          }

                        }
                            ?></table><?php
                      

                  }
                  else{
                                      $qry = "
                  SELECT p_option
                  FROM poll_option
                  WHERE pid='$R1id'
                      ";

                  //echo $R1id ;

                  $R1option = $db_connect->query($qry) ;
                 // $R1optiondata = $R1option->fetch_assoc();
                 ?><table class ="poll_table"><?php
                  while($R1optiondata = $R1option->fetch_assoc() )
                  {

                    ?>
                    <tr>
                    <label class="poolcontainer"><?php echo $R1optiondata['p_option'] ; ?> 
                    <input type="radio" name='R1' class="check_list" value="<?php echo $R1optiondata['p_option'] ; ?>">
                    <span class="checkmark"></span></label></tr>
                  <?php

                   } 

                  ?></table>
                  <!--<input type="submit" value="Submit" onclick="poll()">-->
                  <button id="R1_button"  >Submit</button>
                  <?php
                  }?>


     
                </div>
              </div>
          </div>

          <div name="R2" id="R2" class=right_sec>
          <?php

            $qry = "
            SELECT tag , ques ,pid
            FROM show_this_poll  join poll
            WHERE poll_id=pid and poll_sec = 'R2'
                ";

            $R2 = $db_connect->query($qry) ;
            $R2data = $R2->fetch_assoc() ;
            $R2id = $R2data['pid'];

            ?>
            <div class="reight_sec_container_header"><?php echo $R2data['tag']; ?></div>
            <div class="right_container_of_text">

              <div class="vote_sub"><?php echo $R2data['ques']; ?></div>
              <div id="R2_inside">
                 <?php

                  if(isset($_SESSION['username']))
                  {
                    $uname = $_SESSION['username'];
                  }
                  else
                    $uname  = "" ;
                  $qry = "
                          SELECT uid
                          FROM poll_vote
                          WHERE uid='$uname' and pid='$R2id'
                      ";
                  $R2option = $db_connect->query($qry) ;
                  $numb = $R2option->num_rows ; 
                  if($numb==1)
                                    {

                    $qry = "
                            SELECT COUNT(*) as vote ,pid,op
                            FROM poll_vote
                            GROUP by  op,pid
                            HAVING pid = $R2id
                      ";
                    $vote = $db_connect->query($qry) or die('bad query');
                    $total=0 ;
                    $numb=0 ; 
                    $option =[]; 
                    $percent = [] ; 
                    $data = [] ; 
                    while($vote_data = $vote->fetch_assoc())
                        {
                          $option[$numb] = $vote_data['op'];
                          $data[$numb] = $vote_data['vote'];
                          $total = $total+$vote_data['vote'];
                          $numb++;
                        }

                    $qry = "
                            SELECT p_option
                            FROM poll_option
                            where pid = $R2id 
                      ";
                    $op = $db_connect->query($qry) or die('bad query');

                    ?><table class ="poll_table"><?php 

                    while($op_data = $op->fetch_assoc())
                        {
                          for($x=0 ; $x<$numb ; $x++)
                              {
                                  $flag=0;
                                  if($op_data['p_option']==$option[$x])
                                  {
                                    $flag=1 ;
                                    $percent[$x]  = 100*$data[$x]/$total ; 
                                    ?> 
                                    <tr>                     
                                    <th class ="poll_table smalltext" align="jus"><label ><?php echo $op_data['p_option']; ?> : </label></th>
                                    <th class="smalltext"> <?php echo number_format((float)$percent[$x] , 1, '.', ''); ?> % </th>
                                    <th align="left"><img src ="image/poll.png"  class ="right_container_of_text" width="<?php echo $percent[$x] ;  ?>%" height = "5"></th>
                                    </tr>               
                                    <?php                                    
                                    break ; 
                                  }                                
                              }
                          if($flag==0)
                          {
                            ?> 
                            <tr>                     
                            <th class ="poll_table smalltext" align="left"><label ><?php echo $op_data['p_option']; ?> : </label></th>
                            <th class="smalltext"> 0% </th>
                            <th align="left"><img src ="image/poll.png"  class ="right_container_of_text" width="0%" height = "5"></th>
                            </tr>               
                            <?php  
                          }

                        }
                            ?></table><?php
                      

                  }

                  else{
                                      $qry = "
                  SELECT p_option
                  FROM poll_option
                  WHERE pid='$R2id'
                      ";

                  //echo $R1id ;

                  $R2option = $db_connect->query($qry) ;
                 // $R1optiondata = $R1option->fetch_assoc();
                 ?><table class ="poll_table"><?php
                  while($R2optiondata = $R2option->fetch_assoc() )
                  {

                    ?>
                    <tr>
                    <label class="poolcontainer"><?php echo $R2optiondata['p_option'] ; ?> 
                    <input type="radio" name='R2' class="check_list" value="<?php echo $R2optiondata['p_option'] ; ?>">
                    <span class="checkmark"></span></label></tr>
                  <?php

                   } 

                  ?></table>
                  <!--<input type="submit" value="Submit" onclick="poll()">-->
                  <button id="R2_button"  >Submit</button>
                  <?php
                  }?>


     
                </div>
              </div>
          </div>


          <script>

            $(document).ready(function() {
                 $("#R1_button").click(function(){
                   // alert("asd");

                    var op = document.querySelector('.check_list:checked').value;
                    var id = "<?php echo $R1id ?>";
                    if(op) 
                    {
                      $("#R1_inside").empty(); 
                      //alert("asd");
                      $.ajax({
                                url: "poll_ajax.php", 
                                dataType: 'Json',
                                data: {'pid':id,'vote':op},
                                  success: function(data)
                                            {  
                                            $.each(data, function(key, value) {
                                              $("#R1_inside").append('<label class="smalltext">'+key+' </label></br><img src ="image/poll.png"  class ="right_container_of_text" width="'+value+'%" height = "5"></br>');  

                                            });
                                            }
                              });
                    }
    }); 
});  
                  $(document).ready(function() {
                 $("#R2_button").click(function(){
                   // alert("asd");

                    var op = document.querySelector('.check_list:checked').value;
                    var id = "<?php echo $R2id ?>";
                    if(op) 
                    {
                      $("#R2_inside").empty(); 
                      //alert("asd");
                      $.ajax({
                                url: "poll_ajax.php", 
                                dataType: 'Json',
                                data: {'pid':id,'vote':op},
                                  success: function(data)
                                            {  
                                            $.each(data, function(key, value) {
                                              $("#R2_inside").append('<label class="smalltext" >'+key+' </label></br><img src ="image/poll.png"  class ="right_container_of_text" width="'+value+'%" height = "5"></br>');  

                                            });
                                            }
                              });
                    }
    }); 
});

          </script>
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
