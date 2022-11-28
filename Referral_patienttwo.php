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
  margin-bottom: 100px;
}
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(4, auto);
  grid-gap: 11px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content:center;
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
  margin-top: 100px;
  /*margin-bottom: 50px;*/
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
            Referrals
        </title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_patient.html");
});
</script>
<?php 
    $port = $_SERVER['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    session_start();
    $patientid = $_SESSION['patient'];
    $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
    if ($mysqli->connect_error) 
    {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $doctor = $_POST["doctorname"];
    $dlist = substr($doctor, strpos($doctor, ":")+1, (strlen($doctor) -strpos($doctor, ":")) );
    $ddoctor = $_POST["receivingdoctorname"];
    $list = substr($ddoctor, strpos($ddoctor, ":")+1, (strlen($ddoctor) -strpos($ddoctor, ":")) );
    echo $doctorid.$ddoctorid;

    $result = mysqli_query($mysqli,"SELECT  Monday FROM availability WHERE D_ID = '$list'");
    $mlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $mlist = $row["Monday"];
    }

    $result = mysqli_query($mysqli,"SELECT  Tuesday FROM availability WHERE D_ID = '$list'");
    $tlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $tlist = $row["Tuesday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT Wednesday FROM availability WHERE D_ID = '$list'");
    $wlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $wlist = $row["Wednesday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT  Thursday FROM availability WHERE D_ID = '$list'");
    $thlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $thlist = $row["Thursday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT Friday FROM availability WHERE D_ID = '$list'");
    $flist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $flist = $row["Friday"];
    }
    $clinic = [];
    $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$mlist'");
    while($row = mysqli_fetch_assoc($result)) 
    {
    $clinic[] = $row;
    }
    if ($mlist != $tlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$tlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $wlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$wlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $thlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$thlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $flist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$flist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    echo " 
        <div class='employee'>
        <h1> Choose Clinic Location </h1>
        <form action='Referral_patientthree.php' method='post'>
            <div class='form'>
                <label>Clinic</label>
                <select name='clinic'>
                <option value='' disabled selected>--select--</option>";
                foreach($clinic as $ntemp)
                {
                     echo "<option> $ntemp[Adress]</option>";
                }
        echo "      
        </select>
        </div>
        <input type='hidden' value= '$mlist' name='mondayid'/>
        <input type='hidden' value= '$tlist' name='tuesdayid'/>
        <input type='hidden' value= '$wlist' name='wednesdayid'/>
        <input type='hidden' value= '$thlist' name='thursdayid'/>
        <input type='hidden' value= '$flist' name='fridayid'/>
        <input type='hidden' value= '$list' name='receivingid'/>
        <input type='hidden' value= '$dlist' name='doctorid'/>
        <button class= 'button1' name='send' type='submit' value='Submit'>Submit</button>
        </form>
        </div>
            ";
?>
        
    </body>
</html>
    