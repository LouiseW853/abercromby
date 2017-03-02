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

//balance attempt
$q = "SELECT * from user_details";
$r = mysql_query($q);
$a = mysql_fetch_array($r);

//if statement as to wheter or not the product CAN be deducted

if($a['balance']>=$count) {

//uses the cost of the product to remove this from the balance available from the current users account
$query = "UPDATE user_details set balance = (balance - $count) where username LIKE '%$username%'";
$res = mysql_query($query);

//selects all rows from user details with username
$sql = "SELECT * FROM user_details where username LIKE '%$username%'";
$result = mysql_query($sql);
echo "<table>";
while ($row_users = mysql_fetch_array($result))
{
    echo "<tr><td>".($row_users['balance'])."<tr><td>";
    echo "<br>";
    
} 
echo "</table>";
echo "<br>";
echo "success";
}

else {
    echo "failed";
}

 ?>