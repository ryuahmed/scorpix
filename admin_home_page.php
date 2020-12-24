

<?php
    if (!session_id()) 
   {
    session_start();
   }
    if ($_SESSION['valid'] == true)
    { 
           header('Location:user page.php');

          die();
      }
      $_SESSION['valid'] = false ; 


?>
<!DOCTYPE html>
 <html>
  <head>
    <title>Home page</title>
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
      </div>
    </header>



    <section id="showcase">
      <div class="container">
      	<div align="center" >
          
            <a href="show_time.php"><button class="nav" name="type" type="submit" value="fav_HTML" >Show Time</button></a>
            <a href="list.php?type=Up Coming"><button class="nav">Up Coming</button></a>
            <a href="ticket.php"><button class="nav">Ticket</button></a>        
            <button class="nav" name="type" type="submit" value="fav_HTML" >Food</button>
          

          <?php
            $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

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





    <section  class="container bodycolor"  >

      <div id="ibuttom_container" align="left">

        <button class="ibuttom this now" onclick="openCity(event, 'All')" onload="openCity(event, 'All')">All movie</button>
        <button class="ibuttom" onclick="openCity(event, 'Now')">Now showing</button>
        <button class="ibuttom" onclick="openCity(event, 'Up')">Upcoming</button>
        <button class="ibuttom" onclick="openCity(event, 'Sp')">Special</button>  



        <?php
            $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

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
				                 <div class="desc"><?php echo $alldata['name']?></div>
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
						                 <div class="desc"><?php echo $nowdata['name']?></div>
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
						                 <div class="desc"><?php echo $updata['name']?></div>
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
						                 <div class="desc"><?php echo $spdata['name']?></div>
						              </div>
						          </div>
						<?php 

						$spdata = $sp->fetch_assoc();
					}

			?>
			<a href="list.php?type=Special"> <i class="right"></i></a>        
        </div>

      
      <script>
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
        
        
        <div class=right_sec>
          <?php
            $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

            $qry = "
              SELECT name, id,value
              FROM  movie join poll
              WHERE m_id = id
                   ";

            $pool = $db_connect->query($qry) ;

            if(!isset($_SESSION['poll_vote_movie']))
               $_SESSION['poll_vote_movie'] = fales ; 
            
            if($_SESSION['poll_vote_movie'] ==false)
            {
                ?>
          <div class="reight_sec_container_header">Vote for movie</div>
          <div class="vote_sub">Movie that you want to watch </div>
          <form action="vote_movie.php" method="POST">

          <?php
              while($data = $pool->fetch_assoc())
              {
               ?>
            <label class="poolcontainer"><?php echo $data['name'] ; ?> 
              <input type="radio"  name="check_list[]" value="<?php echo $data['id'] ; ?>">
              <span class="checkmark"></span>  
            </label>

            <?php } ?>

            <input type="submit" value="Submit"></input>
        </form>
        <?php } 

           if( $_SESSION['poll_vote_movie'] ==true) {
               ?>           
               <div class="reight_sec_container_header">Result</div>
               <div class="right_container_of_text">
                <?php
          while($data = $pool->fetch_assoc())
              {
              
                

                echo $data['name'] ;
                echo $data['value'] ;
                ?> <br><?php 
              }
                


         
       }?>
            </div>
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
