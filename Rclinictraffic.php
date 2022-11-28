   <style>
   .employee{
       text-align:center;
   }
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(6, auto);
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
  /*float: left;*/
  font-size: 18px;
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
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    </head>
<body>
    <!--Navbar link-->
     <div id="nav-placeholder"></div>
    <script>
    $(function(){
    $("#nav-placeholder").load("navbar_admin.html");
});
</script>

                                    <!--Filtering begins here -->
<div class="employee">
        <h2>Data Filtering</h2>
        <form action="Rclinictraffic.php" method="post">
            <div class='form'>
                <label>Clinic:</label>
                <select name="clinic[]" multiple>
                    <?php 
                    session_start();
                    $port = $_SERVER
                    ['WEBSITE_MYSQL_PORT'];
                    $servername = "localhost:$port";
                    $username = "azure";
                    $password = "6#vWHD_$";
                    $db = "localdb";
                    
                    $mysqli = new mysqli($servername,$username,$password,$db);
                        if ($mysqli->connect_error) {die("Connection failed: " . $mysqli->connect_error);}
                    $sql = "SELECT Name, Clinic_Id FROM clinics";
                    $result = $mysqli->query($sql);
                    echo '<option value= "n/a">All</option>';
                    while ($row = $result->fetch_assoc()){
                    echo '<option value= "'. $row['Clinic_Id'] .'">' . $row['Name'] . '</option>';
                    }
                    ?>
                </select>
                <label>Doctor(s):</label>
                <select name="doctor[]" multiple>
                    <?php 
                    session_start();
                    $port = $_SERVER
                    ['WEBSITE_MYSQL_PORT'];
                    $servername = "localhost:$port";
                    $username = "azure";
                    $password = "6#vWHD_$";
                    $db = "localdb";
                    
                    $mysqli = new mysqli($servername,$username,$password,$db);
                        if ($mysqli->connect_error) {die("Connection failed: " . $mysqli->connect_error);}
                    $sql = "SELECT CONCAT(e.First_Name, ' ', e.Last_Name) AS name, e.Employee_ID AS emp_id FROM employees e WHERE e.Type = 'Doctor'";
                    $result = $mysqli->query($sql);
                    echo '<option value= "n/a">All</option>';
                    while ($row = $result->fetch_assoc()){
                    echo '<option value= "'. $row['emp_id'] .'">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
                <label>From Date:</label>
                <span><input type="date" name="fromdate" ><br></span>
                <label>To Date:</label>
                <span><input type="date" name="todate" ><br></span>
            </div>
            <button class= "button1" name="filter" type="submit" value="Submit">Filter</button>
        </form>
</div>
                                      <!--Filtering ends here -->


<?php

     $port = $_SERVER
    ['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";

        
    $mysqli = new mysqli($servername,$username,$password,$db);
    $dataPoints = array();
    $count = 0;
                       //Decision for the query based on filter selections is made here//
    $year = date("Y");
    $clinicaddon = " AND c.clinic_id = ";
    $cliniccondition = "1=1";
    $docaddon = " AND a.Doctor = ";
    $doccondition = "1=1";
    $fromdate = "";
    $todate = "";
    $i = 0;
    echo "The default daterange for this report is the entirety of the current year <br><br>";
            if (isset($_POST['filter'])){
                if(sizeof($_POST["clinic"]) != 0 && $_POST["clinic"][0] != "n/a"){ //Check for clinic filter selection.
                    while($i < sizeof($_POST["clinic"])) {
                        $cliniccondition = $cliniccondition.$clinicaddon.$_POST["clinic"][$i];
                        $i = $i + 1;
                        if($i > 0) {$clinicaddon = " OR c.clinic_id = ";}
                    }
                }
                if(sizeof($_POST["doctor"]) != 0 && $_POST["doctor"][0] != "n/a"){ //Check for doctor filter selection.
                    while($i < sizeof($_POST["doctor"])) {
                        $doccondition = $doccondition.$docaddon.$_POST["doctor"][$i];
                        $i = $i + 1;
                        if($i > 0) {$docaddon = " OR a.Doctor = ";}
                    }
                }
                if($_POST["fromdate"] != "") {            //Check if fromdate was selected
                    $fromdate = " AND a.DATE >= '".$_POST["fromdate"]."'";
                }
                if($_POST["todate"] != "") {              //Check if todate was selected
                    $todate = " AND a.DATE <= '".$_POST["todate"]."'";
                }

                
                if($_POST["fromdate"] != "" && $_POST["todate"] != "") {   //Display date range being used, with both filters or one
                    echo "Showing revenue date range: ".$_POST["fromdate"]." to ".$_POST["todate"];
                }
                else if($_POST["fromdate"] != "" && $_POST["todate"] == "") {
                    echo "Showing revenue from date: ".$_POST["fromdate"];
                }
                else if ($_POST["fromdate"] == "" && $_POST["todate"] != "") {
                    echo "Showing revenue up to date: ".$_POST["todate"];
                }
                
                        //Modified query with filters
                $query = "SELECT c.Name, p.p_num
                            FROM clinics c
                            JOIN (select a.CLINIC_ID, count(a.patient_id) AS p_num
                            from appointment a
                            where 1=1 ".$fromdate.$todate." AND (".$doccondition.")
                            group by a.CLINIC_ID) p ON p.CLINIC_ID = c.Clinic_Id
                            WHERE ".$cliniccondition;
            }
            else {     //Query when no filters are used or before the filtering button is pressed
                $query = "SELECT c.Name, p.p_num
                            FROM clinics c
                            JOIN (select a.CLINIC_ID, count(a.patient_id) AS p_num
                            from appointment a
                            where CAST(a.DATE AS DATE) >= '".$year."-01-01' AND CAST(a.DATE AS DATE) <= '".$year."-12-31'
                            group by a.CLINIC_ID) p ON p.CLINIC_ID = c.Clinic_Id
                            WHERE 1=1";
            }
    $result = mysqli_query($mysqli, $query);
    while($row = mysqli_fetch_array($result)) {
        $dataPoints[$count]["label"] = $row["Name"];
        $dataPoints[$count]["y"] = $row["p_num"];
        $count = $count + 1;
    }
    
?>

        <script> //Graph begins
        window.onload = function() {
         
        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	theme: "light2",
        	title:{
        		text: "Patient Traffic in Clinics "
        	},
        	axisY: {
        		title: "# of Patients"
        	},
        	data: [{
        		type: "column",
        		yValueFormatString: "#####",
        		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        	}]
        });
        chart.render();
         
        }
        </script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> <!--Graph ends-->








</body>
</html>