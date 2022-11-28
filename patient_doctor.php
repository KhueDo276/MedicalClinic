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
  justify-content: center;
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
.employee > button {
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
    margin-bottom: 100px;
}
.delete{
    margin-top: 750px;
    height: 50vh;
  width: 100%;
  display: flex;
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
            Patient Registration
        </title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
        <div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>

<!--Patient form-->

        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="patient_doctor.php" method="post">
                <div class="form">
                    <label>First Name:</label>
                    <span><input type="text" maxlength = "20" name="firstname" required><br></span>
                    <label>Middle Initial:</label>
                    <span><input type="text" maxlength = "1" name="middlei"><br></span>
                    <label>Last Name:</label>
                    <span><input type="text" maxlength = "20" name="lastname" required><br></span>
                </div>
                <div class="form">
                    <label>Ethinicity:</label>
                    <span><input type="text" maxlength = "45" name="ethnicity" required><br></span>
                    <label>Sex:</label>
                    <select name="sex" id="sex">
                        <option value = "0">Male</option>
                        <option value = "1">Female</option>
                    </select>
                </div>
                <div class="form">
                    <label>DOB:</label>
                    <span><input type='date' name='date' required><br></span>
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
                <button class= "button button1" name="create" type="submit" value="Submit">Submit</button>
            </form>
        </div>
            <div class="delete">
                <h1>Delete a Patient's Information</h1>
                <form action="patient_doctor.php" method="post">
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                </div>
                <button class= "button button1" name="delete" type="submit" value="delete">Delete</button>
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
        if (isset($_POST['create'])){
            $firstname = $_POST["firstname"];
            $middlei = $_POST["middlei"];
            $lastname = $_POST["lastname"];
            $address = $_POST["address"];
            $dob = $_POST["date"];
            $weight = $_POST["weight"];
            $height = $_POST["height"];
            $phpn = $_POST["phpn"];
            $pha = $_POST["pha"];
            $insuranceid = $_POST["insid"];
            $insurancename = $_POST["insname"]; 
            $email = $_POST["email"];
            $ethnicity = $_POST["ethnicity"];
            $phonenumber = $_POST["phonenumber"];
            $ssn = $_POST["SSN"];
            $sex = $_POST["sex"];
            $sql = "INSERT INTO patient (First_Name,Middle_Initial,Last_Name,DOB,Last_4_SSN,Weight,Height,Sex,Ethnicity,Pharmacist_Phone,Pharmacist_Address,Insurance_ID,Insurance_Name,Phone_Number,Email,Address) VALUES ('$firstname','$middlei','$lastname','$dob','$ssn','$weight','$height','$sex','$ethnicity','$phpn','$pha','$insuranceid','$insurancename','$phonenumber','$email','$address')";

            if ($mysqli->query($sql) === TRUE) {
                echo "New record created successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        elseif ($_POST['delete']){
            $patientid = $_REQUEST["patientid"];
            
            $sql = "DELETE FROM patient WHERE Patient_ID=$patientid";
        
            if ($mysqli->query($sql) === TRUE) {
                echo "Record deleted successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
    ?>