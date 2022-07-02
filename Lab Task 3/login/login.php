<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
	$name = $password = "";
	$nameErr = $passwordErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// name validation
		if (empty($_POST("name"))) {
			$nameErr = "* Please enter name";
		}
		elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST("name"))) {
			$nameErr = "* Only letters and whitespace are allowed";
		}
		elseif (strlen($_POST("name")) < 2) {
			$nameErr = "* Enter at least two characters";
		}
		else (
			$name = $_POST("name");
		)
		// password validation
		if (empty($_POST("password"))) {
			$passwordErr = "* Please enter password";
		}
		elseif (strlen($_POST("password")) < 8) {
			$passwordErr = "* Must contain 8 characters";
		}
		else {
			$password = $_POST("password");
		}
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	Username:
	<input type="text" name="name" value="<?php echo $name ?>">
	<span class="error"><?php echo $nameErr;?></span>
	<br>
	Password:
	<input type="password" name="password" value="<?php echo $password ?>">
	<span class="error"><?php echo $passwordErr;?></span>
	<br>
	<input id="remember" type="checkbox" name="remember">
	<label for="remember">Remember me</label>
	<br>
	<input type="submit" name="login" value="Login">
</form>
</body>
</html>