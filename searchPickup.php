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
    
    $time = date('H:i:s', strtotime("+2 hours"));

    $sql = "SELECT bookingNo, customerName, customerNumber, pickupAddress, destinationAddress, bookingDate, bookingTime FROM booking WHERE TIME(bookingTime) <= '$time' AND bookingStatus = 'Unassigned'";
    $result = mysqli_query($conn, $sql);
	// get name and password passed from client
	$numRows = mysqli_num_rows($result);
    
	if($numRows > 0)
    {
        while($data = mysqli_fetch_assoc($result)) 
        {
            
            $name = $data["customerName"];
            $number = $data["customerNumber"];
            $pickupAddress = $data['pickupAddress'];
            $destinationAddress = $data["destinationAddress"];
            $date = $data["bookingDate"];
            $time = date('h:i a', strtotime($data["bookingTime"]));
            $bookingNo = $data["bookingNo"];
            
            
            echo "<p class = 'lead'>Booking Number: ". $bookingNo ."<br>Customer Name: ". $name."<br>Customer Number: ". $number. "<br>Pick-up Address: ". $pickupAddress ."<br>Destination Address: ". $destinationAddress."<br>Pick-up Date: ". $date ."<br>Pick-up Time: ". $time ."<br></p>";
        }
        echo  "<br><p class = 'lead'><a href = 'booking.html'>Return to Home Page</a></p>";
    }
	
    else
    {
	    echo "No bookings were made!<br><br>Please return to the <a href = 'booking.html'>home </a> page and try again!";
    }
?>
