<?php
if (isset($_POST['send'])) {
	$box=$_POST['box'];
	$user = fopen('sent.txt', 'a+');
			$sent=fwrite($user, "$box"."\n");

			
	fclose($user);
		header('location: Message.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
</head>
<body>
<form method="post" action="Message.php">
	<input type="text" style="height: 70px;width: 70%" name="box" value="<?php if (isset($_POST['send'])) { echo 'sent';} ?>">
	<input type="submit" name="send" value="send">


</form>
<a href="AdminHome.php">Home</a>
</body>
</html>