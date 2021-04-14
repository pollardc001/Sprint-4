<html>
<head> 
<title>Add Appointment</title> 
<style>
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
</style>
</head>
<body>

<header>
         <h1>Appointment</h1>
</header>
<form action="addappointment_sql.php" method="POST">
     <b>Add a New Appointment</b>
     <p>Name: <input type="text" name="name" size="30" value="" /> </p>
     <p>(YYYY-MM-DD)</p>
     <p>Date Of Appointment: <input type="text" name="date" size="30" value="" /> </p>
<p><input type="submit" name="submit1" value="Send" /> </p>
</form>
<table class="center">
<tr>
    <th>Name</th>
    <th>Date</th>
</tr>
<?php
if(isset($_POST['submit1'])){ //Make sure the submit button has been pressed
   require('.db.inc.php'); //Connect to database
   $e_Id = htmlspecialchars(trim($_POST['name'])); //Get form information
   $date = htmlspecialchars(trim($_POST['date']));
   $query = "INSERT INTO Appointment (name, date) VALUES (?, ?)"; //Just SQL, with prepared syntax 
   $stmt = $conn->prepare($query); //Prepared statement
   $stmt->bind_param("ss", $e_Id, $date);
   $stmt->execute();
   if($stmt->affected_rows == 1){
      echo 'Appointment Entered';
   } else {
      echo 'Error Occurred<br />';
      echo mysqli_error($conn);
   }
   require ('.db.inc.php');
   $table = "SELECT name, date FROM Appointment";
   $result = $conn->query($table);
   if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["name"]. "</td><td>" . $row["date"] . "</td></tr><br>";
	}
	} else {
		echo "0 results";  
	}
   $stmt->close();
   $conn->close();
}
?>
</table>
</body>
</html>
