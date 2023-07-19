<?php






$server="localhost";
$username="root";
$password="";
$dbname = "licence";
$conn=mysqli_connect($server,$username,$password,$dbname);
if(!$conn)
{
    die("connection failesd du to".mysqli_connect_error());


}

echo "success connecting to db";
$username=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * FROM users INNER JOIN platers ON users.username = platers.Name where username='$username' AND password='$password';";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

$res=$row["Name"];
echo "$res";
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="new.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php require 'partials/_nav.php' ?>
    <style>
        body {

            
            
            background-color: #212A3E;
        }

        .container
        {
            background-color: #394867;
            color: yellow;
        }

        .btn
        {
            background-color: green;
            color:#394867 ;
        }
        
    </style>

    <div class="container rounded  mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="text-black-50"></span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        
                       
                    </div>
                    <div class="row mt-3">
                        
                        

                        <form action="index.php" method="post">
                        <label class="labels">Name</label>
                        <?php echo"<div> <h4>$row[Name]</h4> </div>
                       ";?>

<form action="index.php" method="post">
                        <label class="labels">Balance</label>
                        <?php echo"<div> <h4>$row[Balance]</h4> </div>
                       ";?>

<form action="index.php" method="post">
                        <label class="labels">Vehicle Number</label>
                        <?php echo"<div> <h4>$row[Number]</h4> </div>
                       ";?>
                       

                       <form action="index.php" method="post">
                        <label class="labels">Email</label>
                        <?php echo"<div> <h4>$row[Email]</h4> </div>
                       ";?>
                            <!-- <div class="col-md-6"><label class="labels">Name</label><input type="text" name="Name"  id="Name" class="form-control"  value="" ></div>
                            <div class="col-md-6"><label class="labels">Amount</label><input type="text" name="Balance" id="Balance" class="form-control"  value="" ></div> -->
                        <!-- <div class="col-md-12"><label class="labels">Contact No.</label><input type="tel" class="form-control"  value="" ></div> -->
                        <!-- <div class="col-md-12"><label class="labels">Vehicle No.</label><input type="text" name="Number" id="Number" class="form-control"  value="" ></div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" name="Email"  id="Email" class="form-control" ></div> -->
                        <!-- <div class="col-md-12"><label class="labels">Date of Birth</label><input type="date" class="form-control"  value="" ></div> -->
                        <!-- <div class="col-md-12"><label class="labels">Age</label><input type="text" class="form-control"  value="" ></div> -->
                       
                        <!-- <div class="col-md-12"><label class="labels">Vehicle Model Name</label><input type="text" class="form-control"  value="" ></div> -->
                        <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" >Submit</button></div> -->
                        </form>
                        
                    </div>
                    <div class="row mt-3">
                        
                        <!-- <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control" value=""  ></div> -->
                        
                    </div>
                    
                </div>
            </div>
         
        </div>
      </div>
    
</body>
</html>




