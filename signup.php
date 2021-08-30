<?php
 session_start();
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['Password']==$_POST['cpassword']) {
      setcookie("username", $_POST['name'], time() + (86400 * 30), "/");
      setcookie("password", $_POST['Password'], time() + (86400 * 30), "/");
      setcookie("confirmpassword", $_POST['cpassword'], time() + (86400 * 30), "/");
    }
     else{
       echo "passwords should match!";
     }
   }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Sign Up</title>
  </head>
  <body>
    <form class="form" action = "<?php $_PHP_SELF ?>" method="post" style="padding-left:35%; padding-top:10%;">
        <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name:</label>
        <input type="text" class="col-sm-3" id="fname" name="name" aria-describedby="emailHelp" placeholder="Enter name"></input>
        </div>
        <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Password:</label>
        <input type="text" class="col-sm-3" id="Password" name="Password" aria-describedby="emailHelp" placeholder="Enter password"></input>
        </div>
        <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Password:</label>
        <input type="text" class="col-sm-3" id="cpassword" name="cpassword" aria-describedby="emailHelp" placeholder="Enter password"></input>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary"></input>
    </form>
    <br>
    <div style="padding-left:45%; ">
      <button type="button" name="button1" style="margin-right:0.5rem;" onclick="goBack()" class="btn btn-primary">Main</button>
      <button type="button" name="button2" style="margin-right:0.5rem;" onclick="gologin()" class="btn btn-primary">Log in</button>
    </div>
    <br>
    <script type="text/javascript">
    function goBack() {
        window.location.href = "main.php";
        }
    function gologin(){
      window.location.href="signin.php"
    }
    </script>
  </body>
  <?php
  $_SESSION["uname"]=$_COOKIE['username'];
  $_SESSION["pass"]=$_COOKIE['password'];
    ?>
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

         // $query_file = 'sql_query.txt';
         // // //
         // $fp = fopen($query_file, 'r');
         //  $sql = fread($fp, filesize($query_file));
         //   fclose($fp);
          //$sql="create database $dbname";
         //select
         mysqli_select_db( $conn,$dbname );
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $name=$_POST['name'];
         $pass=$_POST['Password'];
         $cpass=$_POST['cpassword'];
         if ($pass==$cpass) {
           $sql = "INSERT INTO `user`(`name`,`password`)
           VALUES ('$name', '$pass');";
           $retval = mysqli_query( $conn,$sql );

           if(! $retval ) {
              die('Could not insert to table: ' . mysqli_error($conn));
           }

           echo "<br>Data inserted to table successfully\n";
         }
         }



         //   $retval = mysqli_query( $conn,$sql );
         //
         // if(! $retval ) {
         //    die('Could not create table: ' . mysqli_error($conn));
         // }

         //echo "<br>Database Table  created successfully\n";
         mysqli_close($conn);
      ?>
</html>
