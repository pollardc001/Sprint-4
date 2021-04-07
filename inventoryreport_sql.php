<html>
<head>
<title>My Project Page</title>
</head>
<body>
   <?php 
	require ('.db.inc.php'); 

	$sql = "SELECT * FROM Customer"; //Or other SQL query
	$result = $conn->query($sql); //Send query to MySQL
	if ($result->num_rows > 0) { // If we actually get output
    	   // output data of each row
    	while ($row = $result->fetch_assoc()) { //Iterate on each row, until no more data
         echo "id: ". $row["customerId"]. " - Last Name: " . $row["lastName"]. "<br>";
           }
	} else {
           echo "0 results";
	}
	$conn->close();

?>

</body>
</html>