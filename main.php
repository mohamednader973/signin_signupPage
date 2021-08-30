<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ITI</title>
  </head>
  <body>
    <div class="header">
      <ul style="list-style-type: none;" id="unlist">
        <li style="float: left; margin-right:2rem;"><a href="signup.php">Sign up</a></li>
        <li style="float: left; margin-right:2rem;"><a href="signin.php">log in</a></li>
      </ul>
    </div>
    <form action = "<?php $_PHP_SELF ?>" method="post">
    <td><input type = "submit" value="logout" /></td>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION["login"]=false;

    }
  ?>

    <img src="img1.jpg" alt="image" style="width:100%;height:580px;">

  </body>
  <?php
  if ($_SESSION["login"]) {
    $myName=$_SESSION["myname"];
    echo "
    <script type=\"text/javascript\">
      let mylist=document.getElementById(\"unlist\");
      mylist.remove();
      let node = document.createElement(\"h1\");
      let mydiv=document.getElementsByClassName(\"header\");
      document.getElementsByClassName(\"header\")[0].appendChild(node);
      document.querySelector(\"h1\").className=\"h1tag\";
      document.querySelector(\"h1\").textContent=\"you are signed in $myName!\";
    </script>
    ";
  }
  ?>

</html>
