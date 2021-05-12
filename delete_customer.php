<html>
<head>
<title>Delete Customer</title>
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
		<h1>Delete Customer</h1>
	</header>

	<div class="topright">
  		<form action="http://student01web.mssu.edu/home_page.php">
			<input type="image" src="BDLogo.png" width="200" height="200">
    		</form>
	</div>

	<table class="center">
	<tr>	
		<th>Customer ID</th>
     		<th>First Name</th>
     		<th>Last Name</th>
     		<th>Phone</th>
		<th>Address</th>
	</tr>
<form action="delete_customer.php" method="POST">
	<p>Enter Customer Id to Delete: <input type="text" name="customerId" /></p>
	<p><input type="submit" name="submit" value="Delete" /></p>
</form>
<?php 
	require ('.db.inc.php');
	$table = "SELECT * from Customer";
   	$result = $conn->query($table);
   	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["customerId"]. "</td><td>" . $row["firstName"]. "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td></tr><br>";
		}
	} else {
		echo "0  results";
	}
   	$conn->close();
?>
   <?php 
	if(isset($_POST['submit'])){
	require ('.db.inc.php');
	$c_id = htmlspecialchars(trim($_POST['customerId']));
	$query = "DELETE FROM Customer WHERE customerId = ?";
	$stmt = $conn->prepare($query); //Prepared statement
	$stmt->bind_param("s",$c_id);
   	$stmt->execute();
   	if($stmt->affected_rows == 1){
      		echo 'Customer Deleted'. "<br>" . "<br>";
   	} else {
      		echo 'Error Occurred<br />';
      		echo mysqli_error($conn);
   	}

	$table = "SELECT * from Customer";
   	$result = $conn->query($table);
   	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["customerId"]. "</td><td>" . $row["firstName"]. "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td></tr><br>";
		}
	} else {
		echo "0  results";
	}
	$stmt->close();
   	$conn->close();
	}
    ?>
</table>
</body>
</html>