<?php
   if (!session_id()) 
      {session_start();}
  

    $user = 'root';
    $pass = '';
    $db = 'scorpix';

    $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

      $pid = $_GET["pid"] ;
      $vote =  $_GET["vote"] ;

      if(isset($_SESSION['username']))
      {
          $username = $_SESSION['username'];
          if($username=="")
          {        $username = "Guest"."-".date("Y")."-".date("m")."-".date("d")."-".date("h:i:sa");
          }
      }

      else
        $username = "Guest"."-".date("Y")."-".date("m")."-".date("d")."-".date("h:i:sa");

      $qry = "
        insert into poll_vote (pid,uid,op)
        VALUES ('$pid','$username','$vote')
        "; 
      $res = $db_connect->query($qry) or die('bad query');

      $qry = "
              SELECT COUNT(*) as vote ,pid,op
              FROM poll_vote
              GROUP by  op,pid
              HAVING pid = $pid
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
              where pid = $pid 
        ";
      $op = $db_connect->query($qry) or die('bad query');

                       


      while($op_data = $op->fetch_assoc())
          {
            for($x=0 ; $x<$numb ; $x++)
                {

                    if($op_data['p_option']==$option[$x])
                    {
                      $percent[$x]  = $data[$x]/$total ; 
                      $json[$op_data['p_option']] = $percent[$x]*100;
                      break ; 
                    }
                    else
                    {
                      $json[$op_data['p_option']] = 0;
                    }
                  
                }
          }



        

      echo json_encode($json);





?>

              