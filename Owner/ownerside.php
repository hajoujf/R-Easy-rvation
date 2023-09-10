<link href='../CSS/ManagerSide.css' rel='stylesheet'>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<style>
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

</style>
<?php session_start();?>

  <div class="sidebar bg-dark">
    <div class="logo-details">
      <span class="logo_name">R'EASY'RVATION</span>
    </div>
      <ul class="nav-links" id="sidebar">
        <li>
          <a href="#home" id="a" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#Orders" id="a">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="#Rest" id="a">
            <i class='bx bx-pie-chart-alt-2'></i>
            <span class="links_name">Res Vizualisation</span>
          </a>
        </li>
    
        <li>
          <a href="#Vis" id="a">
            <i class='bx bx-restaurant' ></i>
            <span class="links_name">Add Tables</span>
          </a>
        </li>

        <li>
          <a href="#Menu" id="a">
            <i class='bx bx-receipt' ></i>
            <span class="links_name">Menu</span>
          </a>
        </li>

        <li>
          <a href="#Reviews" id="a">
            <i class='bx bx-message' ></i>
            <span class="links_name">Reviews</span>
          </a>
        </li>

        <li>
          <a href="#Help" id="a">
            <i class='bx bx-info-circle' ></i>
            <span class="links_name">Help</span>
          </a>
        </li>

        <li class="log_out">
          <a href="../logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details" style="min-width:10px">
      <div class="dropdown">
        <img src='../CSS/pfp.jpg' class='user-img rounded-circle mr-2'  style="margin-left:20px">
        <span  style="margin-left:20px" class="admin_name"><?php echo "".$_SESSION['User']."";?></span>
        <i class='bx bx-chevron-down' ></i>
        <div class='dropdown-content'>
        <a href='../homepage.php' style='color:black' class='nav-link'>Main Website</a>
        </div>
        </div>
      </div>
    </nav>
    <div class="home-content">
		<div id="home">
			<div class="content">
        	<?php include "main_dash.php"?>
    		</div>
		</div>
		<div id="Orders">
			<div class="content">
        	<?php include "ViewOrders.php"?>
    		</div>
		</div>
    <div id="Rest">
      <div class="content">
        <?php
        include "Rest/TheRest.php";
        ?>
      </div>
    </div>
    <div id="Vis">
      <div class="content">
        <?php
        include "Rest/AddTables.php";
        ?>
      </div>
    </div>
		<div id="Menu">
			<div class="content">
        	<?php include "showAll.php"?>
    		</div>
		</div>
    <div id="Reviews">
			<div class="content">
        	<?php include "Reviews.php"?>
    		</div>
		</div>
    <div id="Help">
			<div class="content">
        	<?php include "Help.php"?>
    		</div>
		</div>
    
	</div>
</section>

    <script>
   		let sidebar = document.querySelector(".sidebar");
		let sidebarBtn = document.querySelector(".sidebarBtn");
		sidebarBtn.onclick = function() {
  			sidebar.classList.toggle("activeS");
  			if(sidebar.classList.contains("activeS")){
  				sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
			}
			else
  				sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
			}



		var listItems = document.querySelectorAll('#sidebar li');
  		listItems.forEach(function(item) {
    	item.addEventListener('click', function() {
			var elements = document.querySelectorAll(".active");
      		// Loop through all elements and remove the class
      		for (var i = 0; i < elements.length; i++) {
        		elements[i].classList.remove("active");
      		}
      		// remove active class from all li elements
      		listItems.forEach(function(li) {
        		li.classList.remove('active');
      		});
      		// add active class to the clicked li element
      		item.classList.add('active');
    		});
  		});
	</script>
