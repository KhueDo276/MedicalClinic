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
            echo $middlei;
            $lastname = $_POST["lastname"];
            echo $lastname;
            $address = $_POST["address"];
            $dob = $_POST["dob"];
           
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