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
	//Initialize variables
    $userID = "1"; 
	$style = "style='display:hidden;'";
	// Check if user is logged in
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		// logged in 
		$userID = $_SESSION['username'];
	} else {
		$style = "style='background-color:red;'";
	}
	
    // WILL USE SESSIONS TO LOGIN 
	
    ?>
	<h1> Fuel Quote History </h1>

    <h2 <?php echo $style;?>> You are not logged in. <a href="index.html">Login now.</a></h2>

	<?php

    // Attempt to connect to database FuelQuote
	$connection = new mysqli("localhost", "root", "", "FuelQuote");

	// check  connection 
	if ($connection->connect_error){
		die("Connection failed: " . $connection->connect_error);
	} 
	
	$sql = "SELECT UserID, Gallons, DeliveryAddress, DeliveryDate, SuggestedPrice, Total FROM FuelQuoteTable";
	$result = $connection->query($sql);

	echo "
	<table>
		<tr>
			<th> Gallons Requested </th>
			<th> Delivery Address </th>
			<th> Delivery Date </th>
			<th> Suggested Price / gallon </th>
			<th> Total Amount </th>
		</tr>";

	// Go through all rows in table
	if ($result->num_rows > 0) {
		// output all rows
		while ($row = $result->fetch_assoc()) {
			if ($row['UserID'] == $userID) {
				echo "<tr>";
				echo "<td>" . $row['Gallons'] . "</td>";
				echo "<td>" . $row['DeliveryAddress'] . "</td>";
				echo "<td>" . $row['DeliveryDate'] . "</td>";
				echo "<td>" . $row['SuggestedPrice'] . "</td>";
				echo "<td>" . $row['Total'] . "</td>";
			}
		}
	} else {
		echo "NOT LOGGED IN";
	}

	?>

</body>
</html>