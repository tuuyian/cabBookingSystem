// file simpleajax.js
// using POST method
var xhr = createRequest();
function insertBooking(dataSource, aName, aEmail, aNumber, aPickup, aDestination, aDate, aTime) 
{
    if(xhr) 
    {  
        var obj = document.getElementById("displayInfo")
        var form = document.getElementById("form-container");
        var headerTitle = document.getElementById("landingHeader");
        var paraText = document.getElementById("landingParagraph");
        var requestbody ="name="+encodeURIComponent(aName)+"&email="+encodeURIComponent(aEmail)+"&number="+encodeURIComponent(aNumber)+"&pickup="+encodeURIComponent(aPickup)+"&destination="+encodeURIComponent(aDestination)+"&date="+encodeURIComponent(aDate)+"&time="+encodeURIComponent(aTime);
        xhr.open("POST", dataSource, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState == 4 && xhr.status == 200) 
            {
                headerTitle.innerHTML = "Booking Complete";
                paraText.innerHTML = "Thank you for booking with Cabs Online!<br><br>Please keep a copy of the information below"
                form.parentNode.removeChild(form);
                obj.innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
        
        xhr.send(requestbody);
     } // end if
} // end function insertBooking()


function searchPickup() 
{
    if(xhr) 
    {
        var obj = document.getElementById("searchedRequests");
        xhr.open("POST", 'searchPickup.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState == 4 && xhr.status == 200) 
            {
                
                obj.innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
        xhr.send(null);
     } // end if
} // end function getData()

function assignTaxi(dataSource, aBookingNumber) 
{
    if(xhr) 
    {  
        var obj = document.getElementById("searchedRequests");
        var requestbody ="bookingNumber="+encodeURIComponent(aBookingNumber);
        xhr.open("POST", dataSource, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState == 4 && xhr.status == 200) 
            {
                obj.innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
        
        xhr.send(requestbody);
     } // end if
} // end function insertBooking()
