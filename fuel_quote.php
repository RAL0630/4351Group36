<!DOCTYPE html>


<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$gallons_requested = $delivery_address = $delivery_date = $price = $total  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check input errors before inserting in database
    // Prepare an insert statement
    $sql = "INSERT INTO fuel (gallons_requested, delivery_address, delivery_date, price , total) VALUES (?,?,?,?,?) ";
         
    if($stmt = mysqli_prepare($link, $sql)){
        
// Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $param_gallons_requested, $param_delivery_address, $param_delivery_date, $param_price, $param_total);
            
        // Set parameters
        $param_gallons_requested = trim($_POST["gallons_requested"]);;
		$param_delivery_address = trim($_POST["delivery_address"]);;
		$param_delivery_date = trim($_POST["delivery_date"]);;
		$param_price = trim($_POST["price"]);;
		$param_total = trim($_POST["total"]);;
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to welcome page
            header("location: welcome.php");
        } else{
             echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<html lang="en">
<head>
	<title> Fuel Order Page </title>
</head>
<body>
	<center>
		<h1>Ordering Page</h1> <br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
			<label for="gallons_requested">Numbe of Gallons:</label><br>
			<input type="int" id="gallons_requested" name="gallons_requested" value="" maxlength="" required><br><br>
			
			<label for="delivery_address"> Delivery Address:</label><br>
			<input type="text" id="delivery_address" name="delivery_address" value="" maxlength="100" required><br><br>
  
			<label for="delivery_date">Delivery Date:</label><br>
			<input type="date" id="delivery_date" name="delivery_date" value="" maxlength="100" ><br><br>
  
			<label for="price">Price:</label><br>
			<input type="int" id="price" name="price" value="" maxlength="100" required><br><br>
			
			<label for="total">Total:</label><br>
			<input type="int" id="total" name="total" value="" maxlength="" required><br><br>
			<br><br>
  
			<input type="submit" value="Submit">
		</form>
	</center>
</body>
</html>