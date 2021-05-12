<html>
<head>
<title>Delete Appointment</title>
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
<body>
	<header>
		<h1>Delete Appointment</h1>
	</header>

	<div class="topright">
  		<form action="http://student01web.mssu.edu/home_page.php">
			<input type="image" src="BDLogo.png" width="200" height="200">
    		</form>
	</div>

	<table class="center">
	<tr>	
		<th>Appointment ID</th>
     		<th>Customer</th>
     		<th>Date</th>
     		<th>Time</th>
	</tr>
<form action="delete_appointment.php" method="POST">
	<p>Enter Appointment Id to Delete: <input type="text" name="appointmentId" /></p>
	<p><input type="submit" name="submit" value="Delete" /></p>
</form>

<?php 
    require ('.db.inc.php');
    $table = "SELECT * from Appointment";
       $result = $conn->query($table);
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["appointmentId"]. "</td><td>" . $row["name"]. "</td><td>" . $row["date"] . "</td><td>" . $row["time"] . "</td></tr><br>";
        }
    } else {
        echo "0  results";
    }
       $conn->close();
?>

   <?php 
	if(isset($_POST['submit'])){
	require ('.db.inc.php');
	$a_id = htmlspecialchars(trim($_POST['appointmentId']));
	$query = "DELETE FROM Appointment WHERE appointmentId = ?";
	$stmt = $conn->prepare($query); //Prepared statement
	$stmt->bind_param("s",$a_id);
   	$stmt->execute();
   	if($stmt->affected_rows == 1){
      		echo 'Appointment Deleted'. "<br>" . "<br>";
   	} else {
      		echo 'Error Occurred<br />';
      		echo mysqli_error($conn);
   	}

	$table = "SELECT * from Appointment";
   	$result = $conn->query($table);
   	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["appointmentId"]. "</td><td>" . $row["customer"]. "</td><td>" . $row["date"] . "</td><td>" . $row["time"] . "</td></tr><br>";
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