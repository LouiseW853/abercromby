<?php
header ('Access-Control-Allow-Origin: *');
//login.php

/**
 * Start the session.
 */
session_start();

$host = 'devweb2015.cis.strath.ac.uk';
$user = 'trb13189';
$password = 'Poh3Faith5li';
$database = 'trb13189';

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

$pdo = new PDO(
    "mysql:host=$host;dbname=$database",
    $user,
    $password,
    $pdoOptions
);


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.

if(isset($_POST['login'])){

    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $pword = password_hash($passwordAttempt, PASSWORD_BCRYPT, array("cost" => 12));
    //Retrieve the user account information for the given username.
    $sql = "SELECT username, password, firstname, lastname, email FROM user_details WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();

    //Fetch row.

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
	 echo "failed";        
    } else{

        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        //If $validPassword is true, the login has been successful.

        if(password_verify($passwordAttempt,$user['password']) == true){

                echo "success";
            }
            else {
                echo "failed";
            }
        }
  }


?>
