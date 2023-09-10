<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<style>
</style>
<body>
<!-- THE NAVBAR -->
<?php include 'navbar.php'?>
<link rel="stylesheet" href="CSS/home.css">
<!-- HEADER  -->
<div class="header" id="top">
  	<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:140px;margin-top:132px;background-color:transparent;color:white;">
  	<h1>
      R'EASY'RVATION
</h1>
    <p style="height:140px;background-color:transparent;color:white;font-size:19.5px">
      An Easier And Simpler Way To pick A Resturaunt And Book A Table!
    </p>
    <div>
    <?php
			if(isset($_SESSION['User'])){
				if($_SESSION['User']==null){
					echo "<a href='Register/UserType.php'><button class='btn'>REGISTER</button></a> &nbsp <a href='logboth.php'><button class='btn'>Login</button></a>";
				}
				else
				echo "<text style='font-weight:bolder;font-size:18px'>Welcome back ". $_SESSION['User'] ."!</text>";
			}
			else
      echo "<a href='Register/UserType.php'><button class='btn'>REGISTER</button></a> &nbsp <a href='logboth.php'><button class='btn'>Login</button></a>";
      ?>
    <br>
    </div>
  </div>
</div>
</div>
<!-- END OF HEADER -->
<!-- RESTAURANT CARDS TOP 5 -->
<div style="width:100%;background-color: rgb(237, 236, 236);height:45px;display:flex;align-items:center; justify-content:center;margin-bottom:10px">
<p style="font-size: 17px;margin-top:12px"></p>
</div>
<div style="display:flex;justify-content:center;">
<div class="row" style="width:80%;">
          <div class="col-lg-4">
          <center><img class="rounded-circle" src="images/easy.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Easy to use</h2>
            <p>Booking a table at any restaurant is a breeze with our easy-to-use website. Find your perfect dining spot, select date and time, and receive a confirmation in no time. Say goodbye to long waits and enjoy hassle-free reservations at your fingertips.</p>
          </center></div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
          <center><img class="rounded-circle" src="images/fastt.png" alt="Generic placeholder image" width="140" height="140">
            <h2>Fast</h2>
            <p>Booking a table on our website is hassle-free. With just a few clicks, you can secure a reservation at any restaurant of your choice, saving you time and effort. Our user-friendly interface and streamlined process ensure a swift booking experience, so you can focus on enjoying your dining experience.</p>
          </center></div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
          <center><img class="rounded-circle" src="images/eff.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>efficient</h2>
            <p>Our website is designed for maximum efficiency, offering a seamless and hassle-free experience. With intuitive navigation and streamlined processes, you can effortlessly book a table, explore restaurants, and manage reservations with ease.</p>
          </center></div><!-- /.col-lg-4 -->
</div>
</div>
  <!-- ABOUT US -->
  <div id="portfolio" style="width:100%">
  <div class="columnp" style="background-color:#966F33;">
    <h2 style="color: white;">Book a table!</h2>
    <p style="color: white;margin-top:20px">Finding the perfect restaurant can be a challenging task, especially if you're not familiar with the area or you're looking for something specific. However, our website designed to make this process much easier. Once you've found a restaurant that suits your preferences, you can quickly book a table through the site, without having to make a phone call or send an email. Additionally, We provides helpful information such as menus, reviews, and photos of the restaurant, making it easier to decide whether it's the right fit for you. With its user-friendly interface and vast selection of restaurants, We is an excellent tool for anyone looking to make dining out a more enjoyable experience.
    </p>
    <a href='Restaurants.php' class='btn' style='width:100%;border:transparent'>View Restaurants</a>
  </div>
  <div class="columnp" style="background:url(images/sideR.jpg);background-repeat:no-repeat;background-size:contain">
  </div> 
  </div>
</div>
<div style="margin-top:-3px;width:100%;background-color: rgb(237, 236, 236);height:45px;display:flex;align-items:center; justify-content:center;margin-bottom:10px">
<p style="font-size: 17px;margin-top:12px">Our Team</p>
</div>
<div class="container">
        <!-- Example row of columns -->
        <div class="row" style="display:flex;justify-content:center" >
        <div class="col-md-4"><center>
        <img class="rounded-circle" src="images/Hajouj.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Muhammad Hajouj</h2>
            <p><font class='font-weight-bold text-primary'>Major: </font>Practical Software Engineering
            <br><font class='font-weight-bold text-primary'>College: </font>Ort Braude Karmiel
            <br><font class='font-weight-bold text-primary'>Email: </font>hajoujf@gmail.com</p>

            <p><a class="btn" href="https://www.linkedin.com/in/muhammad-hajouj-2225a2259/" style="width:155px;background-color: #966F33;" target="blank" role="button">View linkedin »</a></p>
            </center></div>
          <div class="col-md-4">
          <center>
          <img class="rounded-circle" src="images/alaa.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Alaa Barazi</h2>
            <p><font class='font-weight-bold text-primary'>Major: </font>Practical Software Engineering
            <br><font class='font-weight-bold text-primary'>College: </font>Ort Braude Karmiel
            <br><font class='font-weight-bold text-primary'>Email: </font>brazialaa@gmail.com</p>
            <p><a class="btn" style="width:155px;background-color: #966F33;" href="https://www.linkedin.com/in/alaa-barazi-529769183/" target="blank" role="button">View linkedin »</a></p>

          </center></div>
<br><br><br><br><br>

<footer class="container">
        <p class="float-right"><a href="#top">Back to top</a></p>
        <p>© 2022-2023 Company, Inc. · <a href="contact.php">Contact us</a> · <a href="About.php">About</a></p>
      </footer>
</body>