<?php
 include "db.php";
 if(isset($_POST['insert']))
 {
 $fullname=$_POST['fullname'];
 $email=$_POST['email'];
 $password=$_POST['password'];
 $q=mysql_query("INSERT INTO `test` (`fullname`,`email`,`password`) VALUES ('$fullname','$email','$password')");
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
