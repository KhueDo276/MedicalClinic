<style>
 .home-pic {
  width: 100%;
  height: 100%;
}

h1 {
  position: absolute;
  width: 50%;
  font-size: 110px;
  font-family: "Times New Roman", Times, serif;
  margin-top: -5px;
}
.threeD {
  color: black;
  white-space: nowrap;
  position: absolute;
  top: 50%;
  left: 38%;
  transform: translate(-50%, -50%);
  font-size: 3em;
  font-family: sans-serif;
  letter-spacing: 0.1em;
  transition: 0.3s;
  text-shadow: 1px 1px 0 grey, 1px 2px 0 grey, 1px 3px 0 grey, 1px 4px 0 grey,
    1px 5px 0 grey, 1px 6px 0 grey, 1px 7px 0 grey, 1px 8px 0 grey,
    5px 13px 15px black;
}

.threeD:hover {
  transition: 0.3s;
  transform: scale(1.1)translate(-50%, -50%);
  text-shadow: 1px -1px 0 grey, 1px -2px 0 grey, 1px -3px 0 grey,
    1px -4px 0 grey, 1px -5px 0 grey, 1px -6px 0 grey, 1px -7px 0 grey,
    1px -8px 0 grey, 5px -13px 15px black, 5px -13px 25px #808080;
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
    
    <img src="backgroundpic.jpg" alt="" class="home-pic" />
    <div class="threeD">
        <h1> Welcome
            <?php 
    session_start();
    if(!isset($_SESSION['admin'])) // If session is not set then redirect to Login Page
       {
           header("Location:https://medicalgroup.azurewebsites.net/");  
       }
    echo $_SESSION['admin'];
    // echo "Welcome Dr.Username";
       ?>  
        </h1>
    </div>
</body>
</html> 

