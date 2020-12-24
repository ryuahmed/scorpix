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
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/slideshow.css">
    <link rel="stylesheet" type="text/css" href="css/section_home.css">
    <link rel="stylesheet" type="text/css" href="css/modal_home.css">
    <link rel="stylesheet" type="text/css" href="css/buyticket.css">
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
    </div>

    
    <div class="container">
      <form class="buyform" action="confirm.php" method="POST">
        <h1 align="center">Buy Ticket</h1>
          <?php
             $user = 'root';
                  $pass = '';
                  $db = 'scorpix';

                  $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

                  $qry = "
                  SELECT name,id
                  FROM movie
                  WHERE status ='Now Showing'" ;

                  $now = $db_connect->query($qry) ;
          ?>
          <div class="row">
          <label class="drop_text" ><b>Movie : </b></label>
          <select name="movie_name" class="select_tab" required="required">
            <option value="" class="inside">Select Movie</option>
            <?php 
            while ($movie = $now->fetch_assoc()) 
            {
              ?><option value="<?php echo $movie['id']; ?>"> <?php echo $movie['name'] ; ?></option><?php
              
            }
            ?> 
            
          </select>
        </div>

                  <div class="row">

          <label class="drop_text"><b>Type(Hall and Seat) : </b></label><br>
          <select id="htype" class="select_tab type" name="htype" required="required">
            <option value="">Select Movie First</option>
          </select>


          <select id="stype" class="select_tab type" name="stype" required="required">
            <option value="">Select Seat Type</option>
            <option value="Reguler">Reguler</option>
            <option value="Premium">Premium</option>
          </select>

</div>


          <div class="row">

          <label class="drop_text" ><b>Time : </b></label>
          <select id="ttime" class="select_tab" name="ttime" required="required">
          <option value="">Select Hall First</option>
          </select>


</div>
          <div class="row">


          <label class="drop_text" ><b>Date : </b></label><br>
          <select name="year" class="selcet_date" required="required">
            <option value="">Year</option>
          </select>

          <select name="month" class="selcet_date" required="required">
            <option value="">Month</option>
          </select>

          <select name="day" class="selcet_date" required="required">
            <option value="">Day</option>


          </select>
</div>
          <div class="row">

          <label class="drop_text qua_text"  ><b>Quantity : </b></label><label class="drop_text qua_text red"  ><b>Total : </b></label>  <br>

          <select name="Quantity" class="select_tab qua" required="required">
            <option value="">Select Above First</option>
          </select>


          <select name="bill" class="select_tab qua" required="required">
            <option value=""> Calculating.....</option>

          </select>
          <script >


               $( "select[name='movie_name']" ).change(function () {
                  var movieid = $(this).val();
                    //alert("Asdad");

              $('select[name="htype"]').empty();
                var a = "Select Hall";
                $('select[name="htype"]').append('<option value="">'+ a +'</option>');   
              $('select[name="ttime"]').empty();
                var a = "Select Hall First";
                $('select[name="ttime"]').append('<option value="">'+ a +'</option>');

              $('select[name="ttime"]').empty();
                var a = "Select Hall First";
                $('select[name="ttime"]').append('<option value="">'+ a +'</option>');

              $('select[name="year"]').empty();
                var a = "Select Time First";
                $('select[name="year"]').append('<option value="">'+ a +'</option>');

              $('select[name="month"]').empty();
                var a = "Select year First";
                $('select[name="month"]').append('<option value="">'+ a +'</option>');

              $('select[name="day"]').empty();
                var a = "Select month First";
                $('select[name="day"]').append('<option value="">'+ a +'</option>');

              $('select[name="Quantity"]').empty();
                var a = "Select above first";
                $('select[name="Quantity"]').append('<option value="">'+ a +'</option>');                              

              $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');   

                  if(movieid) {

                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'id':movieid },

                          success: function(data)
                          {                           
                             $.each(data, function(key, value) {$('select[name="htype"]').append('<option value="'+ value +'">'+ value +'</option>');});
                          }


                      });


                  }



              });

                  $( "select[name='htype']" ).change(function () {
                  var htype = $(this).val();
                  var movieid = $("select[name='movie_name']").val();


              $('select[name="ttime"]').empty();
                var a = "Select Hall First";
                $('select[name="ttime"]').append('<option value="">'+ a +'</option>');

              $('select[name="ttime"]').empty();
                var a = "Select Hall First";
                $('select[name="ttime"]').append('<option value="">'+ a +'</option>');

              $('select[name="year"]').empty();
                var a = "Select Time First";
                $('select[name="year"]').append('<option value="">'+ a +'</option>');

              $('select[name="month"]').empty();
                var a = "Select year First";
                $('select[name="month"]').append('<option value="">'+ a +'</option>');

              $('select[name="day"]').empty();
                var a = "Select month First";
                $('select[name="day"]').append('<option value="">'+ a +'</option>');

              $('select[name="Quantity"]').empty();
                var a = "Select above first";
                $('select[name="Quantity"]').append('<option value="">'+ a +'</option>');                              

              $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');                    
                  
                  if(htype) {
                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'hall':htype,'mid':movieid },
                          
                          success: function(data) {
                              $('select[name="ttime"]').empty();
                              var b = "Select Time";
                              $('select[name="ttime"]').append('<option value="">'+ b +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="ttime"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });
                  }

              });

   $( "select[name='ttime']" ).change(function () {
                  var ttime = $(this).val();


              $('select[name="year"]').empty();
                var a = "Select Time First";
                $('select[name="year"]').append('<option value="">'+ a +'</option>');

              $('select[name="month"]').empty();
                var a = "Select year First";
                $('select[name="month"]').append('<option value="">'+ a +'</option>');

              $('select[name="day"]').empty();
                var a = "Select month First";
                $('select[name="day"]').append('<option value="">'+ a +'</option>');

              $('select[name="Quantity"]').empty();
                var a = "Select above first";
                $('select[name="Quantity"]').append('<option value="">'+ a +'</option>');                              

              $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  


                  if(ttime) {
                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'ttime':ttime },
                          success: function(data) {
                              $('select[name="year"]').empty();
                              var c = "Select Year";
                              $('select[name="year"]').append('<option value="">'+ c +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="year"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }
              });

            
              $( "select[name='year']" ).change(function () {
                  var year = $(this).val();

              $('select[name="month"]').empty();
                var a = "Select year First";
                $('select[name="month"]').append('<option value="">'+ a +'</option>');

              $('select[name="day"]').empty();
                var a = "Select month First";
                $('select[name="day"]').append('<option value="">'+ a +'</option>');

              $('select[name="Quantity"]').empty();
                var a = "Select above first";
                $('select[name="Quantity"]').append('<option value="">'+ a +'</option>');                              

              $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  
                  if(year) {
                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'year':year },
                          success: function(data) {
                              $('select[name="month"]').empty();
                              var c = "Select Month";
                              $('select[name="month"]').append('<option value="">'+ c +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="month"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }
              });
              $( "select[name='month']" ).change(function () {
                  var month = $(this).val();

              $('select[name="day"]').empty();
                var a = "Select month First";
                $('select[name="day"]').append('<option value="">'+ a +'</option>');

              $('select[name="Quantity"]').empty();
                var a = "Select above first";
                $('select[name="Quantity"]').append('<option value="">'+ a +'</option>');                              

              $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  

                  if(month) {
                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'month':month },
                          success: function(data) {
                              $('select[name="day"]').empty();
                              var c = "Select Day";
                              $('select[name="day"]').append('<option value="">'+ c +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="day"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }
              });                  

              $( "select[name='day']" ).change(function () {
                  var day = $(this).val();
                  var movieid = $("select[name='movie_name']").val();
                  var htype = $("select[name='htype']").val();
                  var stype = $("select[name='stype']").val();
                  var ttime = $("select[name='ttime']").val();
                  var month = $("select[name='month']").val();
                  var year = $("select[name='year']").val();
                $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  
                  if(stype) {
                                     // alert(0);

                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'day':day,'movieid':movieid,'htype':htype,'stype':stype,'time' : ttime,'mnth' : month , 'yr' : year },
                          success: function(data) {
                              $('select[name="Quantity"]').empty();
                              var c = "Quantity";
                              $('select[name="Quantity"]').append('<option value="">'+ c +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="Quantity"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }else{
                      $('select[name="Quantity"]').empty();
                      var c = "Select Seat Type First";
                              $('select[name="Quantity"]').append('<option value="">'+ c +'</option>');
                  }
              });

              $( "select[name='stype']" ).change(function () {
                  var stype = $(this).val();
                  var movieid = $("select[name='movie_name']").val();
                  var htype = $("select[name='htype']").val();
                  var day = $("select[name='day']").val();
                  var ttime = $("select[name='ttime']").val();
                  var month = $("select[name='month']").val();
                  var year = $("select[name='year']").val();

                                $('select[name="bill"]').empty();
                var a = "Calculating.....";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  
                  if(day) {
                                     // alert(0);

                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'day':day,'movieid':movieid,'htype':htype,'stype':stype,'time' : ttime,'mnth' : month , 'yr' : year },
                          success: function(data) {
                              $('select[name="Quantity"]').empty();
                              var c = "Quantity";
                              $('select[name="Quantity"]').append('<option value="">'+ c +'</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="Quantity"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }else{
                      $('select[name="Quantity"]').empty();
                      var c = "Select Date First";
                              $('select[name="Quantity"]').append('<option value="">'+ c +'</option>');
                  }
              });

              $( "select[name='Quantity']" ).change(function () {
                  var qua = $(this).val();
                  var movieid = $("select[name='movie_name']").val();
                  var htype = $("select[name='htype']").val();
                  var stype = $("select[name='stype']").val();
                  var ttime = $("select[name='ttime']").val();
                  var day = $("select[name='day']").val();
                  var month = $("select[name='month']").val();
                  var year = $("select[name='year']").val();
                  if(qua) {
                                     // alert(0);

                      $.ajax({
                          url: "buyticket_ajax.php",
                          dataType: 'Json',
                          data: {'day1':day,'movieid1':movieid,'htype1':htype,'stype1':stype,'time1' : ttime,'mnth1' : month , 'yr1' : year,'qua' : qua },
                          success: function(data) {
                              $('select[name="bill"]').empty();
                              $.each(data, function(key, value) {
                                  $('select[name="bill"]').append('<option value="'+ value +'">'+ value +'</option>');
                              });
                          }
                      });

                  }else{
                var a = "Technical difficulties";
                $('select[name="bill"]').append('<option value="">'+ a +'</option>');  
                  }
              });

          </script>

          <script>





          </script>
</div>
          <input class="input_buttom rest_buttom" type="reset"  value="Reset">
          <input class="input_buttom submit_buttom" type="submit"  value="Buy Ticket">
                
      </form>

      
    </div>
    <footer>
    
  
      <p id="footer">
        Scorpix Movie Hall , copyright &copy 
      </p>
    </footer>
              
  </body>
</html>
