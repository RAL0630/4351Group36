<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Fuel Quote History</title>
</head>
<body>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login_test');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Check connection


$result = mysqli_query($link,"SELECT gallons_requested, delivery_address, delivery_date, price, total FROM fuel");

echo "<table border='10'>
<tr>
<th>Gallons Requested</th>
<th>Delivery Address</th>
<th>Delivery Date</th>
<th>Price</th>
<th>Total</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['gallons_requested'] . "</td>";
echo "<td>" . $row['delivery_address'] . "</td>";
echo "<td>" . $row['delivery_date'] . "</td>";
echo "<td>" . $row['price'] . "</td>";
echo "<td>" . $row['total'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($link);

?>

</body>
<a href="welcome.php" class="btn btn-warning">Home</a>
</html>