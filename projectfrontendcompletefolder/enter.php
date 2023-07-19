<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);
if(!$con)
{
    die("connection failesd du to".mysqli_connect_error());


}



$Name=$_POST['Name'];
$Balance=$_POST['Balance'];
$Number=$_POST['Number'];
$Email=$_POST['Email'];
$Age=$_POST['Age'];
$Model=$_POST['Model'];
$State=$_POST['State'];
$Contact=$_POST['Contact'];

if(isset($_POST['Name']) && isset($_POST['Balance']))
{
	$sql="INSERT INTO `licence`.`platers` ( `Name`, `Balance`, `Number`, `Email`,`Age`,`Model`,`State`,`Contact`) VALUES ( '$Name', '$Balance', '$Number', '$Email','$Age','$Model','$State','$Contact');";


if($con->query($sql) == true){
     echo "Successfully inserted";

    // Flag for successful insertion
    $insert = true;
}
else{
    echo "ERROR: $sql <br> $con->error";
}

}



// Close the database connection
$con->close();

}



?>





















<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
		header {
			background-color: #2a2929;
			color: #fff;
			display: flex;
			align-items: center;
			padding: 10px 20px;
		}
		header img {
			height: 50px;
			margin-right: 10px;
		}
		form {
			max-width: 500px;
			margin: 20px auto;
			padding: 20px;
			background-color: #f1f1f1;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
		}
		form label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		form input[type="text"], form input[type="tel"], form input[type="email"], form select {
			padding: 10px;
			border: none;
			border-radius: 5px;
			margin-bottom: 20px;
			width: 100%;
			font-size: 16px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		form input[type="date"] {
			padding: 10px;
			border: none;
			border-radius: 5px;
			margin-bottom: 20px;
			font-size: 16px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		form input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		form input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>

    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
	<header>
		<pre>                                                                          <img src="icon.png" alt="Account Profile Icon"></pre>
		<h1>Registration Form</h1>
	</header>
    <script>
        function calculateAge() {
          var today = new Date();
          var birthdate = new Date(document.getElementById("date").value);
          var age = today.getFullYear() - birthdate.getFullYear();
          var month = today.getMonth() - birthdate.getMonth();
          if (month < 0 || (month === 0 && today.getDate() < birthdate.getDate())) {
            age--;
          }
          document.getElementById("Age").value = age;
        }
      </script>
	<form action="/projectfrontendcompletefolder/enter.php" method="post">
		<label for="Name">Vehicle Owner Name:</label>
		<input type="text"  name="Name" id="Name"  placeholder="FIRST MIDDLE LAST" required>
		
		<label for="Balance">Amount:</label>
            <input type="text" id="Balance" name="Balance" value="₹2000" >
			<label for="Number">Vehicle No:*</label>
		<input type="text" id="Number" name="Number" required>
		<label for="Email">Email id: </label>
		<input type="text" id="Email" name="Email"  placeholder="abc123@gmail.com" required>
		<label for="date"> Date of Birth*</label></pre></h2>
        <input type="date" id="date" name="date" onchange="calculateAge()"></pre>
        <label for="age">Age:</label></pre></h2>
        <input type="text" id="Age" name="Age" ></pre>
                      
                    
          
		
		<label for="Model">Vehicle Model Name:</label>
		<input type="text" id="Model" name="Model" required>
		<label for="State">State:</label>
		<select id="State" name="State">
			<option value="Andra Pradesh" id="1">Andra Pradesh</option>
            <option value="Arunachal Pradesh" id="2">Arunachal Pradesh</option>
            <option value="Asssam" id="3">Asssam</option>
            <option value="Bihar" id="4">Bihar</option>
            <option value="Chattisgarh" id="5">Chattisgarh</option>
            <option value="Goa" id="6">Goa</option>
            <option value="Gujarat" id="7">Gujarat</option>
            <option value="Haryana" id="8">Haryana</option>
            <option value="Himachal Pradesh" id="9">Himachal Pradesh</option>
            <option value="Jharkhand" id="10">Jharkhand</option>
            <option value="Karnataka" id="11">Karnataka</option>
            <option value="Kerala" id="12">Kerala</option>
            <option value="Madhya Pradesh" id="13">Madhya Pradesh</option>
            <option value="Maharashtra" id="14">Maharashtra</option>
            <option value="Manipur" id="15">Manipur</option>
            <option value="Meghalaya" id="17">Meghalaya</option>
            <option value="Mizoram" id="18">Mizoram</option>
            <option value="Nagaland" id="19">Nagaland</option>
            <option value="Odisha" id="20">Odisha</option>
            <option value="Punjab" id="21">Punjab</option>
            <option value="Rajasthan" id="22">Rajasthan</option>
            <option value="Sikkim" id="23">Sikkim</option>
            <option value="Tamil Nadu" id="24">Tamil Nadu</option>
            <option value="Telangana" id="25">Telangana</option>
            <option value="Tripura" id="27">Tripura</option>
            <option value="Uttarakhand" id="28">Uttarakhand</option>
            <option value="Uttar Pradesh" id="28">Uttar Pradesh</option>
            <option value="West Bengal" id="29">West Bengal</option>

            </select>
			

			
		<label for="Contact">Contact No:</label>
		<input type="text" id="Contact" name="Contact" ></pre>


            <btn><input type="submit" value="Submit" "></btn>