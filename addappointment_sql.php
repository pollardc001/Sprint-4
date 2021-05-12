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
         <h1>Appointment</h1>
</header>

<div class="topright">
    <form action="http://student01web.mssu.edu/home_page.php">
        <input type="image" src="BDLogo.png" width="200" height="200">
    </form>
</div>

<form action="addappointment_sql.php" method="POST">
     <b>Add a New Appointment</b>
     <p>Add Customer: <input type="text" name="name" size="30" value="" required/> </p>
     <p>(YYYY-MM-DD)</p>
     <p>Date: <input type="text" name="date" size="30" value="" required/> </p>
     <p>(00:00:00)</p>
     <p>Time: <input type="text" name="time" size="30" value="" required/> </p>
<p><input type="submit" name="submit1" value="Send" /> </p>
</form>
<table class="center">
<tr>
    <th>Name</th>
    <th>Date</th>
    <th>Time</th>
</tr>
<?php
if(isset($_POST['submit1'])){ //Make sure the submit button has been pressed
   require('.db.inc.php'); //Connect to database
   
   $e_Id = htmlspecialchars(trim($_POST['name'])); //Get form information
   $date = htmlspecialchars(trim($_POST['date']));
   $time = htmlspecialchars(trim($_POST['time']));
   $query = "INSERT INTO Appointment (name, date, time) VALUES (?, ?, ?)"; //Just SQL, with prepared syntax 
   $stmt = $conn->prepare($query); //Prepared statement
   $stmt->bind_param("sss", $e_Id, $date, $time);
   $stmt->execute();
   if($stmt->affected_rows == 1){
      echo 'Appointment Entered';
   } else {
      echo 'Error Occurred<br />';
      echo mysqli_error($conn);
   }
   require ('.db.inc.php');
   $table = "SELECT name, date, time FROM Appointment";
   $result = $conn->query($table);
   if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["name"]. "</td><td>" . $row["date"] . "</td><td>" . $row["time"] . "</td></tr><br>";
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
