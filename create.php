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
.button1 {
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
    <div class="employee">
    
    <?php 
    $ssn = $_POST["SSN"];
    echo "<form action='create.php' method='post'>
                <div class='form'>
                    <label>Password:</label>
                    <span><input type='text' maxlength = '20' name='password' required><br></span>
                    <button class='button1' name='createee' type='submit' value='Submit'>Submit</button>
                    <input type='hidden' value= '$ssn' name='ssn' />
                    </div>
                    </form> ";
                    
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
            if (isset($_POST["create"])){
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
            $password = $POST["password"];
            $sql = "INSERT INTO patient (First_Name,Middle_Initial,Last_Name,DOB,Last_4_SSN,Weight,Height,Sex,Ethnicity,Pharmacist_Phone,Pharmacist_Address,Insurance_ID,Insurance_Name,Phone_Number,Email,Address) VALUES ('$firstname','$middlei','$lastname','$dob','$ssn','$weight','$height','$sex','$ethnicity','$phpn','$pha','$insuranceid','$insurancename','$phonenumber','$email','$address')";
            if ($mysqli->query($sql) === TRUE) {
                echo "New record created successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            };
        if (isset($_POST['createee'])){
            $dicktom = $_POST["ssn"];
            $result = mysqli_query($mysqli,"SELECT Patient_ID FROM patient WHERE Last_4_SSN = '$dicktom'");
                    $list;
                    while($row = mysqli_fetch_assoc($result)) {
                        $list = $row["Patient_ID"];
                    }
             $pass = $_POST['password'];
             $sqli = "INSERT INTO login (username,password,role) VALUES ('$list','$pass','Patient')";
             if ($mysqli->query($sqli) === TRUE) {
                echo "New record created successfully";     
            } else {
                echo "Error: " . $sqli . "<br>" . $mysqli->error;
            }
         echo "Your Username is " . $list . "Your password is ". $pass;
         echo "<form action = 'index.php'>
         <input type=submit value = 'Log-In'></form>";
         
        }
    ?>
    </body>
</head>
