<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Fuel Quote</title>
</head>
<body>
	<h1> Fuel Quote Form  </h1>
	<?php
        // validate user input here
        $gallons = $delivery_address = $date = $suggested = $total = "";
        $gallonsError = $dateError = "";

        // VALIDATE INPUT
        // Validate Gallons, and Date
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Make sure gallons contains a number, validation is done in the HTML code for the input
            // including min=1 and max=99999
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
                $test_date = explode('-',  test_input($_POST["fuel_quote_date"]));
                $current_date = explode('-', date("Y-m-d"));
                if (intval($test_date[0]) > intval($current_date[0])+10) {
                    $dateError = "Cannot exceed 10 years from now."; // MAX delivery date is 10 years
                } else {
                    $data = $test_date;
                }
            }
        }   
        
        // Hardcode Delivery Address, Suggested Price, and Total Price
        $delivery_address = "4401 Cougar Village Drive, Houston, Texas";
        $suggested = 3.43;
        $total = intval($gallons) * $suggested;

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }


	?>


	<form id="fuel_quote" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<ul id="fuel_quote_ul">
			<li class="list_item">
				<label for="fuel_quote_gallons">Gallons:</label>
				<input type="number" name="fuel_quote_gallons" id="fuel_quote_gallons" value="<?php echo $gallons;?>" min="1" max="99999">
                <span style="color:red" class="error">* <br></br><?php echo $gallonsError;?></span>
			</li>
			<li class="list_item">
				<label for="fuel_quote_date">Delivery date</label>
				<input type="date" name="fuel_quote_date" value="<?php echo $date;?>" id="fuel_quote_date" min="<?php echo date("Y-m-d");?>">
                <span style="color:red" class="error">* <br></br><?php echo $dateError;?></span>
			</li>
			<li class="list_item">
				<input type="submit" name="fuel_quote_button" id="fuel_quote_button"></input>
			</li>
			<li class="list_item">
				<label for="fuel_quote_address">Delivery Address:</label>
				<textarea readonly id="fuel_quote_address" name="fuel_quote_address"  value="<?php echo $delivery_address;?>"></textarea>
			</li>
			<li class="list_item">
				<label for="fuel_quote_suggested">Suggested Price:</label>
				<textarea readonly id="fuel_quote_suggested" name="fuel_quote_suggested" value="<?php echo $suggested;?>" ></textarea>
			</li>
			<li class="list_item">
				<label for="fuel_quote_total">Total Due:</label>
				<textarea readonly id="fuel_quote_total" name="fuel_quote_total" value="<?php echo $total;?>"></textarea>
			</li>
		</ul>
	</form>
</body>
</html>