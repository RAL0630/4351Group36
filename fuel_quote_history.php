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
    // Attempt to connect to database FuelQuote
	

	$connection = new mysqli("localhost", "root", "", "FuelQuote");
	// check 
	if ($connection->connect_error){
		die("Connection failed: " . $connection->connect_error);
	} 
	
    //Initialize variables
    $userID = "";

    // WILL USE SESSIONS TO LOGIN 
	
	// work on this later
	$style = "color:red;";
    ?>
	<h1> Fuel Quote History </h1>

    <h2 <?php echo $style;?>> You are not logged in. <a href="index.html">Login now.</a></h2>

	<table>
		<tr>
			<th> Gallons Requested </th>
			<th> Delivery Address </th>
			<th> Delivery Date </th>
			<th> Suggested Price / gallon </th>
			<th> Total Amount </th>
		</tr>
		<tr>
			<td> 53 </td>
			<td> Apple Street
			New York, 12345 </td>
			<td> 11/21/2021 </td>
			<td> $2.56 </td>
			<td> $135.68 </td>
		</tr>
		<tr>
			<td> 53 </td>
			<td> Apple Street
			New York, 12345 </td>
			<td> 11/21/2021 </td>
			<td> $2.56 </td>
			<td> $135.68 </td>
		</tr>
		<tr>
			<td> 53 </td>
			<td> Apple Street
			New York, 12345 </td>
			<td> 11/21/2021 </td>
			<td> $2.56 </td>
			<td> $135.68 </td>
		</tr>
	</table>
</body>
</html>