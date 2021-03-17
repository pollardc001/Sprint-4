<html>
<head> <title>Add Customer</title> </head>
<body>
<form action="add_sql.php" method="POST">
     <b>Add a New Customer</b>
     <p>First Name: <input type="text" name="fistName" size="30" value="" /> </p>
     <p>Last Name: <input type="text" name="lastName" size="30" value="" /> </p>
     <p>Phone Number: <input type="text" name="phoneNumber" size="30" value="" /> </p>
     <p>Address: <input type="text" name="address" size="30" value="" /> </p>
<p><input type="submit" name="submit" value="Send" /> </p>
</form>

<?php
if(isset($_POST['submit'])){ //Make sure the submit button has been pressed
   require('.db.inc.php'); //Connect to database
   $f_name = htmlspecialchars(trim($_POST['fistName']));
   $l_name = htmlspecialchars(trim($_POST['lastName'])); //Get form information
   $phone_num = htmlspecialchars(trim($_POST['phoneNumber']));
   $address = htmlspecialchars(trim($_POST['address']));
   $query = "INSERT INTO Customer (firstName, lastName, phoneNumber, address) VALUES (?, ?, ?, ?)"; //Just SQL, with prepared syntax 
   $stmt = $conn->prepare($query); //Prepared statement
   $stmt->bind_param("ssss", $f_name, $l_name, $phone_num, $address);
   $stmt->execute();
   if($stmt->affected_rows == 1){
      echo 'Customer Entered';
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
