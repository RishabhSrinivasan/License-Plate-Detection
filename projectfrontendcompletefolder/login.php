<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     
    $sql = "Select * from users where username='$username' AND password='$password'";

    // $sql="SELECT *
    // FROM users
    // INNER JOIN platers
    // ON 
    // users.username = platers.Name
    // WHERE
    // username='$username'
    // AND
    // password='$password'
    
    // ";




    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>








<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in</title>
    <style>
      body {
       
        background-image: url(img.jpeg);
         background-repeat: no-repeat;
         background-size: cover;
        
       /* background-position: center;*/
        
      }
      #myVideo{
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
      }
      
      #one{
        position: fixed;
        right: 0;
        bottom: 0;
        width: 100%; 
        min-height: 100%;
        z-index:-1;
      }
      .login{
        display: block;
        /* border: 3px solid black; */
        box-shadow: 5px 5px 40px black;
        /* <video id="one" autoplay loop muted>
        <source src="video.mp4" type="video/mp4"></source>
        </video> */
        position: relative;
        top: 160px;
        /* background: transparent; */
        bottom: 10px;
        width: 35%;
        height: 40%;
        height: 400px;
        /* margin-right: 10%; */
        backdrop-filter: blur(10px);
        background-color: rgba(0, 0, 0, 0.23);
        align-items: center;
        /* border shadow: 50px; */
        margin: auto auto;
        border-radius: 22px;

      }
      .login input,button{
        display: block;
        margin: 32px auto;
        text-decoration: none;
        width: 70%;
        padding: 5px;
        border: 10px;
        align: center;
        border-radius: 7px;
        padding: 8px;
        font-size: large;
        opacity: 40%;
      }
      .login a{
        text-decoration: none;
        color: navy;
      }
      .login h1{
        text-align: center;
        color: yellow;
        
      }
      .login input:hover,button:hover{
        opacity: 100%;
        
        color: black;
        font-weight: bold;
      }
      .login button{
        cursor: pointer;
        background-color: rgb(161, 230, 57);
        
      }
      .login button{
        width: 33%;
        border: 4px solid black;
        font-weight: 200;
      }
      #join{
        padding: 3px;
        margin: 2px auto;
      }
      .login p{
        text-align: center;
        color: springgreen;
        text-decoration-line: overline;
      }
    </style>
  </head>
  <body>
  
  <?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
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
    <video autoplay muted loop id="myVideo"><source src="bi.mp4" type="video/mp4"></video>
    <main>
     
      <div class="login">
       
        <h1>LOG IN</h1>
        <form action="/projectfrontendcompletefolder/find.php" method="post">
        <div >
            <h1 for="username">Username</h1>
            <input type="text"  id="username" name="username" aria-describedby="emailHelp">
            
        </div>
        <div >
            <h1 for="password">Password</h1>
            <input type="password"  id="password" name="password">
        </div>
       
         
        <button type="submit" class="btn btn-primary">Login</button>
     </form>
     <p>Not member yet click below</p>
          <button id="join"><a href="http://127.0.0.1:5500/DS2loginpage.html">Create account</a></button>

      </div>
      
    </main>
   
  </body>
</html>