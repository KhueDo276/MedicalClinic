<style>
    .employee {
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  object-fit: contain;
  position: absolute;
  top: 0;
}
.employee > h1 {
  background-image: linear-gradient(to left, #ce2dc6, #0e067a);
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
  margin-bottom: 100px;
}
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(8, auto);
  grid-gap: 11px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content: end;
  margin-right: 2rem;
  margin-bottom: 50px;
}
label {
  display: block;
  color: #0e067a;
  margin-bottom: 5px;
  transition: 0.4s;
  float: left;
  font-size: 18px;
}
.employee:focus-within label {
  color: #ce2dc6;
}
/*input select {*/
/*  display: block;*/
/*  width: 100%;*/
/*  padding: 15px 20px;*/
/*  background: white;*/
/*  border-radius: 8px;*/
/*  transition: 0.4s;*/
/*}*/
.employee:focus-within input {
  color: black;
}
button {
  /*display: inline-block;*/
  padding: 10px 15px;
  border-radius: 8px;
  background-image: linear-gradient(to right, #ce2dc6, #0e067a);
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
  font-size: large;
  margin-top: 100px;
}
/*navbar Link*/
.navbar {
  background-color: rgb(0, 4, 5);
  border-bottom-style: solid;
  border-bottom-color: #fff;
  height: 80px;
  display: flex;
  justify-content: center;
  font-size: 1.2rem;
  position: sticky;
  top: 0;
  z-index: 999;
}

.navbar-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80px;
  max-width: 1500px;
}

.navbar-logo {
  color: rgb(10, 248, 30);
  justify-self: start;
  margin-left: 20px;
  cursor: pointer;
  text-decoration: none;
  font-size: 2rem;
  font-family: Georgia, "Times New Roman", Times, serif;
  display: flex;
  align-items: center;
}

.nav-menu {
  display: grid;
  grid-template-columns: repeat(7, auto);
  grid-gap: 10px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content: end;
  margin-right: 2rem;
}

.nav-item {
  height: 80px;
}

.nav-links {
  font-family: Georgia, "Times New Roman", Times, serif;
  color: rgb(245, 6, 6);
  display: flex;
  align-items: center;
  text-decoration: none;
  padding: 0.1rem 0.5rem;
  height: 100%;
}

.nav-links:hover {
  border-bottom: 4px solid #fff;
  transition: all 0.2s ease-out;
}
</style>

<html>
<html>
<head> 
</head>
<body> 
<!--Navbar link-->
<div class="navbar">
        <div class="navbar-container">
            <a class="navbar-logo" onclick="document.location='password.php'">Medical Group 11</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <div class="nav-links" onclick="document.location='employeeregistration.php'">Employee</div>
                </li>
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='patient.php'">Patient Registration</a>
                </li>    
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='Appointment.php'">Referrals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='billing.php'">Billing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='prescription.php'">Prescriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='makeAppointment.php'">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-links" onclick="document.location='logout.php'">Log-out</a>
                </li>
            </ul>
        </div>
</div>

<div  class="employee">
    <h1>Employee Fill Out Form</h1>
        <form action="employeeform.php" method="post"> 
            <div class="form">
                <label>First Name:</label>
                <span><input type="text" maxlength="20" name="firstname" required><br></span> 
                <label>Middle Initial:</label>
                <span><input type="text" maxlength="1" name="middlei"><br></span>
                <label>Last Name:</label>
                <span><input type="text" maxlength="20" name="lastname" required><br></span>
            </div>
            <div class ="form">
                <label>Employee ID:</label>
                <span><input type="text" maxlength="11" name="employeeid"><br></span>
                <label>Salary:</label>
                <span><input type="text" maxlength="11" name="salary"><br></span>
                <label>Sex:</label>
                <select name="sex" id="sex">
                    <option value = "0">Male</option>
                    <option value = "1">Female</option>
                </select>
                <label>Enthinicity:</label>
                <span><input type="text" maxlength="45" name="ethnicity"><br></span>
            </div>
            <div class ="form">
                <label>Email:</label>
                <span><input type="text" maxlength="45" name="email"><br></span>
                <label>Phone Number:</label>
                <span><input type="text" maxlength="11" name="phonenumber"><br></span>
                <label>Job Type:</label>
                <select name="type" id="type">
                    <option value = "Doctor">Doctor</option>
                    <option value = "Nurse">Nurse</option>
                    <option value = "Other">Administrator</option>
                    <option value = "Other">Other</option>
                </select>
                <label>Last 4 SSN:</label>
                <span><input type="text" maxlength="4" name="SSN"><br></span>
            </div>
<!--
availibility attempt
-->

            <h1>Daily Clinic Schedule</h1>
        
            <!--<label>Monday:</label>
            <select name="Monday" id="Monday">
                <option selected="selected">Choose one</option>-->
                
                <?php
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
                    $result = mysqli_query($mysqli,"SELECT `Clinic_id` FROM `clinics`");
                    $list = [];
                    while($row = mysqli_fetch_assoc($result)) {
                        $list[] = $row;
                    }
                    //Monday pick
                    
                    //echo "<form action='employeeform.php' method='post'>";
                    echo "<p>";
                    echo "Monday:"; 
                    echo "<select name='Monday' id='Monday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Tuesday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Tuesday:";
                    echo "<select name='Tuesday' id='Tuesday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Wednesday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Wednesday:";
                    echo "<select name='Wednesday' id='Wednesday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Thursday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Thursday:";
                    echo "<select name='Thursday' id='Thursday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Friday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Friday:";
                    echo "<select name='Friday' id='Friday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    echo "</p>";
                ?>
                
            <button type="submit" value="Submit">Submit</button>
        </form>
</div>

</body>
</html>