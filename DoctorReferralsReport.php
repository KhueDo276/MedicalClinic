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

<body>
    <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>
    
        <h1>Doctor Referrals</h1>
        <table class="table">
            <form method="post" action="">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Doctor Phone</th>
                    <th>Receiving Doctor</th>
                    <th>Receiving Doctor Phone</th>
                    <th>Clinic</th>
                    <th>Address</th>
                    <th>Clinic Phone</th>
                    <th>Approval</th>
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
                function getRefferals() {
                    //Get data from database
                    global $mysqli;
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   p.Patient_ID,
                                   CONCAT(eD.First_Name,' ', eD.Last_Name) AS 'Doctor',
                                   eD.Employee_ID AS 'd_id',
                                   ed.Phone_Number AS 'DoctorPhone',
                                   CONCAT(eR.First_Name,' ', eR.Last_Name) AS 'ReceivingDoctor',
                                   eR.Employee_ID AS 'rd_id',
                                   eR.Phone_Number AS 'ReceivingDoctorPhone',
                                   c.Name AS 'Clinic',
                                   c.Adress AS 'Address',
                                   c.Phone_Number AS 'ClinicPhone',  
                                   r.ref_id,
                                   r.Approval AS 'Approved'
                            FROM referrals r
                            JOIN clinics c ON c.Clinic_Id = r.Address_Id
                            JOIN employees eD ON eD.Employee_ID = r.Doctor
                            JOIN employees eR ON eR.Employee_ID = r.Receiving_Doctor
                            JOIN patient p ON p.Patient_ID = r.Patient";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result) {
                        echo "Invalid query or no patient information is available";
                    }
                    else {
                    while($row = $result->fetch_assoc()) {
                        if((int)$_SESSION['use'] == $row["d_id"] OR (int)$_SESSION['use'] == $row["rd_id"]){
                            if ($row["Approved"] == 0){
                             $refid = $row["ref_id"];
                        echo "<tr>
                            <td>" . $row["Patient"] . "</td>
                            <td>" . $row["Doctor"] . "</td>
                            <td>" . $row["DoctorPhone"] . "</td>
                            <td>" . $row["ReceivingDoctor"] . "</td>
                            <td>" . $row["ReceivingDoctorPhone"] . "</td>
                            <td>" . $row["Clinic"] . "</td>
                            <td>" . $row["Address"] . "</td>
                            <td>" . $row["ClinicPhone"] . "</td>
                            <td>" . Unapproved . "</td>
                            <td>
                            <button type='submit' name='refaccept' value='{$refid}' >Approve</button>
                            </td>
                        </tr>";
                            }
                        }
                    }
                    }
                }
                if (isset($_POST['refaccept']) && intval($_POST['refaccept'])) {
                     $referral = (int) $_POST['refaccept'];
                     $updatequery = "UPDATE referrals SET Approval=1 WHERE ref_id = ".$referral;
                     if ($mysqli->query($updatequery) === TRUE) {
                      echo "Referral accepted successfully";
                    } else {
                      echo "Error accepting referral: " . $mysqli->error;
                    }
                }
                getRefferals()
                ?>
            </tbody>
            </form>
        </table>
            <button onclick="document.location='doctorwelcome.php'" formtarget="_blank">Return</button>
    </body>
</html>