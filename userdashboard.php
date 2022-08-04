<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header('location:index.php?key=1');
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Game store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="icon/all.min.css">
<link rel="stylesheet" type="text/css" href="css/userdashboard.css">
	<link rel="stylesheet" type="text/css" href="jquery/jquery.js">
   <link rel="stylesheet" type="text/css" href="css/anicss.css">
   <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="jquery/jquery.js">
  <link rel="stylesheet" type="text/css" href="jquery/mixitup.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.min.js">
</head> 
<body>
 <div id="wrapper">
   <!--side bar-->
   <div id="sidebar-wrapper">
     <ul class="sidebar-nav">
       <li><a href="#" class="logo"><img src="img/c.png " width="50px" height="50px">Dashboard</a></li>
       <li><a href="userdashboard.php" ><i class="fas fa-home" ></i>Dashboard home</a></li>
       <li><a href="userdashboardgamee.php"><i class="fas fa-gamepad"></i>Game</a></li>
       <li><a href="home.php"><i class="fas fa-sign-out-alt"></i>Homepage</a></li>
      </ul>
    </div>
   <!--page content-->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn btn-success" id="menu-toggle">toggle menu</a>
            <div class="container jumbotron" style="text-align: center;">
             
              <div class="badge" style="display: inline-block; margin-left:0px; background:lightgreen; " >
               <a href="userdashboardgamee.php">
                 <h1>game</h1>
                 <p>go to game page</p>
               </a>
             </div>
           </div>
           <hr>
           <p style="text-align:center">2021 Dashboard<i class="fas fa-heart"></i>desgin byy me</p>
         </div>
        </div>
     </div>
  <!--menu toggle script-->
    <script>
      $("#menu-toggle").click(function(e){
       e.preventDefault();
      $("#wrapper").toggleClass("menuDisplayed");

      })
   </script>
      <footer>
<svg viewBox="0 0 120 28">
 <defs> 
    <filter id="goo">
      <feGaussianBlur in="SourceGraphic" stdDeviation="1" result="blur" />
      <feColorMatrix in="blur" mode="matrix" values="
           1 0 0 0 0  
           0 1 0 0 0  
           0 0 1 0 0  
           0 0 0 13 -9" result="goo" />
      <xfeBlend in="SourceGraphic" in2="goo" />
    </filter>
     <path id="wave" d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
  </defs> 

   <use id="wave3" class="wave" xlink:href="#wave" x="0" y="-2" ></use> 
   <use id="wave2" class="wave" xlink:href="#wave" x="0" y="0" ></use>
 
 
  <g class="gooeff" filter="url(#goo)">
  <circle class="drop drop1" cx="20" cy="2" r="8.8"  />
  <circle class="drop drop2" cx="25" cy="2.5" r="7.5"  />
  <circle class="drop drop3" cx="16" cy="2.8" r="9.2"  />
  <circle class="drop drop4" cx="18" cy="2" r="8.8"  />
  <circle class="drop drop5" cx="22" cy="2.5" r="7.5"  />
  <circle class="drop drop6" cx="26" cy="2.8" r="9.2"  />
  <circle class="drop drop1" cx="5" cy="4.4" r="8.8"  />
  <circle class="drop drop2" cx="5" cy="4.1" r="7.5"  />
  <circle class="drop drop3" cx="8" cy="3.8" r="9.2"  />
  <circle class="drop drop4" cx="3" cy="4.4" r="8.8"  />
  <circle class="drop drop5" cx="7" cy="4.1" r="7.5"  />
  <circle class="drop drop6" cx="10" cy="4.3" r="9.2"  />
  
  <circle class="drop drop1" cx="1.2" cy="5.4" r="8.8"  />
  <circle class="drop drop2" cx="5.2" cy="5.1" r="7.5"  />
  <circle class="drop drop3" cx="10.2" cy="5.3" r="9.2"  />
    <circle class="drop drop4" cx="3.2" cy="5.4" r="8.8"  />
  <circle class="drop drop5" cx="14.2" cy="5.1" r="7.5"  />
  <circle class="drop drop6" cx="17.2" cy="4.8" r="9.2"  />
  <use id="wave1" class="wave" xlink:href="#wave" x="0" y="1" />
 </g>  
    <!-- g mask="url(#xxx)">
    <path   id="wave1"  class="wave" d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
    </g>
  </g -->

</svg>
</footer>
  </body>
</html>