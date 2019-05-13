<!DOCTYPE HTML>
<html> 
<head>
  
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

    <script src='https://www.google.com/recaptcha/api.js'></script>
  
</head> 
<body>
<?php
//include 'registration_database_save.php';
include 'registration_database_conn.php';
include 'mail.php';




error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);
// define variables and set to empty values
     
 $name = $age = $gender = $email = $phone = $pass = $c_pass =  $password_1 = $password_2 = $c_pass=$fileToUpload=$check="";
 $nameErr = $ageErr = $genderErr = $emailErr = $phoneErr =  $passErr = $c_passErr =""; $err="";

$image= $file_error="";



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// validation
//echo "eror";

if (isset($_POST['reg_user'])) 
{
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
      $err="true";
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
        $nameErr = "Only letters and white space allowed";
        $err="true";
    }
    else {
      $name = test_input($_POST["name"]);
    }
    if (empty($_POST["age"])) {
        $ageErr = "age is required";
        $err="true";
    } else {
      $age = test_input($_POST["age"]);
    }
  
  if (empty($_POST["gender"])) {
    $genderErr = "gender is required";
    $err="true";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["email"])) {
      $emailErr = "email is required";
      $err="true";
  } 
  elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  else {
    $email = test_input($_POST["email"]);
  }
  if (empty($_POST["phone"])) {
      $phoneErr = "phone number is required";
      $err="true";
  } 
  elseif (!preg_match('/^[0-9]{10}+$/',$_POST["phone"])) {
      $phoneErr = "enter valid phone number";
      $err="true";
  }
  else {
    $phone = test_input($_POST["phone"]);
  }

  if (empty($_POST["pass"])) {
      $passErr = "password is required";
      $err="true";
  } 
  elseif(strlen(trim($_POST["pass"])) < 6){
      $passErr = "password length must be atleast 6";
      $err="true";
  }
  else {
    $pass = test_input($_POST["pass"]);
  }

  if (empty($_POST["c_pass"])) {
    $c_passErr = "Confirm Password is required";
    $err="true";
  }
  
  elseif($pass!=$_POST["c_pass"]){
      $c_passErr = " Password not matching ";
      $err="true";
  } 
  else {
      $c_pass = test_input($_POST["c_pass"]);

  }
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  // echo($target_file);
  // print_r($_FILES);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 // echo($imageFileType);
// Check if image file is a actual image or fake image
if(isset($_POST["reg_user"])) {
      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
          move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
          //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
          $uploadOk = 1;
      } 
      else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
}
  

    
  $password_1 = md5($pass);
  // echo $age;
  // echo $name;
  // echo $_POST["age"];
  // print_r($_POST);
  echo "hello";
  echo $_FILES["file"]["name"];
      
  if($err!="true")
  {
    $sql = "INSERT INTO user_table (name,age,gender, email, phone, password,confirm_password, image) 
              VALUES('".$name."', '".$age."', '".$gender."', '".$email."', '".$phone."', '".$password_1."', '".$password_1."', '".$_FILES["file"]["name"]."')";
        

    if ($conn->query($sql) === TRUE) {
      send_email($name,$age, $email, $phone);
      echo "message sent";
     // echo "You are successfully registered";
      //header('location: success.php');
    }     
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  $conn->close();
     
      

  }

    

    
?>

<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
Name: <input type="text" name="name" value="<?php echo $name;?>"><br>
<span class="error"><?php echo $nameErr;?></span>
  <br><br>
AGE: <input type="number" name="age" value="<?php echo $_POST['age'];?>"><br>
<span class="error"> <?php echo $ageErr;?></span>
  <br><br>

 Gender:<input type="radio" name="gender"
    <?php if (isset($gender) && $gender=="female") echo "checked";?>
    value="female">Female
    <input type="radio" name="gender"
    <?php if (isset($gender) && $gender=="male") echo "checked";?>
    value="male">Male
    <input type="radio" name="gender"
    <?php if (isset($gender) && $gender=="other") echo "checked";?>
    value="other">Other<br>


E-mail: <input type="text" name="email" value="<?php echo $email;?>"><br>
<span class="error"> <?php echo $emailErr;?></span>
  <br><br>

Phone_no: <input type="number" name="phone" value="<?php echo $phone;?>"><br>
<span class="error"><?php echo $phoneErr;?></span>
  <br><br>
Password: <input type="password" name="pass" value="<?php echo $_POST['pass'];?>"><br>
<span class="error"> <?php echo $passErr;?></span>
  <br><br>
Confirm_Password: <input type="password" name="c_pass"><br>
<span class="error"> <?php echo $c_passErr;?></span>
  <br><br>
File_Upload: <input type="file" name="file" id="fileToUpload">
<br><br>
<div class="g-recaptcha" data-sitekey="6LcuQKMUAAAAAN_kgbCW0whplyJ-3lXJKlHvzJqy"></div>
<!-- <div class="g-recaptcha" data-sitekey="Your_reCAPTCHA_Site_Key"></div> -->

<input type="submit" value="submit"  name="reg_user">
</form>





</body>
</html>


