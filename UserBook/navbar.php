<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/1537167eaa.js" crossorigin="anonymous"></script>
<style>
  .u {
	position: fixed;
	width: 100%;
	list-style-type: none;
	z-index: 1;
	margin: 0;
	padding: 0;
	overflow: hidden;
	background-color: rgb(237, 236, 236);
  }
  
  .u li {
	float: left;
	font-size: 17px;
  
  }
  
  .u li a {
	display: block;
	color: black;
	text-align: center;
	padding: 14px 16px ;
	text-decoration: none;
	transition: 0.3s;
  }
  
  .u li a:hover {
	text-decoration: none;
	transition: 0.3s;
	color: #966F33;
	background-color: rgb(227, 226, 226);
  }

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}
  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  padding-top:8px;
  margin-left:-75px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;
transition:0.3s}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
 <?php session_start();?>
<!--<ul class="u">
  <div style="margin-left: 15px;">
  <li><a href="OrdersClientHistory.php">Your Orders</a></li>
  <li><a href="contact.php">Contact us</a></li>
  <li><a href="restaurants.php">Restaurants</a></li>
  </div>
  <li style="margin-left: 23%;"><a href="homepage.php">Home</a></li>
  <div style="float:right;margin-right: 20px;">
  <li><a class="active" href="#about">About &nbsp<i class='far fa-question-circle'></i></a></li>
  
  </div>
</ul> -->
<nav style="z-index: 1;position:fixed;width:100%;" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../homepage.php">R'EASY'rvations</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../homepage.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../restaurants.php">Restaurants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../contact.php">Contact us</a>
      </li>
    </ul>
	<ul class="navbar-nav ">
  <li class="nav-item">
        <a class="nav-link" href="../help.php"><i class="fa fa-thin fa-circle-info"></i>&nbsp Help</a>
      </li>
	<li class="nav-item">
        <a class="nav-link" href="../About.php">	<i class='far fa-question-circle'></i>&nbsp About</a>
      </li>
      
      <?php
			if(isset($_SESSION['User'])){
				if($_SESSION['User']==null){
					echo "<li class='nav-item'><a class='active nav-link' href='../logboth.php'><i class='far fa-user-circle'></i>&nbsp Sign In</a></li>";
				}
				else{
        echo "<div class='dropdown'>";
        echo "<li class='nav-item' style='cursor:pointer'><a class='active nav-link'> <i class='far fa-user-circle'></i>&nbsp ".$_SESSION['User']."</a></il>";
        echo "<div class='dropdown-content'>";
        echo "<a href='../profile.php' style='color:black' class='nav-link'>View Profile</a>";
        include '../dbCon.php';
        $name=$_SESSION['User'];
        $sql="SELECT * FROM tbowner WHERE Username='$name'";
        $res=mysqli_query($GLOBALS['con'],$sql);
        if(mysqli_num_rows($res)!=0){
          echo "<a href='../Owner/ownerside.php' style='color:black' class='nav-link'>Dashboard</a>";
        }
        $sql2="SELECT * FROM tbadmin WHERE Username='$name'";
        $res2=mysqli_query($GLOBALS['con'],$sql2);
        if(mysqli_num_rows($res2)!=0){
          echo "<a href='../Admin/Adminside.php' style='color:black' class='nav-link'>Dashboard</a>";
        }
        echo "<a href='../OrdersClientHistory.php' style='color:black' class='nav-link'>View Ordering History</a>";
        echo "<a style='background-color:red;color:white' class='nav-link' href='../logout.php'>Logout</a>";
        echo "</div>";
        echo "</div>";
      }
				// echo "<li class='nav-item' ><a class='active nav-link' href=''>Account &nbsp<i class='far fa-user-circle'></i></a></li>";
				// echo "<li class='nav-item' style='background-color:red'><a href='logout.php' class='nav-link' tyle='color:white'>Logout</a></li>";

			}
			else
      echo "<li class='nav-item'><a class='active nav-link' href='../logboth.php'><i class='far fa-user-circle'></i>&nbsp Sign In</a></li>";
      ?>
    </ul>
  </div>
</nav>
<br>
<br>