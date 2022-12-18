//-------------------------------------------------------------------
//Revision History
//
//DEVELOPER                      DATE             COMMENTS
//Julien Pontbriand (2135020)    Dec. 12, 2022     File creation. Added the searchOrders function
//Julien Pontbriand (2135020)    Dec. 13, 2022     Added the deleteOrder function
//Julien Pontbriand (2135020)    Dec. 17, 2022     Style refactoring
//Julien Pontbriand (2135020)    Dec. 18, 2022     Style refactoring
//-------------------------------------------------------------------


function searchOrders() {
    var searchedDateTime = document.getElementById("dateTime").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "orders.php");
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.onreadystatechange = 
        function ()         {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("ordersTable").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.send("searchedDate=" + searchedDateTime);
}

function deleteOrder(orderId) {
    
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "orders.php");
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
	if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            document.getElementById("ordersTable").innerHTML = xmlhttp.responseText;
	}
    };
    xmlhttp.send("orderToDelete=" + orderId);
}