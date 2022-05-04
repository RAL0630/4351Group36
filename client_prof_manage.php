<!DOCTYPE html>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address1 = $address2 = $city = $state = $zipcode = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check input errors before inserting in database
    // Prepare an insert statement
    $sql = "UPDATE users SET name = ?, address1= ?, address2= ?, city= ?, state= ?, zipcode= ? WHERE id=id;" ;
         
    if($stmt = mysqli_prepare($link, $sql)){
        
// Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_address1, $param_address2, $param_city, $param_state, $param_zipcode);
            
        // Set parameters
        $param_name = trim($_POST["name"]);;
		$param_address1 = trim($_POST["address1"]);;
		$param_address2 = trim($_POST["address2"]);;
		$param_city = trim($_POST["city"]);;
		$param_state = trim($_POST["state"]);;
		$param_zipcode = trim($_POST["zipcode"]);;
            
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
	<title> Profile Management </title>
</head>
<body>
	<center>
		<h1>Client Profile Management</h1> <br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="name">Full name:</label><br>
			<input type="text" id="name" name="name" value="" maxlength="50" required><br><br>
  
			<label for="address1">Address 1:</label><br>
			<input type="text" id="address1" name="address1" value="" maxlength="100" required><br><br>
  
			<label for="address2">Address 2:</label><br>
			<input type="text" id="address2" name="address2" value="" maxlength="100" ><br><br>
  
			<label for="city">City name:</label><br>
			<input type="text" id="city" name="city" value="" maxlength="100" required><br><br>
			
			<label for="state">State:</label><br>
			<select name="state" id="state" required>
				<option value=""> </option>
				<option value="AL">AL</option>
				<option value="AK">AK</option>
				<option value="AR">AR</option>	
				<option value="AZ">AZ</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>	
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>	
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>	
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>			
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="ND">ND</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VT">VT</option>
				<option value="VA">VA</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>	
				<option value="WV">WV</option>
				<option value="WY">WY</option>
			</select>
			<br><br>
  
			<label for="zipcode">Zipcode:</label><br>
			<input type="text" id="zipcode" name="zipcode" value="" minlength="5" maxlength="9" required><br><br>
			<input type="submit" value="Submit"> <a href="welcome.php" class="btn btn-warning">Home</a>
		</form>
	</center>
</body>
</html>