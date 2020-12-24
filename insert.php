
<!DOCTYPE html>
<html>
<body>

<?php
 session_start();
	$data = array($_POST['fname'],$_POST['lname'],$_POST['uname'],$_POST['email'],$_POST['pass'],$_POST['pno'],$_POST['bd']) ;

	$user = 'root';
	$pass = '';
	$db = 'scorpix';

	$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
	echo 'done'."<br>";

	$qry ="
				select User_name
				from user
				where User_name = '$data[2]'
	";

	$res = $db_connect->query($qry) or die('bad query');

    $n=$res->num_rows ; 
    if($n>=1)
    {    	header("Location: wrong_insert.php?name=u");

    }

	$qry = " insert into user (First_name,Last_name,User_name,Email,Password,Phone_no,Birth_date,position,dp)
				VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','user','default.png')" ;

	$res = $db_connect->query($qry) or die('bad query');

	$user = $data[2];
	$pass = $data[4] ;

	$qry = " SELECT Password
			from user
			where User_name = '$user' ";

	$res = $db_connect->query($qry) ;
	$row = $res->fetch_assoc();
	if($row['Password'] == $pass)
	{
		$_SESSION['valid'] = true;
  		$_SESSION['timeout'] = time();
   		$_SESSION['username'] =$user ;
		header('Location:home_page.php');
	}
?>
</body>
</html>