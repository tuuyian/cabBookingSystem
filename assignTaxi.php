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

    $bookingNumber = $_POST['bookingNumber'];

    $sql = "Select bookingStatus FROM booking WHERE bookingNo = '$bookingNumber'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows == 1)
    {
        $sql = "Select bookingStatus FROM booking WHERE bookingNo = '$bookingNumber' AND bookingStatus = 'Unassigned'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1)
        {
            $sql ="UPDATE booking SET bookingStatus ='Assigned' WHERE bookingNo = '$bookingNumber'";
            $result = mysqli_query($conn, $sql);
            echo "<p class = 'lead'>Booking Number ".$bookingNumber . " was assigned a taxi! </p>";
            echo  "<br><p class = 'lead'><a href = 'booking.html'>Return to Home Page</a></p>";
        }
           
        else
        {
            echo "<p class = 'lead'>Booking Number already assigned to a taxi!<br><br>Please return to the <a href = 'booking.html'>home </a> page and try again!</p>";
        }    

    }
    
    else
    {
         echo "<p class = 'lead'>No Booking Number found!<br><br>Please return to the <a   href = 'booking.html'>home </a> page and try again!</p>";
    }
    
    


    