<?php
 include "db.php";
 if(isset($_POST['insert']))
 {
 $firstname=$_POST['firstname'];
 $lastname=$_POST['lastname'];
 $username=$_POST['username'];
 $email=$_POST['email'];
 $password=$_POST['password'];
 
 $options = ['cost' => 11];
 $hash = password_hash($password, PASSWORD_BCRYPT, $options);
 
 $q=mysql_query("INSERT INTO `user_details` (`firstname`,`lastname`, `username`, `email`,`password`) VALUES ('$firstname','$lastname','$username','$email','$hash')");
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>

