

<?php
//Include the database configuration file
$user = 'root';
      $pass = '';
      $db = 'scorpix';

$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
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

?>

              