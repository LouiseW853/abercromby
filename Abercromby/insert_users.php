<?php
header ('Access-Control-Allow-Origin: *');
//register.php

/**
 * Include our MySQL connection.
 */

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

//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['insert'])){

    //Retrieve the field values from our registration form.
    $firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    

    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM user_details WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();

    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //If the provided username already exists - display error.
   if($row['num'] > 0){
	$message = "Username already exists";
	echo "<script type='text/javascript'>alert('$message');</script>";
    }
else{

    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    //Prepare our INSERT statement.
    $sql = "INSERT INTO user_details (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)";
    $stmt = $pdo->prepare($sql);

	if ($sql) {
	echo "success";
	}
	else {
	echo "failed";
	}

    //Bind our variables.
    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':lastname', $lastname);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    

    //Execute the statement and insert the new account.
    $result = $stmt->execute();

    //If the signup process is successful.
    if($result){
						session_start();

            $_SESSION['logged_in'] = "1";
            $_SESSION['logged_in_fname'] = $firstname;
            $_SESSION['logged_in_lname'] = $lastname;
            $_SESSION['logged_in_email'] = $email;

    }

            exit;
}
}

?>
