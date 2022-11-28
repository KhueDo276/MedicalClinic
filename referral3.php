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
  margin-top: 20%;
}
input{
    align-items: center;
    display: block;
  width: 50%;
  padding: 15px 20px;
  background: white;
  border-radius: 3px;
  transition: 0.4s;
}
</style>
<html>
    <head>
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
        <body>
            <div id="nav-placeholder"></div>
        <script>
        $(function(){
        $("#nav-placeholder").load("navbar_patient.html");
        });
</script>
      
    <div class="content">
    <?php
    session_start();
                    $port = $_SERVER['WEBSITE_MYSQL_PORT'];
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
                    $clinic = $_POST["clinicid"];
                    $name = $_POST["doctor"];
                    $doctorresult = mysqli_query($mysqli,"SELECT Employee_ID FROM employees WHERE Last_Name = '$name'");
                    while($drow = mysqli_fetch_assoc($doctorresult)) {
                        $dlisw = $drow["Employee_ID"];
                    }
                    $mdayresult = mysqli_query($mysqli,"SELECT Monday FROM availability WHERE D_ID = '$dlisw'");
                    while($mrow = mysqli_fetch_assoc($mdayresult)) {
                        $monday = $mrow["Monday"];
                    };
                    $tdayresult = mysqli_query($mysqli,"SELECT Tuesday FROM availability WHERE D_ID = '$dlisw'");
                    while($trow = mysqli_fetch_assoc($tdayresult)) {
                        $tuesday = $trow["Tuesday"];
                    };
                    $wdayresult = mysqli_query($mysqli,"SELECT Wednesday FROM availability WHERE D_ID = '$dlisw'");
                    while($wrow = mysqli_fetch_assoc($wdayresult)) {
                        $wednesday = $wrow["Wednesday"];
                    };
                    $thdayresult = mysqli_query($mysqli,"SELECT Thursday FROM availability WHERE D_ID = '$dlisw'");
                    while($throw = mysqli_fetch_assoc($thdayresult)) {
                        $thursday = $throw["Thursday"];
                    };
                    $fdayresult = mysqli_query($mysqli,"SELECT Friday FROM availability WHERE D_ID = '$dlisw'");
                    while($frow = mysqli_fetch_assoc($fdayresult)) {
                        $friday = $frow["Friday"];
                    };
                    $dayworked = [];
                    if ($monday == $clinic)
                    {
                        $dayworked[] = "Monday";
                    }
                    if ($tuesday == $clinic)
                    {
                        $dayworked[] = "Tuesday";
            
                    }
                    if ($wednesday == $clinic)
                    {
                        $dayworked[] = "Wednesday";
                    }
                    if ($thursday == $clinic)
                    {
                        $dayworked[] = "Thursday";
                    }
                    if ($friday == $clinic)
                    {
                        $dayworked[] = "Friday";
                    }
                    echo "Dr. ". $name. " CAN ONLY WORK ON: "."<br>";
                    foreach($dayworked as $dtemp)
                    {echo $dtemp . "<br>";}
                    echo "<form action = 'referral4.php' method = 'POST'>";
                    echo "<label> Pick a Date:</label>";
                    echo "<input type='hidden' value= '$name' name='doctor' />";
                    echo "<input type='hidden' value= '$dlisw' name='namew' />";
                    echo "<input type='hidden' value= '$clinic' name='clinicidd'/>";
                    echo "<span><input type='date' name='date' required><br></span>";
                    echo "<button type='submit' name = 'Submit'>Submit</button>";
                    echo "</form>";
                    ?>
            </div>
             </body>
    </html>        
                    