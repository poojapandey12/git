<?php
include 'registration_database_conn.php';

$name= $_POST["name"];
$age= $_POST["age"];
$gender= $_POST["gender"];
$email= $_POST["email"];
$phone= $_POST["phone"];
$password= $_POST["pass"];
$confirm_password= $_POST["c_pass"];

echo $name;
echo $age;
error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);
 //define variables and set to empty values
//  $name = $age = $gender = $email = $phone_no =  $phone_no = $password = $confirm_password ="";
//  $nameErr = $ageErr = $genderErr = $emailErr = $phoneErr =  $phone_noErr = $passErr = $c_passErr ="";



 function test_input($data) {
   $data = trim($data);
 $data = stripslashes($data);
  $data = htmlspecialchars($data);
   return $data;
 }

// validation
// echo "<pre>";
// print_r($_SERVER);
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "inside__";
     if (empty($_POST["name"])) {
       $nameErr = "Name is required";
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
         $nameErr = "Only letters and white space allowed";
       }
      else {
      $name = test_input($_POST["name"]);
     }
    if (empty($_POST["age"])) {
         $ageErr = "age is required";
      } else {
         $age = test_input($_POST["name"]);
      }
  
     if (empty($_POST["gender"])) {
      $genderErr = "gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  
     if (empty($_POST["email"])) {
        $emailErr = "email is required";
    } 
    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";       }
     else {
      $email = test_input($_POST["email"]);
     }
     if (empty($_POST["phone"])) {
         $phoneErr = "phone number is required";
     } 
     elseif (!preg_match('/^[0-9]{10}+$/',$_POST["phone"])) {
         $phoneErr = "enter valid phone number";
       }
     else {
      $phone = test_input($_POST["phone"]);
  }
  
   if (empty($_POST["pass"])) {
       $passErr = "password is required";
    }      elseif(strlen(trim($_POST["pass"])) < 6){
        $passErr = "password length must be atleast 6";
    }
    else {
   $pass = test_input($_POST["pass"]);
     }
  
    if (empty($_POST["c_pass"])) {
       $c_passErr = "Confirm Password is required";
  }
    elseif($pass!=$c_pass){
        $c_passErr = " Password not matching ";
    }      else {
       $c_pass = test_input($_POST["c_pass"]);
     }
}

$sql = "INSERT INTO user_table (name, age, gender, email, phone, password, confirm_password)
VALUES ('".$name."', '". $age."', '".$gender."', '".$email."', '".$phone."', '".$password."', '".$confirm_password."')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


echo "<pre>";
print_r("demoooooooooo".$sql);
echo($sql);

$conn->close();
?>