<head> <title>Add Appointment</title> </head>
<body>
<form action="add_sql.php" method="POST">
     <b>Add a New Appointment</b>
     <p>CustomerId: <input type="text" name="customerId" size="30" value="" /> </p>
     <p>EmployeeId: <input type="text" name="employeeId" size="30" value="" /> </p>
     <p>Date: <input type="text" name="date" size="30" value="" /> </p>
<p><input type="submit" name="submit" value="Send" /> </p>
</form>

<?php
if(isset($_POST['submit'])){ //Make sure the submit button has been pressed
   require('.db.inc.php'); //Connect to database
   $c_Id = htmlspecialchars(trim($_POST['customerId']));
   $e_Id = htmlspecialchars(trim($_POST['employeeId'])); //Get form information
   $date = htmlspecialchars(trim($_POST['date']));
   $query = "INSERT INTO Appointment (customerId, employeeId, date) VALUES (?, ?, ?)"; //Just SQL, with prepared syntax 
   $stmt = $conn->prepare($query); //Prepared statement
   $stmt->bind_param("sss", $c_Id, $e_Id, $date);
   $stmt->execute();
   if($stmt->affected_rows == 1){
      echo 'Appointment Entered';
   } else {
      echo 'Error Occurred<br />';
      echo mysqli_error($conn);
   }
   $stmt->close();
   $conn->close();
}
?>

</body>
</html>