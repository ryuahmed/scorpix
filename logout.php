
<!DOCTYPE html>
<html>
<body>

<<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION["valid"] ) ;
   // destroy the session
session_destroy(); 
   header('Location:home_page.php');
?>
</body>
</html>