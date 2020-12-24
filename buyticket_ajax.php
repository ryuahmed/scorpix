

<?php
//Include the database configuration file
$user = 'root';
      $pass = '';
      $db = 'scorpix';

$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
          $json = [];

          $year = date("Y") ;
          $month = date("m") ;
          $day = date("d") ;


    if(isset($_GET["id"]))
    {
     
      $x = $_GET["id"] ; 

      

      $qry = "
              SELECT h_type as h ,movie_id
              FROM now_showing join hall 
              WHERE now_showing.h_id = hall.h_id and movie_id = '$x'
            ";

      $hall = $db_connect->query($qry) ;
           $json = [];

           $i=0;
           $n=0;
           $p=0;
           $v=0 ; 
           
           
           $i++;
            while ($data = $hall->fetch_assoc()) 
            {
                $value = $data['h'] ;


                if($value=="Normal" and $n==1)
                    continue ;

                if($value=="Premium" and $p==1)
                    continue;

                if($value=="V.I.P." and $v==1)
                    continue;
     
                
                  $json[$i] = $value;
                  $i++;

                if($value=="Normal")
                    $n=1;

                if($value=="Premium")
                    $p=1;

                if($value=="V.I.P.")
                    $v=1;
            }
   

              echo json_encode($json);
          }

         if(isset($_GET["hall"])) {

    $h = $_GET["hall"] ;
    $m = $_GET["mid"] ; 


    $qry = "
            SELECT time 
            from now_showing NATURAL join hall
            where movie_id = '$m' and h_type = '$h' 
    " ;
    
    $time = $db_connect->query($qry) ;
    $json = [];

    $i=0;
    $i++;

    while ($data = $time->fetch_assoc()) 
    {
        $value = $data['time'];
        $json[$i] = $value;
        $i++;
    }

echo json_encode($json);

}

    if(isset($_GET["ttime"])) 
    {


          $i = 0 ; 
          $json[$i] = $year;
          $i++ ; 

          if($month==12 and $day>= 25)
              {
                $y++ ;
                $json[$i] = $year;
              }
echo json_encode($json);


    }

    if(isset($_GET["year"])) 
    {

          $selectedyear = $_GET["year"];

          $month = $month+ 0 ;

          $i = 0 ; 


          if($month==1 ||$month==3 ||$month==5 ||$month==7 ||$month==8 ||$month==10 ||$month==12)
              {

                $l = 31 ; 

              }

          if($month==4 ||$month==6 ||$month==9 ||$month==11 )
              {
                  $l= 30 ;
              }

          if($month==2)
              {
                  $l= 28 ;
              }
          if($day+7 > $l)
          {
    
            $i=1 ; 
            if($month > 12)
            {
              $i=2 ; 
                $month = 1 ; 
            }
          }

            $json[$i] = $month;
          if($i==1)
          {
              $month++;
              $i++;
              $json[$i] = $month;
          }
              
echo json_encode($json);

    }

        if(isset($_GET["month"])) 
    {

          $day=$day+0;

          $selectedmonth = $_GET["month"];

          if($month==1 ||$month==3 ||$month==5 ||$month==7 ||$month==8 ||$month==10 ||$month==12)
            {

              $l = 31 ;

            }

          if($month==4 ||$month==6 ||$month==9 ||$month==11 )
              {
                  $l= 30 ;
              }

          if($month==2)
              {
                  $l= 28 ;
              }


          $limit=$l-$day+1;

          if($month<$selectedmonth)
          {
  
              $limit = 7-$limit ;
              $day=1;
          }

          for($x= 0; $x<7 and $x < $limit ; $x++)
          {
              $json[$x] = $day;
              $day++;
            }

echo json_encode($json);

    }

    if(isset($_GET["day"])) 
    {

          
$movieid = $_GET["movieid"];     
          $htype = $_GET["htype"];
          $stype = $_GET["stype"];
          $ttime = $_GET["time"];
          $selectedday = $_GET["day"];
          $selectedmonth = $_GET["mnth"];
          $selectedyear = $_GET["yr"];
          $date = $selectedday."-".$selectedmonth."-".$selectedyear;

            

          $sql = "
        SELECT row ,colum
        FROM hall_seat
        WHERE hall_type = '$htype' and seat_type = '$stype'
          ";

          $hall = $db_connect->query($sql) ;
          $data = $hall->fetch_assoc();   

          $row = $data['row'];
          $colum = $data['colum'] ; 

          $total_type = $row*$colum ;  
          //$json[0] = $total_type;

            if($stype=="Reguler")
             {
              $code=".r";
             }
              

            if($stype=="Premium")
            {
              $code=".p";
            }

              $qry = "
                  SELECT h_id
                  from hall
                  WHERE h_type = '$htype'
                        ";

                $hall = $db_connect->query($qry) ;
                $data = $hall->fetch_assoc();
                $hid= $data['h_id'];


          $qry = "
              SELECT COUNT(*) as x 
              FROM sold
              where movie_id = '$movieid' AND hall_id = '$hid' And time = '$ttime' And date ='$date' and seat like '%$code'
           ";

          $sold = $db_connect->query($qry) ;
          $data = $sold->fetch_assoc();

          $soldtype =  $data['x'] ;
          $avaitype = $total_type - $soldtype ; 
          for($x= 1; $x<=10  and $x<$avaitype; $x++)
              $json[$x] = $x;



echo json_encode($json);

    }

    if(isset($_GET["day1"])) 
    {

          
          $m = $_GET["movieid1"];     
          $h = $_GET["htype1"];
          $s = $_GET["stype1"];
          $t = $_GET["time1"];
          $q = $m = $_GET["qua"];  
          $selectedday = $_GET["day1"];
          $selectedmonth = $_GET["mnth1"];
          $selectedyear = $_GET["yr1"];
          $date = $selectedday."-".$selectedmonth."-".$selectedyear;

            

   $qry = "
      SELECT price 
      FROM ticket join movie join now_showing
      WHERE m_type = type and now_showing.At = ticket.time and movie_id = id and id = '10001' and ticket.h_type = '$h'
            ";

    $price = $db_connect->query($qry) ;

    $data = $price->fetch_assoc();   

    if($s == "Premium" )
    {
      $bill = 50; 
      if($h=="V.I.P.")
        $bill=100 ; 
    }
    else
      $bill = 0 ;

    $bill = $data['price']+$bill;
    $bill = $bill*$q ;
    $bill = $bill." Tk" ;
    $json[0] = $bill ;

echo json_encode($json);

    }
  



?>

              