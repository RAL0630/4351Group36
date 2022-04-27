<!DOCTYPE html>
<?php
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $gallons_requested = $delivery_address = $delivery_date = $price = $total = $username = "";

    // Check if user is logged in
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // Check user info for delivery address.
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users";
        $result = $link->query($sql);
        if ($result->num_rows >0) {
            while($row = $result->fetch_assoc()) {
                if ($row['username'] == $username) {
                    $delivery_address = $row['address1'] . "\r\n" . $row['state'] . ", " . $row['zipcode'];
                    break;
                }
            } 
        }
    } else {
        header("location: login.php");
        exit;
    } 

    // Test Input Function
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check input errors before inserting in database
        if (empty($_POST["fuel_quote_gallons"])) {
            $gallonsError = "Gallons is a required input field";
        } else {
            $gallons = test_input($_POST["fuel_quote_gallons"]);
        }
        if (empty($_POST["fuel_quote_date"])) {
            $dateError = "Date is a required input field";
        } else {
            // Date does was input, now this code validates the date.
            //      Minimum is already set iin the property tags
            //      So only thing to do here is to check its not too far ahead (10 years)
            $test_date = explode('-', test_input($_POST["fuel_quote_date"]));
            $current_date = explode('-', date("Y-m-d"));
            if (intval($test_date[0]) > intval($current_date[0])+10) {
                $dateError = "Cannot exceed 10 years from now."; // MAX delivery date is 10 years
            } else {
                $data = $test_date;
            }
        }

        // Prepare an insert statement
        $sql = "INSERT INTO fuel (gallons_requested, delivery_address, delivery_date, price , total) VALUES (?,?,?,?,?) ";

        if ($stmt = mysqli_prepare($link, $sql)) {

        // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_gallons_requested, $param_delivery_address, $param_delivery_date, $param_price, $param_total);

            // Set parameters
            $param_gallons_requested = trim($_POST["gallons_requested"]);
            $param_delivery_address = trim($_POST["delivery_address"]);
            $param_delivery_date = trim($_POST["delivery_date"]);
            $param_price = trim($_POST["price"]);
            $param_total = trim($_POST["total"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to welcome page
                header("location: welcome.php");
            } else {
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
    <script>
        // Partial form submission using AJAX
        function showData() {
            var G = document.getElementById('gallons_requested');
            var D = document.getElementById('delivery_date');
            var A = document.getElementById('delivery_address');
            var U = "<?php echo $username; ?>";
            if (G.value == ""){
                alert("Gallons input is empty");
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('price').innerHTML = this.responseText;
                        document.getElementById('totalId').style.display = "none";
                    }
                };
                xmlhttp.open("GET", "getquote.php?g="+G.value+"&d="+D.value+"&a="+A.value+"&u="+U, true);
                xmlhttp.send();
            }
            
        }
    </script>
    <style>
        body {
        background-color: #121212;
        color: #FFFFFF;
        }
    </style>
</head>
<body>
	<center>
		<h1>Ordering Page</h1> <br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
			<label for="gallons_requested">Gallons:</label><br>
			<input type="number" id="gallons_requested" name="gallons_requested" value="<?php echo $gallons_requested;?>" maxlength="" required><br><br>
			
            <label for="delivery_date">Delivery Date:</label><br>
			<input type="date" id="delivery_date" name="delivery_date" value="" maxlength="100" required onchange="showData()"><br><br>


            <label for="delivery_address">Delivery Address:</label><br>
			<textarea type="text" id="delivery_address" name="delivery_address" readonly><?php echo $delivery_address;?></textarea><br><br>
  
			<label for="price">Suggested Price:</label><br>
			<span id="price" name="price" value="" readonly></span><br><br>
			
			<label for="total" id="totalId">Total Price:</label><br>
			<br><br>
  
			<input type="submit" value="Submit">
		</form>
	</center>
</body>
</html>