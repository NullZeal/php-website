function searchOrders(){
    
    var searchedDateTime = document.getElementById("dateTime").value;
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "orders.php");
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //submit
    //callback function
    xmlhttp.onreadystatechange = function () {
        
        console.log("pouet");
        
	if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            document.getElementById("ordersTable").innerHTML = xmlhttp.responseText;
	}
    };
    
    //alert("searchedDate=" + searchedDateTime);
    xmlhttp.send("searchedDate=" + searchedDateTime);
    
    //alert("I see what you are looking for : " + searchedPlayerString);
}