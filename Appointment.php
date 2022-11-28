
<!-- this is the page for referrals -->

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
h1 {
  background-image: linear-gradient(to left, #ce2dc6, #0e067a);
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
  margin-bottom: 100px;
  text-align:center;
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

.employee:focus-within input {
  color: black;
}
button {
  display: inline-block;
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
.delete{
    text-align: center;
    margin-top: 750px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    object-fit: contain;
    position: absolute;
}

</style>

<html>
    <head>
        <title>
            Referrals
            </title>
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
        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="appointmentform.php" method="post">
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                    <label>Doctor ID:</label>
                    <span><input type="text" maxlength = "11" name="doctorid" required><br></span>
                </div>
                <div class="form">
                    <label>Receiving ID:</label>
                    <span><input type="text" maxlength = "11" name="ddoctorid" required><br></span>
                    <label>Clinic ID:</label>
                    <span><input type="text" maxlength = "11" name="clinicid" required><br></span>
                </div>
                <button class= "button button1" type="submit" value="Submit">Submit</button>
            </form>
        </div>
        
        <div class="delete">
            <h1>Delete a Patient's Information</h1>
            <form action="Appointment.php" method="post">
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                <button class= "button button1" type="submit" value="delete">Delete</button>
                </div>
            </form>
        </div>
    </body>
    
    
</html>
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
        
        $patientid = $_REQUEST["patientid"];
        
        $sql = "DELETE FROM referrals WHERE Patient=$patientid";
        
        if ($mysqli->query($sql) === TRUE) {
    echo "Record deleted successfully";     
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
            ?>
