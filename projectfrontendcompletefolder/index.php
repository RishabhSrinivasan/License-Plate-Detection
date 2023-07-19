<?php

$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);
if(!$con)
{
    die("connection failesd du to".mysqli_connect_error());


}

echo "success connecting to db";

$output=shell_exec('python main.py');
echo "<pre>$output</pre>";

$Name=$_POST['Name'];
$Balance=$_POST['Balance'];
$Number=$_POST['Number'];
$Email=$_POST['Email'];
$sql="INSERT INTO `licence`.`platers` ( `Name`, `Balance`, `Number`, `Email`) VALUES ( '$Name', '$Balance', '$Number', '$Email');";

echo $sql;

if($con->query($sql) == true){
    // echo "Successfully inserted";

    // Flag for successful insertion
    $insert = true;
}
else{
    echo "ERROR: $sql <br> $con->error";
}

// Close the database connection
$con->close();


?>