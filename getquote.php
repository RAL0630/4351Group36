<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
    $gallons_requested = floatval($_GET['g']);
    $delivery_date = strtotime(strval($_GET['d']));
    $delivery_address = strval($_GET['a']);
    $username = strval($_GET['u']);
    
    require_once 'config.php';
    
    // Calculate Pice
    $current_price = 1.5;
    $location_factor = 0.04;
    if (str_contains($delivery_address, "TX")) {
        $location_factor = 0.02;
    }
    $rate_history = 0.00; 
    $sql = "SELECT * FROM fuel";
    $result = $link->query($sql);
    if ($result->num_rows >0) {
        while($row = $result->fetch_assoc()) {
            if ($row['username'] == $username) {
                $rate_history = 0.01;
                break;
            }
        } 
    } 
    $link->close();

    $gallons_requested_factor = 0.03;
    if ($gallons_requested > 1000.0) {
        $gallons_requested_factor = 0.02;
    }
    $company_profit_factor = 0.1;
    $margin = $current_price * ($location_factor - $rate_history + $gallons_requested_factor + $company_profit_factor);

    $suggested_price = $current_price + $margin;
    $total = $suggested_price * $gallons_requested;
    

    //echo date('d/M/Y', $delivery_date) . "<br><br>";
    echo "$" . $suggested_price . "<br><br>";
    echo "<label>" . "Total Price:" . "</label><br>";
    echo $total . "<br><br>";
    //echo $username . "<br><br>";
    //mysqli_close($link);
?>
</body>
</html>