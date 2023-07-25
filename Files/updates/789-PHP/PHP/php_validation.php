<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>


</head>
<body>


<?
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
	 //$name = $_POST["name"];
   }
  
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
   }
    
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   echo $data."<br/>";
   $data = stripslashes($data);
   echo $data."<br/>";
   $data = htmlspecialchars($data);
   echo $data;
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>

<form method="post" action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   
   Name: <input type="text" name="name">
   <span class="error">* <? echo $nameErr;?></span>
   <br><br>
   
   E-mail: <input type="text" name="email">
   <span class="error">* <? echo $emailErr;?></span>
   <br><br>
   
   Website: <input type="text" name="website">
   <span class="error"><? echo $websiteErr;?></span>
   <br><br>
   
   Comment: <textarea name="comment" rows="5" cols="12"></textarea>
   <br><br>
   
   Gender:
   <input type="radio" name="gender" value="female">Female
   <input type="radio" name="gender" value="male">Male
   <span class="error">* <? echo $genderErr;?></span>
   <br><br>
   
   <input type="submit" name="submit" value="Submit">
   
</form>

<?
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>
