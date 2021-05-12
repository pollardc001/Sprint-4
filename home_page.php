<html>
<head>
<title>Vet Database</title>
<style>
	.myDiv {
  		text-align: center;
	}
	div{
		background-image: url('DBLogo.png');
	}
</style>
</head>
<body style="background-color:powderblue">
<div class="myDiv">
	<header>
        	<h1>Home Page</h1>
	</header>

	<form action="http://student01web.mssu.edu/add_customer.php" >
          <input type="submit" value="Add Customer" />
        </form>

	<form action="http://student01web.mssu.edu/delete_customer.php" >
          <input type="submit" value="Delete Customer" />
        </form>

        <form action="http://student01web.mssu.edu/addappointment_sql.php" >
          <input type="submit" value="Add Appointment" />
        </form>

	<form action="http://student01web.mssu.edu/delete_appointment.php" >
          <input type="submit" value="Delete Appointment" />
        </form>

	<form action="http://student01web.mssu.edu/inventoryreport_sql.php" >
          <input type="submit" value="Inventory Report" />
        </form>

</div>

</body>
</html>