<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- THE NAVBAR -->
<?php include 'navbar.php'?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/contact.css">
<div class="container" style="padding-top:18px">
  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Send mail to one of these, or leave us a message!</p>
  </div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Position</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Alaa Barazi</td>
      <td>brazialaa@gmail.com</td>
      <td>Co-Founder</td>
    </tr>
    <tr>
      <td>Muhammad Hajouj</td>
      <td>hajoujf@gmail.com</td>
      <td>Co-Founder</td>
    </tr>
  </tbody>
</table>
  <div class="row">
    <div style="padding-left:30px" class="column">
      <img  src="./images/Rlogo.png" style="margin-left:13px;width:80%">
    </div>
    <div class="column">
      <form action="ContactDB.php" method="post">
        <label for="fname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="Your first name" required>
        <label for="lname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Your last name" required>
        
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something..." style="height:170px" required></textarea>
       <center>
        <input class ="button bg-dark" style="border-radius:3px;"type="submit" value="Submit">
      </center>
      </form>
    </div>
  </div>
</div>