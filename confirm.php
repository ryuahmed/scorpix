<?php
   if (!session_id()) 
   {
    session_start();
   }

	$m=$_POST["movie_name"];
	$h=$_POST["htype"];
	$s=$_POST["stype"];
	$t=$_POST["ttime"];
	$q=$_POST["Quantity"];
	$day=$_POST["day"];
	$month=$_POST["month"];
	$year=$_POST["year"];
	$date = $day."-".$month."-".$year;
	$bill = $_POST["bill"];
	$user_name = $_SESSION['username'] ;
	$r=rand()*rand();
	 $r = dechex (  $r );



	$user = 'root';
     $pass = '';
     $db = 'scorpix';

	$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

	 	 	 	$qry = "
				SELECT name
				FROM movie
				where id='$m'
            ";

    $movie = $db_connect->query($qry) ;
    $moviedata = $movie->fetch_assoc();   
    $mname = $moviedata['name'];

	$data='You have bought '.$q.' of '.$mname.'for '.$date.' at '.$t.',  hall type : '.$h.',  seat type : '.$s.', show the give code to counter and gate ticket : '.$r;

	$qry = " insert into confirmation (user_id,code)
				VALUES ('$user_name','$r')" ;

	$res = $db_connect->query($qry) or die('bad query');

	 	 	 	$qry = "
				SELECT mx
				FROM max_msg
            ";

    $mx = $db_connect->query($qry) ;
    $mxdata = $mx->fetch_assoc();   
    $max = $mxdata['mx'];
    $max = $max+1 ; 

	 	   $year = date("Y") ;
          $month = date("m") ;
          $day = date("d") ;

        $today = $day."-".$month."-".$year;
	$qry = " insert into inbox (sender,reciver,subject,date,data,msg_id)
				VALUES ('Auto','$user_name','Ticket Confirmation','$today','$data','$max')" ;

	$res = $db_connect->query($qry) or die('bad query');

	$qry = "
			SELECT h_id
			from hall
			WHERE h_type = '$h'
            ";

    $hall = $db_connect->query($qry) ;
        $data = $hall->fetch_assoc();
    $hid= $data['h_id'];




	$qry = "
				SELECT row ,colum
				FROM hall_seat
				WHERE hall_type = '$h' and seat_type = '$s'
            ";

    $hall = $db_connect->query($qry) ;
    $data = $hall->fetch_assoc();   

    $row = $data['row'];
    $colum = $data['colum'] ; 

    $total_type = $row*$colum ; 
    //echo $total_type ; 
   // echo " " ;


	if($s=="Reguler")
	 {
		$code=".r";
	 }
	 	

	if($s=="Premium")
	{
	 	$code=".p";
	}


	$qry = "
			SELECT COUNT(*) as x 
			FROM sold
			where movie_id = '$m' AND hall_id = '$hid' And time = '$t' And seat like '%$code'
	 ";

	$sold = $db_connect->query($qry) ;
	$data = $sold->fetch_assoc();

	$soldtype =  $data['x'] ;
	$avaitype = $total_type - $soldtype ; 


		 if($s=="Reguler")
	 {
		$limit = $avaitype ; 
	 }
	 	

	if($s=="Premium")
	{

	 	$qry = "
				SELECT row ,colum
				FROM hall_seat
				WHERE hall_type = '$h' 
            ";

    $hall = $db_connect->query($qry) ;

    $data = $hall->fetch_assoc();   
	$limit = $data['row'] *$data['colum'];
	
    $data = $hall->fetch_assoc();   
	$limit = $limit+$data['row'] *$data['colum'] -$soldtype;
	}

	//echo  $soldp;
 
	//die() ;

	 if($avaitype > $q)
	 {

	 	$seat_row = "A" ; 
	 	$seat_colum = 1 ;

	 	for($i=1 ; $i<$limit ; $i++)
	 	{


	 		if($i%$colum==0)
	 		{
	 			$seat_colum = 0 ;
	 			$seat_row++;

	 		}
	 		$seat_colum++;
	 	}


	 	$qry = "
				SELECT max(ticket_id) as t
				FROM sold
            ";

    $ticket = $db_connect->query($qry) ;
    $data = $ticket->fetch_assoc();   
    $ticket_ = $data['t'];


    echo $bill ;
	 for($x=0 ; $x<$q ; $x++)
	 		{
	 			$ticket_++ ;
	 			$seat_no = $seat_row.$seat_colum ; 
	 			$seat_ = $seat_no.$code ;

	 	
	 			//die();
	 			$qry = "
					insert into sold (ticket_id , movie_id,hall_id,user_id,time,seat,date)
					VALUES ('$ticket_','$m','$hid','$user_name','$t','$seat_ ','$date')
					" ;
					$res = $db_connect->query($qry) or die('bad query');
				$seat_colum=$seat_colum -1 ;
	 		}
	 		     	header("Location: home_page.php");

	 }




?>