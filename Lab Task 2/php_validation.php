<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>.error {color: #FF0000;}</style>
  <title>Document</title>
</head>
<body> 
  <?php
  // define variables and set to empty values
  $dobErr = $bloodErr = $degreeErr = $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $date = $month = $year = $blood = $degree = $name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
    // check if name contains more that one word
    if (str_word_count($name) < 2) {
      $nameErr = "Must contain two or more words";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["date"]) || empty($_POST["month"]) || empty($_POST["year"])) {
    $dobErr = "Date of birth is required";
  } else {
    $date = test_input($_POST["date"]);
    $month = test_input($_POST["month"]);
    $year = test_input($_POST["year"]);
    // check if date is valid
    if ($date < 1 || $date > 31 || $month < 1 || $month > 12 || strlen($year) != 4) {
      $dobErr = "Invalid date of birth";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
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

  if (empty($_POST["degree"])) {
    $degreeErr = "Degree is required";
  } else {
      // check if array element count is more than one
      if (count($_POST["degree"]) < 2) {
        $degreeErr = "Must select at least two";
      }
      else {
        $degree = $_POST["degree"];
      }
    }

  if (empty($_POST["blood"])) {
    $bloodErr = "Blood group is required";
  } else {
    $blood = $_POST["blood"];
  }
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1 style="text-align : center;">PHP Form Validation Example:</h1>
<div style="margin : 75px; border-radius : 5px; background-color : #f2f2f2; padding : 30px;">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <p>Name:</p>
  <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <p>E-mail:</p>
  <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <p>Date of birth:</p>
  <input type="number" name="date" placeholder="dd" style="width : 35px;" value="<?php echo $date;?>"> /
  <input type="number" name="month" placeholder="mm" style="width : 35px;" value="<?php echo $month;?>"> /
  <input type="number" name="year" placeholder="yyyy" style="width : 50px;" value="<?php echo $year;?>">
  <span class="error">* <?php echo $dobErr;?></span>
  <p>Website:</p>
  <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <p>Comment:</p>
  <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error"><?php echo $genderErr;?></span>
  <br><br>
  Degree:
  <input type="checkbox" name="degree[]" value="ssc">SSC
  <input type="checkbox" name="degree[]" value="hsc">HSC
  <input type="checkbox" name="degree[]" value="bsc">B.Sc.
  <input type="checkbox" name="degree[]" value="msc">M.Sc.
  <span class="error"><?php echo $degreeErr;?></span>
  <br><br>
  Blood Group:
  <select name="blood" id="">
    <option value="">None</option>
    <option value="a+">A+</option>
    <option value="b+">B+</option>
    <option value="ab+">AB+</option>
    <option value="o+">O+</option>
    <option value="a-">A-</option>
    <option value="b-">B-</option>
    <option value="ab-">AB-</option>
    <option value="o-">O-</option>
  </select>
  <span class="error"><?php echo $bloodErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>
</div>
<div style="margin : 75px">
<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $date . "/" . $month . "/" . $year;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
echo "<br>";
foreach((array)$degree as $check) {
  echo $check . " ";
}
echo "<br>";
echo $blood;
echo "<br>"
?>
</div>
</body>
</html>