<html>  
<head>
    <title>SIGN_IN </title>

<style>
    .button{border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
    }
    .button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
    }

    .button1:hover {
    background-color: #008CBA;
    color: white;
    }
body {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.App > input,
button {
  appearance: none;
  background: none;
  border: none;
  outline: none;
}

.App {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
}

.App > form {
  display: block;
  position: relative;
}
.App > form::after {
  content: "";
  display: block;
  position: absolute;
  top: -5px;
  left: -5px;
  right: -5px;
  bottom: -5px;
  z-index: 1;
  background-image: linear-gradient(to bottom right, rgb(67, 204, 54), red);
}
.form-inner {
  position: relative;
  display: block;
  background-color: #fff;
  padding: 30px;
  z-index: 2;
}
.form-inner h2 {
  color: rgb(245, 9, 9);
  font-size: 28px;
  font-weight: 500;
  margin-bottom: 30px;
}
.form-group {
  display: block;
  width: 300px;
  margin-bottom: 15px;
}
.form-group label {
  display: block;
  color: #666;
  font-size: 12px;
  margin-bottom: 5px;
  transition: 0.4s;
}
.form-group:focus-within label {
  color: red;
}

.form-group input {
  display: block;
  width: 100%;
  padding: 10px 15px;
  background-color: #f8f8f8;
  border-radius: 8px;
  transition: 0.4s;
}

.form-inner input:focus {
  box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.2);
}

.form-inner input[type="submit"] {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 8px;
  background-image: linear-gradient(to right, rgb(64, 190, 42), red);
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
}
.form-inner input[type="submit"]:hover {
  background-position: 100% 0%;
}

</style>
</head>     
<body>
    <div class="App">
        <form method = "post">
        <div class="form-inner">
            <h2> Medical Group 11 Login</h2>
            <div class="form-group">
                <label htmlFor="name">User Name:</label>
                <input type="text" name="username"><br>
            <div/>
            <div class="form-group">
                <label htmlFor="password">Password:</label>
                <input type="password" name="password"><br>
            </div>
            <input type="submit" name = "submit" value="LOGIN"><br>
        </div>
        </form>
    </div>
<!--    <h1 style="text-align:center;"> Medical Group 11<br>Sign_In Page</h1>-->
<!--<p1 style="text-align:center;">-->
<!--<form method = "post">-->
<!--username: <input type="text" name="username"><br>-->
<!--password: <input type="text" name="password"><br>-->




<!--report form-->

<a href="createaccount.php">Patient? Create Account</a>

<?php
session_start();   // session starts with the help of this function 


if(isset($_SESSION['use']))   // Checking whether the session is already there or not if 
// true then header redirect it to the home page directly 
 {
    header("Location:/doctorwelcome.php"); 
 }

if(isset($_POST["submit"]))   // it checks whether the user clicked login button or not 
{
$message = "";
$port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";


        $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
            }
    $isSuccess = 0;
    $userName = $_POST['username'];
    $sql = "SELECT * FROM login WHERE username = '$userName'";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('s', $userName);
    $statement->execute();
    $result = $statement->get_result();
    $password = $_POST["password"];
    while ($row = $result->fetch_assoc()) {
        if (! empty($row)) {
            $hashedPassword = $row["password"];
            $role = $row["role"];
            if ($password == $hashedPassword) {
                $isSuccess = 1;
            }
        }
    }
    
    if ($isSuccess == 0) {
        $message = "Invalid Username or Password!";
        echo $message;
        session_close();
    }
    if ($isSuccess ==1){
        
        if ($role == "Doctor")
        {
            $_SESSION['use']=$userName;

            echo '<script type="text/javascript"> window.open("doctorwelcome.php","_self");</script>';
        }
        if ($role == "Patient")
        {
            $_SESSION['patient']=$userName;

            echo '<script type="text/javascript"> window.open("password.php","_self");</script>';
        }
        if ($role == "Administrator")
        {
            $_SESSION['admin']=$userName;

            echo '<script type="text/javascript"> window.open("https://medicalgroup.azurewebsites.net/adminwelcome.php","_self");</script>';
        }
    }
        
}
?>
</body>
</html>