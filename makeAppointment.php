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
    text-align: center;
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
/*input {*/
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
</style>


<html>
    <head>
        <title>
            Appointments
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
            <h1>Make an Appointment</h1>
            <form action="billingform.php" method="post">
                <div class='form'>
                    <label>Last Name:</label>
                    <span><input type="text" maxlength="20" name="name" required><br></span>
                    <label>Middle Initial:</label>
                    <span><input type="text" maxlength="1" name="name"><br></span>
                    <label>First Name:</label>
                    <span><input type="text" maxlength="20" name="name" required><br></span>
                             <!-- also could make this a drop down menu with the available addresses -->
                    <label>Doctor Name:</label>             <!-- maybe change this to a drop down menu with the doctor's names -->
                    <span><input type="text" name="name" required><br></span>
                    <label>Pick a Date:</label>
                    <span><input type="date" name="date" required><br></span>
                    <label>Pick a Time:</label>
                    <select name="time" id="time">
                        <option value="8:30">8:30 AM</option>
                        <option value="9:00">9:00 AM</option>
                        <option value="9:30">9:30 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="10:30">10:30 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="11:30">11:30 AM</option>
                        <option value="12:00">12:00 PM</option>
                    </select>
                    <label>Reason:</label>
                    <select name="reason" id="reason">
                        <option value="cough">Cough</option>
                        <option value="back pain">Back Pain</option>
                        <option value="abdominal symptoms">Abdominal Symptoms</option>
                        <option value="pharyngitis">Pharyngitis</option>
                        <option value="dermatitis">Dermatitis</option>
                        <option value="fever">Fever</option>
                        <option value="headache">Headache</option>
                        <option value="leg symptoms">Leg Symptoms</option>
                        <option value="respiratory concerns">Respiratory Concerns</option>
                        <option value="fatigue">Fatigue</option>
                        <option value="other">Other</option>
                    </select>
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
                    $result = mysqli_query($mysqli,"SELECT Adress FROM clinics");
                    $list = [];
                    while($row = mysqli_fetch_assoc($result)) {
                        $list[] = $row;
                    }
                    echo "<label>Clinic Location</label>";
                    echo "<select name='clinic'  onchange = 'this.form.submit()'>";
                    echo "<option value='' disabled selected>--select--</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Adress] </option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <button class= "button button1" type="submit" value="Submit">Submit</button>
            </form>
        </div>

</body>
    
    
</html>