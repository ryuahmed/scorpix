
<!DOCTYPE html>
<html>
<body>

<?php
	
	 session_start();

	$user = 'root';
	$pass = '';
	$db = 'scorpix';
	
	$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
	echo 'done'."<br>";
	$user = $_POST['uname'] ;
	$pass = $_POST['psw'] ;
	

	$qry = " SELECT Password
			from user
			where User_name = '$user' ";

	$res = $db_connect->query($qry) ;
	$row = $res->fetch_assoc();
	echo $row['Password']  ;

	if($row['Password'] == $pass)
	{
		$_SESSION['valid'] = true;
		$_SESSION['username'] = $user ;
  		$_SESSION['timeout'] = time();
		header('Location: home_page.php');
	}
	else
	{
		header('Location: wrong_pass.php');

	}
?>
</body>
</html>