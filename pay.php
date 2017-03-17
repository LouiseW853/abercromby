<?php
header ('Access-Control-Allow-Origin: *');
include "db.php";

//if (isset($_POST['button'])) {
$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
$product = !empty($_POST['product']) ? trim($_POST['product']) : null;

//gets the cost of the product based on product name
$cost = "SELECT price from vending where name LIKE '%$product%'";
$prodcost = mysql_query($cost); //should hold cost
$count = mysql_result($prodcost, 0, 0); // just to show that its printing out the correct number

//Get the health points that the productt is worth
$hp = "SELECT points from vending where name LIKE '%$product%'";
$hpoints = mysql_query($hp);
$healthpoints = mysql_result($hpoints, 0, 0);


//balance attempt
$q = "SELECT * from user_details";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
//update balance when they have enough health points
$updatebalance = "UPDATE user_details set balance = (balance + 3.00) where username LIKE '%$username%'";

//if statement as to whether or not the product CAN be deducted
if($a['balance']>=$count) {
    
    $updatepoints = "UPDATE user_details set points = (points + $healthpoints) where username LIKE '%$username%'";
    $presult = mysql_query($updatepoints);
    
//update the payment in the users table
$query = "UPDATE user_details set balance = (balance - $count) where username LIKE '%$username%'";
$res = mysql_query($query);

//selects all rows from user details with username
$sql = "SELECT points FROM user_details where username LIKE '%$username%'";
$result = mysql_query($sql);
$rowusers = mysql_result($result, 0, 0);
if($rowusers > 10){
    $updatehealthpoints = "UPDATE user_details set points = points-10 where username LIKE '%$username%'";
    $hpresult = mysql_query($updatehealthpoints);
    $bresult = mysql_query($updatebalance);
}
else if($rowusers ==10){
    $balanceresult=mysql_query($updatebalance);
}
echo $rowusers;
//while ($row_users = mysql_fetch_array($result))
//{
//echo "<tr><td>".($row_users['points'])."<tr><td>";
//} 
}
else {
    echo "failed";
}
 ?>