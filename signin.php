<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Log in</title>
  </head>
  <body>
    
    <form class="form" action = "<?php $_PHP_SELF ?>" method="post" style="padding-left:35%; padding-top:10%;">
        <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name:</label>
        <input type="text" class="col-sm-3" id="fnameLog" name="logName" aria-describedby="emailHelp" placeholder="Enter email"></input>
        </div>
        <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Password:</label>
        <input type="text" class="col-sm-3" id="PasswordLog" name="logPassword" aria-describedby="emailHelp" placeholder="Enter password"></input>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary"></input>
    </form>
    <br>
    <div style="padding-left:45%; ">
      <button type="button" name="button1" style="margin-right:0.5rem;" onclick="goBackmain()" class="btn btn-primary">Main</button>
      <button type="button" name="button2" style="margin-right:0.5rem;" onclick="goBacksign()" class="btn btn-primary">Sign up</button>
    </div>

    <br>
    <script type="text/javascript">
    function  goBacksign(){
      window.location.href = "signup.php";
    }
    function  goBackmain(){
      window.location.href = "main.php";
    }
    </script>
  </body>

  <?php
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname ='users';
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

  if(! $conn ) {
     die('Could not connect: ' . mysqli_error($conn));
  }

  //echo 'Connected successfully<br>';
  mysqli_select_db( $conn,$dbname );

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT ID, name, password FROM user";
    $retval = mysqli_query( $conn,$sql );
    $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if ($row["name"]==$_POST["logName"] && $row["password"]==$_POST["logPassword"]) {
      echo "you are logged in";
      $flag=true;
      $_SESSION["myname"]=$row["name"];
      break;
    }
    else{
    $flag=false;
    }
  }
  if ($flag) {
    $_SESSION["login"]=true;
    echo "
    <script type=\"text/javascript\">
      window.location.href = \"main.php\";
    </script>
    ";
  }
  else{
    echo "Email or password is wrong!";
  }

   }
else {
   echo "0 results";
}
    if(! $retval ) {
       die('data retrieval is not done: ' . mysqli_error($conn));
    }
  //  echo "<br>Data retrieved successfully\n";

    mysqli_close($conn);
  }


   ?>
</html>
