<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link href='../CSS/AdminSide.css' rel='stylesheet'>
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
          <a href="#UR" id="a">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Unapproved Rest.</span>
          </a>
        </li>
        <li>
          <a href="#AR" id="a">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">All Restaurants</span>
          </a>
        </li>
        <li>
          <a href="#Reviews" id="a">
          <i class='fa fa-flag b four' ></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <li>
          <a id="a" onclick="openWindow()" style="cursor:pointer">
            <i class='bx bx-message' ></i>
            <span class="links_name">GoogleMaps</span>
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
      <div class="profile-details">
        <img src='../CSS/pfp.jpg' class='user-img rounded-circle mr-2'  style="margin-left:20px">
        <span  style="margin-left:20px" class="admin_name"><?php echo "".$_SESSION['User']."";?></span>
        </div>
      </div>
    </nav>

    <div class="home-content">
		<div id="home">
			<div class="content">
        	<?php include "main_dash.php"?>
    		</div>
		</div>
		<div id="UR">
			<div class="content">
        	<?php include "UnapprovedRest.php"?>
    		</div>
		</div>
		
		<div id="AR">
			<div class="content">
        	<?php include "AllRest.php"?>
    		</div>
		</div>
		<div id="Reviews">
			<div class="content">
        	<?php include "Reports.php"?>
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

  function openWindow() {
    window.open("search.php","popup", "width=500,height=500");
  }
	</script>
