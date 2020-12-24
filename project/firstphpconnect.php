
<!DOCTYPE html>
<html>
<body>

<?php
	$cname = $_POST['course_name'];
	echo $cname;

	$user = 'root';
	$pass = '';
	$db = 'University';
	
	$db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');
	echo 'done'."<br>";

	$qry = "select * from course where course_id like '%".$cname."%'";
	echo $qry." "."<br>";
	$res = $db_connect->query($qry) or die('bad query');
	echo $res->num_rows." "."<br>";

	while($row = $res->fetch_assoc()) {
        echo $row["course_id"]. " ";
		echo $row["title"]."<br>";
    }
?>
</body>
</html>