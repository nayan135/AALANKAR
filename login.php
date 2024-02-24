
<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'config.php';
    $name = $_POST["name"];
    $password = $_POST["password"]; 
    
     
    $sql = "Select * from data where name='$name' AND password='$password'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location:./get_audio.php");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login </title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"
    />
  </head>
  <body>
    <div class="login-box">
      <h1>Login<br>

      </h1>
      <div class="error">
      <?php
       echo $showError;
?>
      </div>
      <form action="login.php" method="post">
 
        <label>USERNAME</label>
        <input type="text" name="name" placeholder="" />
        <label>Password</label>
        <input type="password" name="password" placeholder="" />
        <input type="submit" value="Submit" />
      <closeform></closeform></form>
    </div>
    <p class="para-2">
      Not have an account? <a href="index.php">Sign Up Here</a>
    </p>

  </body>
</html>

