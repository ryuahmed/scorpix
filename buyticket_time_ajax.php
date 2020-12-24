

<?php
//Include the database configuration file
$user = 'root';
      $pass = '';
      $db = 'scorpix';

$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
    if(isset($_GET["hall"]))
{

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

}?>