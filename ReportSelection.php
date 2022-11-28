
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

    <button class="button1" onclick="document.location='Rrevenue.php'" formtarget="_blank">Clinic Revenue Report</button><br><br>
    <button class="button1" onclick="document.location='Rclinictraffic.php'" formtarget="_blank">Patient-Clinic Traffic Report</button><br><br>
    <button class="button1" onclick="document.location='Rpatientage.php'" formtarget="_blank">Patient Age-group Distribution</button><br><br>
</body>
</html>

 
