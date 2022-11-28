<style>
    h1{
        text-align: center;
    }
</style>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>
        <div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_patient.html");
});
</script>
        <h1>Patient Prescriptions</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Prescribing Doctor</th>
                    <th>Medication Name</th>
                    <th>Amount</th>
                    <th>Refills</th>
                    <th>Pharmacist Phone</th>
                    <th>Pharmacist Address</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    //Get data from database
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   p.Patient_ID,
                                   CONCAT(e.First_Name,' ', e.Last_Name) AS 'Prescriber',
                                   pr.Medicine_Name,
                                   pr.Amount,
                                   pr.Refills_Left,
                                   p.Pharmacist_Phone,
                                   p.Pharmacist_Address
                            FROM prescription pr
                            JOIN patient p ON p.Patient_ID = pr.Patient_ID
                            JOIN employees e ON e.Employee_ID = pr.Prescriber_ID";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result) {
                        echo "Invalid query or no patient data available";
                    }
                    else {
                    while($row = $result->fetch_assoc()) {
                        if((int)$_SESSION['patient'] == $row["Patient_ID"]) {
                        echo "<tr>
                            <td>" . $row["Patient"] . "</td>
                            <td>" . $row["Prescriber"] . "</td>
                            <td>" . $row["Medicine_Name"] . "</td>
                            <td>" . $row["Amount"] . "</td>
                            <td>" . $row["Refills_Left"] . "</td>
                            <td>" . $row["Pharmacist_Phone"] . "</td>
                            <td>" . $row["Pharmacist_Address"] . "</td>
                        </tr>";
                        }
                    }
                    }
                ?>
            </tbody>

        </table>
        <button onclick="document.location='password.php'" formtarget="_blank">Back to home</button>
    </body>
</html>





