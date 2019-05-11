<?php
include 'registration_database_conn.php'; 
/*session start*/
/*second comment */
session_start();
error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);
$email= $pass ="";

if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $pass=$_POST['pass']; 
    $password_1 = md5($pass);
    // $_SESSION['email'] =  $email;
  //$_SESSION['pass'] = "You are now logged in";
  

    $sql = "SELECT  *  FROM user_table where email='".$email."' and password='".$password_1."'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_array($result );

    echo $sql."<br><br>";
    echo $record['image'];
    
    if (mysqli_num_rows($result) > 0) 
    { 
      echo "dddddddddd <br>";
     
      $_SESSION['email'] =  $email;
      //print_r($_SESSION);
      echo "You are now login ";
     header('location: dashboard.php');
    }
    
    
    else
    {
        echo "fail";
        echo mysqli_num_rows($result);

       

    }

}

 




?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>email</b></label>
    <input type="email" placeholder="Enter Username" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>

    <input type="submit" name="submit" value="submit"/>
   
  </div>

  <!-- <div class="container" style="background-color:#f1f1f1"> -->
    <!-- <button type="button" class="cancelbtn">Cancel</button> -->
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  </div>
</form>
