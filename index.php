
<?php 

@include 'config.php';

$insert = false;
if(isset($_POST['name'])){
if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    $name = $_POST['name'];
 $lastname = $_POST['lastname'];
 $email = $_POST['email'];
 $password = $_POST['password'];

   $sql = "INSERT INTO  data(`name`, `lastname`, `email`, `password`, `dt`) VALUES ( '$name', '$lastname', '$email', '$password', current_timestamp())";
    if($con->query($sql) == true){ 
      
        
        $insert = true;
        header('location:./login.php');
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="preloader.css">
    <script>
		setTimeout(function(){
window.onload=function(){
document.getElementById('loader').style.display="none";
document.getElementById('content').style.display="block";
}
}, 50);
		};
		</script>
		<style>
		
		</style>
  </head>
  <body>
  
    <div class="signup-box">
      <h1>Sign Up</h1>
      <h4>It's free and only takes a minute</h4>
      <form action="index.php" method="post">
        <label>First Name</label>
        <input type="text" name="name" id="name" placeholder="" />
        <label>Last Name</label>
        <input type="text" name="lastname"  id="lastname" placeholder="" />
        <label>Email</label>
        <input type="email" name="email"  id="email" placeholder="" />
        <label>Password</label>

        <input type="image/jpeg" name="image/jpeg"  id="image/jpeg" placeholder="" />
        <label>Profile Picture</label>
        <input type="password" name="password"  id="password" placeholder="" />
        <input type="submit" value="Submit" />
      <closeform></closeform></form>
      <p>
        By clicking the Sign Up button,you agree to our <br />
        <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a>
      </p>
    </div>
    <p class="para-2">
      Already have an account? <a href="login.php">Login here</a>
    </p>
    <?php
        if($insert == true){
        echo "<p class='submitMsg'>Thanks for Creating your account</p>";
        }
    ?>

  </div>
  
  </body>


</html>