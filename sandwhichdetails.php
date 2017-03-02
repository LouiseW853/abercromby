<?php
header ('Access-Control-Allow-Origin: *');
 include "db.php";
 
 $table = "vending";
 $query = "SELECT * FROM $table where id = 5";
 $result = mysql_query($query);

echo "<table>";
while ($row_users = mysql_fetch_array($result))
{
    echo "<tr><td>".($row_users['name'])."<tr><td>";
    echo "<tr><td>".($row_users['description'])."<tr><td>";
      echo "<tr><td>£".($row_users['price'])."<tr><td>";
    echo "<br>";
    
} 
echo "</table>"; 

 ?>