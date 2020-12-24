
<!DOCTYPE html>
<html>
<body>

<?php
	
    if (!session_id()) 
   {
    session_start();

   }

	$user = 'root';
	$pass = '';
	$db = 'scorpix';
	
	$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
	echo 'done'."<br>";
	$opsw = $_POST['opsw'] ;
	$npsw = $_POST['npsw'] ;
	$cpsw = $_POST['cpsw'] ;

	if($npsw!=$cpsw)
	{
	header('Location: profile.php?error=confirm');
	}


		$username= $_SESSION['username']  ;

	$qry = " SELECT Password
			from user
			where User_name = '$username' ";

	$res = $db_connect->query($qry) ;
	$row = $res->fetch_assoc();
	echo $row['Password']  ;
	if($row['Password'] == $opsw)
	{


		$qry = " UPDATE user SET Password = '$npsw' where User_name = '$username' ";
		$food = $db_connect->query($qry) or die('bad query');

		header('Location: profile.php');


	}
	else
	{
			header('Location: profile.php?error=old');
				die();


	}
?>
</body>
</html>