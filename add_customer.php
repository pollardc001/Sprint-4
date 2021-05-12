<html>
<head> 
<title>Add Customer</title>
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
<header>
         <h1>Customers</h1>
</header>

<div class="topright">
    <form action="http://student01web.mssu.edu/home_page.php">
        <input type="image" src="BDLogo.png" width="200" height="200">
    </form>
</div>

<form action="add_customer.php" method="POST">
     <b>Add a New Customer</b>
     <p>First Name: <input type="text" name="fistName" pattern="[A-Za-z]{1,100}" oninvalid="setCustomValidity('Enter alphabetical letters only. Max Length 100')" size="30" value="" /> </p>
     <p>Last Name: <input type="text" name="lastName" pattern="[A-Za-z]{1,100}" oninvalid="setCustomValidity('Enter alphabetical letters only. Max Length 100')" size="30" value="" /> </p>
     <p>Phone Number: <input type="text" name="phoneNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninvalid="setCustomValidity('Enter in form or ###-###-####.')" size="30" value="" /> </p>
     <p>Address: <input type="text" name="address" maxlength="150" size="30" value="" /> </p>
     <p><input type="submit" name="submit" value="Send" /> </p>
</form>

<table class="center">
<tr>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Phone</th>
     <th>Address</th>
</tr>

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
      echo 'Customer Entered'. "<br>" . "<br>";
   } else {
      echo 'Error Occurred<br />';
      echo mysqli_error($conn);
   }

   $table = "SELECT customerId, firstName, lastName, phoneNumber, address from Customer";
   $result = $conn->query($table);
   if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["firstName"]. "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td></tr><br>";
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
