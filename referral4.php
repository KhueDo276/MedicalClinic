  <html>
    <head>
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
        </body>
    </html>
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
            $dlisw = $_POST["namew"];
                    $wclinic = $_POST["clinicidd"];
                    $wmdayresult = mysqli_query($mysqli,"SELECT Monday FROM availability WHERE D_ID = '$dlisw'");
                    while($wmrow = mysqli_fetch_assoc($wmdayresult)) {
                        $wmonday = $wmrow["Monday"];
                    };
                    $wtdayresult = mysqli_query($mysqli,"SELECT Tuesday FROM availability WHERE D_ID = '$dlisw'");
                    while($wtrow = mysqli_fetch_assoc($wtdayresult)) {
                        $wtuesday = $wtrow["Tuesday"];
                    };
                    $wwdayresult = mysqli_query($mysqli,"SELECT Wednesday FROM availability WHERE D_ID = '$dlisw'");
                    while($wwrow = mysqli_fetch_assoc($wwdayresult)) {
                        $wwednesday = $wwrow["Wednesday"];
                    };
                    $wthdayresult = mysqli_query($mysqli,"SELECT Thursday FROM availability WHERE D_ID = '$dlisw'");
                    while($wthrow = mysqli_fetch_assoc($wthdayresult)) {
                        $wthursday = $wthrow["Thursday"];
                    };
                    $wfdayresult = mysqli_query($mysqli,"SELECT Friday FROM availability WHERE D_ID = '$dlisw'");
                    while($wfrow = mysqli_fetch_assoc($wfdayresult)) {
                        $wfriday = $wfrow["Friday"];
                    };
                    $wdayworked = [];
                    if ($wmonday == $wclinic)
                    {
                        $wdayworked[] = "Monday";
                    }
                    if ($wtuesday == $wclinic)
                    {
                        $wdayworked[] = "Tuesday";
            
                    }
                    if ($wwednesday == $wclinic)
                    {
                        $wdayworked[] = "Wednesday";
                    }
                    if ($wthursday == $wclinic)
                    {
                        $wdayworked[] = "Thursday";
                    }
                    if ($wfriday == $wclinic)
                    {
                        $wdayworked[] = "Friday";
                    }
                    
                    $da =  $_POST["date"];
                    $paymentDate = $da;
                    
                    $day = date('l', strtotime($paymentDate));
                    $good = false;
                    foreach($wdayworked as $dtemp)
                    {
                        if ($day == $dtemp)
                    {
                        $good = true;
                        
                    }
                    }
                    if ($good == false)
                    {
                        echo "Hello Sir OR Ma'am, You put the wrong day in";
                        echo "<form action = '/referral.php'>";
                        echo "<button type='submit' name = 'Submit'>Submit</button>";
                        echo "</form>";
                    }
                    else if ($good == true)
                    {
                    
                        $eightthirtyresult = mysqli_query($mysqli, "SELECT Time  FROM appointment WHERE DATE = '$da' AND CLINIC_ID = '$wclinic'  AND Doctor = '$dlisw'");
                        while($timerow = mysqli_fetch_assoc($eightthirtyresult)) {
                        $time[] = $timerow["Time"];
                    }
                    $Timesallowed = [];
                    $thingallowed = true;
                    foreach($time as $temp)
                    {
                        
                       if ("08:30:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                       echo  "<button type='submit' value='08:30:00'>8:30 A.M</button>";
                       echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                        
                       if ("09:00:00" == $temp )
                       {
                            $thingallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                        echo  "<button type='submit' name ='09:00:00'>9:00 A.M</button>";
                        echo "</form>";
                        
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                        
                       if ("09:30:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                        echo  "<button type='submit' value='09:30:00' name = 'time' >9:30 A.M</button>";
                        echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                        
                       if ("10:00:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {   
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                        echo  "<button type='submit' value='10:00:00' name 'time'>10:00 A.M</button>";
                        echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                       
                       if ("10:30:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                        echo  "<button type='submit' value='10:30:00' name = 'time'>10:30 A.M</button>";
                        echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                        
                       if ("11:00:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                       echo  "<button type='submit' value='11:00:00' name = 'time' >11:00 A.M</button>";
                       echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                        
                       if ("11:30:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                       echo  "<button type='submit' value='11:30:00' name = 'time'>11:30 A.M</button>";
                       echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    foreach($time as $temp)
                    {
                       if ("12:00:00" == $temp )
                       {
                            $thingsallowed = false;
                       };
                    }
                    if ($thingsallowed == true)
                    {
                        echo "<form action = 'referral5.php' method = 'POST'>";
                        echo "<input type='hidden' value= '$dlisw' name='namew' />";
                        echo "<input type='hidden' value= '$wclinic' name='clinicidd'/>";
                        echo "<input type='hidden' value= '$da' name='date' />";
                        echo  "<button type='submit' value='12:00:00' name = 'time'>12:00 P.M</button>";
                        echo "</form>";
                    }
                    else
                    {
                        $thingsallowed = true;
                    }
                    
                    }
                    
                    ?>
                    
