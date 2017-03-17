<?php
header ('Access-Control-Allow-Origin: *');
include "db.php";

$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
$topup = !empty($_POST['topup']) ? trim($_POST['topup']) : null;

$query = "UPDATE user_details set balance = balance + $topup where username LIKE '%$username%'";
$res = mysql_query($query);
$sql = "SELECT * FROM user_details where username LIKE '%$username%'";
$result = mysql_query($sql);
echo "<table>";
while ($row_users = mysql_fetch_array($result))
{
    echo "Your Balance is ".($row_users['balance']);
    echo "<br>";
    
} 
echo "</table>"; 

 ?>