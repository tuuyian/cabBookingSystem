<!--file data.php -->
<?php

	$servername = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "test";
	
	$conn = mysqli_connect($servername, $user, $password, $dbname);

    if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
$sql = "SHOW TABLES LIKE 'booking'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    echo $numRows;
    if ($numRows == 0) 
    {          
        $sql = "CREATE TABLE booking (
	            bookingNo VARCHAR(50) NOT NULL,
                customerName VARCHAR(50) NOT NULL,
                customerNumber INT(11) NOT NULL,
                customerEmail VARCHAR(50) NOT NULL,
                pickupAddress TEXT NOT NULL,
                destinationAddress TEXT NOT NULL,
                bookingDate DATE NOT NULL,
                bookingTime TIME NOT NULL,
                bookingStatus VARCHAR(50) NULL DEFAULT NULL,
	            PRIMARY KEY (bookingNo))";
				
        if (mysqli_query($conn, $sql)) 
        {
            
        }
        else
        {
            echo "<p>Error creating table: " . mysqli_error($conn) ."</p>";
        }
    }
	 $name = $_POST['name'];
	 $email = $_POST['email'];
     $number = $_POST['number'];
     $pickupAddress = $_POST['pickup'];
     $destinationAddress = $_POST['destination'];
	 $date = $_POST['date'];
     $time = $_POST['time'];
     $bookingNo = "CO" . rand(1000, 9999);
     $bookingStatus = "Unassigned";

	 $sql = "SELECT bookingNo FROM booking WHERE bookingNo = '$bookingNo'";
     $result = mysqli_query($conn, $sql);
	// get name and password passed from client
	$numRows = mysqli_num_rows($result);
	while($numRows >= 1)
    {
        $bookingNo = "CO" + rand(1000, 9999);
        $numRows = mysqli_num_rows($result);
    }

    if($numRows == 0)
    {   
        $sql =  "INSERT INTO booking VALUES ('$bookingNo', '$name', '$number', '$email', '$pickupAddress', '$destinationAddress', '$date', '$time', '$bookingStatus')";
                        if (mysqli_query($conn, $sql)) 
                        {
                            $time = date('h:i a', strtotime($time));                    
                        
                            echo "<p class = 'lead'>Your reference number is ". $bookingNo .". You will be picked up in front ". $pickupAddress ." at ". $time." on ". $date. ".</p><br><p class = 'lead'><a href = 'booking.html'>Return to Home Page</a></p>";
                        }
                        else
                        {
                             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
    }
	
    else
    {
	    echo "Data is invalid!<br><br>Please return to the <a href = 'booking.html'>home </a> page and try again!";
    }
?>
