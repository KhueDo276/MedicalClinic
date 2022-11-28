<style>
    h1{
        text-align: center;
    }
</style>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body >
            <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>
        <h1>Doctor Appointments</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Clinic</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $port = $_SERVER
                    ['WEBSITE_MYSQL_PORT'];
                    $servername = "localhost:$port";
                    $username = "azure";
                    $password = "6#vWHD_$";
                    $db = "localdb";
                    
                    session_start();
                    $mysqli = new mysqli($servername,$username,$password,$db);
                    // Create connection
                    // Check connection
                    if ($mysqli->connect_error) {
                      die("Connection failed: " . $mysqli->connect_error);
                    }
                    
                    //Get data from database
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   p.Patient_ID,
	                               CONCAT(e.First_Name,' ',e.Last_Name) AS 'Doctor',
	                               e.Employee_ID,
	                               c.Name AS 'Clinic',
                                   c.Adress,
                                   c.Phone_Number,
                                   a.DATE,
                                   a.Reason,
                                   a.Time
                            FROM patient p
                            JOIN appointment a ON p.Patient_ID = a.patient_id
                            JOIN employees e ON a.Doctor = e.Employee_ID
                            JOIN clinics c ON c.Clinic_Id = a.Clinic_ID";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result){
                        echo "Invalid query or no patient information is available";
                        
                    }
                    else{
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['use'] == $row["Employee_ID"]){
                        echo "<tr>
                            <td>" . $row["Patient"] . "</td>
                            <td>" . $row["Doctor"] . "</td>
                            <td>" . $row["Clinic"] . "</td>
                            <td>" . $row["Adress"] . "</td>
                            <td>" . $row["Phone_Number"] . "</td>
                            <td>" . $row["DATE"] . "</td>
                            <td>" . $row["Time"] . "</td>
                            <td>" . $row["Reason"] . "</td>
                        </tr>";
                        }
                    }
                    }
                    
                ?>
            </tbody>

        </table>

            <button onclick="document.location='doctorwelcome.php'" formtarget="_blank">Back to home</button>
    </body>
</html>