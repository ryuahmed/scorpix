<!DOCTYPE html>
 <html>
  <head>
  </head>
  <body>
  <?php
		if(!empty($_POST['check_list'])) {
		    foreach($_POST['check_list'] as $check) {
		            echo $check; //echoes the value set in the HTML form for each checked checkbox.
		                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
		                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
		    }
		}
		 $user = 'root';
            $pass = '';
            $db = 'scorpix';

            $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

            $qry = "SELECT value
					FROM poll
					WHERE 
					m_id = $check";

            $value = $db_connect->query($qry) ;

            $v = $value->fetch_assoc();
            echo $v['value'] ;
            $v['value']++ ; 

            echo $v['value'] ;
            $x = $v['value'] ;


            $q = "UPDATE poll SET value = $x WHERE m_id = $check;";
			$db_connect->query($q) ;
			if (!session_id()) 
   			{
    			session_start();
  			 }
  			$_SESSION['poll_vote_movie'] = true ; 
  			header('Location:home_page.php');

            
?>

  </body>
 </html>
