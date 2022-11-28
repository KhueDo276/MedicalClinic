<style>
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
    <head>
    </head>
        <body>
        <div class="navbar">
        <div class="navbar-container">
            <a class="navbar-logo" onclick="document.location='password.php'">MedicalGroup11</a>
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
        </body>
</html>

<?php
        $port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";
        
        //error when inputting date from the billing form on web app
        
        $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
            }
        
        $patientid = $_POST["patientid"];
        $prescriberid = $_POST["prescriberid"];
        $medicinename = $_POST["medicinename"];
        $amount = $_POST["amount"];
        $refillsleft = $_POST["refillsleft"];
        
        $sql = "INSERT INTO prescription (Patient_ID,Prescriber_ID,Medicine_Name, Amount, Refills_left) VALUES ('$patientid','$prescriberid','$medicinename', '$amount', '$refillsleft')";
        if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";     
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }   
            ?>