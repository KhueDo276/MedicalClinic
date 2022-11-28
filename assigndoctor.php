<style>
 label{
        align-items: center;
        display: block;
        color: #0e067a;
        margin-bottom: 5px;
        transition: 0.4s;
        font-size: 50px;
    }
select{
    align-items: center;
    display: block;
  width: 50%;
  padding: 15px 20px;
  background: white;
  border-radius: 3px;
  transition: 0.4s;
}   
.content {
  max-width: 500px;
  margin: auto;
  margin-top: 5%;
}
.button1 {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 8px;
  background-color: blue;
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
  font-size: large;
}
table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
</style>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
    <!--Navbar link-->
    <div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_admin.html");
});
</script>
<div class="content">
            <?php
             session_start();
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
                    
                    $result = mysqli_query($mysqli,"SELECT DoctorID FROM doctors");
                    $list = [];
                    while($row = mysqli_fetch_assoc($result)) {
                        $list[] = $row;
                    }
                    
                    $dresult = mysqli_query($mysqli,"SELECT Patient_ID FROM patient");
                    $wlist = [];
                    while($drow = mysqli_fetch_assoc($dresult)) {
                        $wlist[] = $drow;
                    }
                    echo "<form action = 'assigndoctor.php' method='post'>";
                    echo "<h1>Assign Doctor for Patient </h1>";
                    echo "<label>Doctor<label>";
                    echo "<select name='doctor' >";
                    echo "<option value='' disabled selected>--select--</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[DoctorID] </option>";
                    }
                    echo "</select>";
                    echo "<label>Patient<label>";
                    echo "<select name='patient'>";
                    echo "<option value='' disabled selected>--select--</option>";
                    foreach($wlist as $dtemp) {
                        echo "<option> $dtemp[Patient_ID] </option>";
                    }
                    echo "</select>";
                    echo "<input class='button1' type = 'submit' name = 'submit'>";
                    echo "</form>";
                    if (isset($_POST["submit"]))
                    {
                        $patient = $_POST["patient"];
                        $doctor = $_POST["doctor"];
                        $sql = "INSERT INTO patientassigneddoctor(Doctor,Patient) VALUES('$doctor','$patient')";
                        if ($mysqli->query($sql) === TRUE) {
                        echo "New record created successfully";     
                        } else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                        }
                    }
                    
                
                    // SQL query to select data from database
$sql1 = " SELECT * FROM patientassigneddoctor ";
$result = $mysqli->query($sql1);
$mysqli->close();
?>
    <section>
        <h1>Assign Doctor Table</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th> Doctor ID</th>
                <th>Patient ID</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['Doctor'];?></td>
                <td><?php echo $rows['Patient'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</div>
</body>
</head>