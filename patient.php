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
  /*margin-bottom: -100px;*/
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
/*input { */
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
            Patient Registration
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
<!--Patient form-->

        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="patientform.php" method="post">
                <div class="form">
                    <label>First Name:</label>
                    <span><input type="text" maxlength = "20" name="firstname" required><br></span>
                    <label>Middle Initial:</label>
                    <span><input type="text" maxlength = "1" name="middlei"><br></span>
                    <label>Last Name:</label>
                    <span><input type="text" maxlength = "20" name="lastname" required><br></span>
                </div>
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                    <label>Date of Birth:</label>
                    <span><input type="date" name="dob" required><br></span>
                    <label>Sex:</label>
                    <select name="sex" id="sex">
                        <option value = "0">Male</option>
                        <option value = "1">Female</option>
                    </select>
                    <!--<span><input type="text" maxlength = "1" name="sex" required><br></span>-->
                </div>
                <div class="form">
                    <label>Ethinicity:</label>
                    <span><input type="text" maxlength = "45" name="ethnicity" required><br></span>
                    <label>Weight:</label>
                    <span><input type="text" name="weight" required><br></span> 
                    <label>Height:</label>
                    <span><input type="text" maxlength = "6" name="height" required></span>
                </div>
                <div class="form">
                    <label>Address:</label>
                    <span><input type="text" maxlength = "45" name="address" required><br></span>
                    <label>Email:</label>
                    <span><input type="text" maxlength = "45" name="email"><br></span>
                    <label>Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phonenumber" required><br></span>
                </div>
                <div class="form">
                    <label>Last 4 SSN:</label>
                    <span><input type="text" maxlength = "4" name="SSN" required><br></span>
                    <label>Pharmacy Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phpn" required><br></span>
                </div>
                <div class="form">
                    <label>Pharmacy Address:</label>
                    <span><input type="text" maxlength = "45" name="pha" required><br></span>
                    <label>Insurance ID:</label>
                    <span><input type="text" maxlength = "11" name="insid"><br></span>
                    <label>Insurance Name: </label>
                    <span><input type="text" maxlength = "45" name="insname"><br></span>
                </div>
                <button class= "button button1" type="submit" value="Submit">Submit</button>
            </form>
        </div>

    </body>
    
    
</html>