<!DOCTYPE html>
<html>
  
<head>
    <title>Confirmation</title>
</head>
  
<body>
    <center>
        <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => login
        $conn = mysqli_connect("localhost", "root", "", "login");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
          
        // Taking all 5 values from the form data(input)
        $username =  $_REQUEST['username'];
        $password = $_REQUEST['password'];
		
        
          
        // Performing insert query execution
        // here our table name is user_logins
        $sql = "INSERT INTO user_logins  VALUES ('$username', 
            '$password')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>Account Registration Complete" ; 
			
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
  
</html>