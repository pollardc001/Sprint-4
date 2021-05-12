<html>
<head>
<title>Inventory Report</title>
<style>
	.myDiv {
  	text-align: center;
	}
	h1 {
		text-align: center;
		font-family: verdana;
	}
	table {
		border-collapse: collapse;
		width: 80%;
		color: #588c7e;
		font-family: monospace;
		font-size: 25px;
		text-align: left;
	}
	th {
		background-color: #588c7e;
		color: white;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	table.center {
  		margin-left: auto;
 		margin-right: auto;
	}
        .topright {
          position: absolute;
          top: 0px;
          right: 0px;
        }
</style>
</head>
<body style="background-color:powderblue">
<header>
         <h1>Inventory Report</h1>
</header>
<div class="topright">
    <form action="http://student01web.mssu.edu/home_page.php">
        <input type="image" src="BDLogo.png" width="200" height="200">
    </form>
</div>
<form action="inventoryreport_sql.php" method="POST">
     	<b>Add Item to Inventory:</b> 
	<p>Item: <input type="text" name="description" maxlength="255"></p>
	<p>Price: <input type="number" name="price"></p>
     	<p>Quantity: <input type="number" name="quantity"/></p>
	<p><input type="submit" name="Submit"/></p>
</form>
<?php
if(isset($_POST['Submit'])){ //Make sure the submit button has been pressed
   	require('.db.inc.php'); //Connect to database
   	$description = htmlspecialchars(trim($_POST['description'])); //Get form information
	$price = htmlspecialchars(trim($_POST['price']));
   	$quantity = htmlspecialchars(trim($_POST['quantity']));
   	$query = "INSERT INTO Inventory (price, quantity, description) VALUES (?, ?, ?)"; //Just SQL, with prepared syntax 
   	$stmt = $conn->prepare($query); //Prepared statement
   	$stmt->bind_param("sss", $price, $quantity, $description);
   	$stmt->execute();
   	if($stmt->affected_rows == 1){
      		echo 'Inventory Updated';
   	} else {
      		echo 'Error Occurred<br/>';
      		echo mysqli_error($conn);
  	}
   	require ('.db.inc.php');
   	$table = "SELECT price, quantity, description FROM Inventory";
   	$result = $conn->query($table);
   	$stmt->close();
  	$conn->close();
}
?>
<table class="center">
<tr>
	<th>InventoryId</th>
	<th>Description</th>
	<th>Price</th>
	<th>Quantity</th>
</tr>
<?php 
	require ('.db.inc.php'); 
	$sql = "SELECT * FROM Inventory"; //Or other SQL query
	$result = $conn->query($sql); //Send query to MySQL
	if ($result->num_rows > 0) { // If we actually get output
    	   // output data of each row
    	while ($row = $result->fetch_assoc()) { //Iterate on each row, until no more data
         echo "<tr><td>" . $row["inventoryId"]. "</td><td>" . $row["description"] . "</td><td>" . $row["price"] . "</td><td>". $row["quantity"]."</td></tr><br>";
           }
	} else {
           echo "0 results";
	}
	$conn->close();
?>
</table>
<div class="myDiv">
	<form action="http://student01web.mssu.edu/home_page.php">
        <input type="submit" value="Go Back"/>
        </form>
</div>
</table>
</body>
</html>