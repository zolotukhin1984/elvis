<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Подписаться на рассылку</title>
</head>
<body>
	<h1>Интернет-магазин</h1>
	<a href="index.php">Сделать рассылку</a>
	<a href="addemail.php">Добавить адреса</a>
	<a href="removeemail.php">Удалить адреса</a>
	<br>

	<?php

	if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) ) {
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$email = $_POST['email'];

		$dbh = mysqli_connect('localhost', 'root', '', 'elvis_store')
			or die('Ошибка соединения с MySQL-сервером');

		$query = "
			INSERT INTO email_list 
			(first_name, last_name, email)
			VALUES 
			('$first_name', '$last_name', '$email')
		";

		mysqli_query($dbh, $query)
			or die('Ошибка выполнения запроса к базе данных');

		mysqli_close($dbh);

		echo $first_name . ' ' . $last_name . ' с почтой: ' . $email . ' добавлен.';
		// Зачем это обнуление?
		//$first_name = '';
		// $last_name = '';
		// $email = '';
		// header("Location: addemail.php");
		// die()

	} else { ?>
		<p>Введите свои данные, чтобы получать рассылку</p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<label for="firstname">Имя:</label>
			<input type="text" id="firstname" name="firstname" value="<?php if ( isset($_POST['firstname']) ) {echo $_POST['firstname'];} ?>"><br>
			<label for="lastname">Фамилия:</label>
			<input type="text" id="lastname" name="lastname" value="<?php if ( isset($_POST['lastname']) ) {echo $_POST['lastname'];} ?>"><br>
			<label for="email">Электропочта:</label>
			<input type="text" id="email" name="email" value="<?php if ( isset($_POST['email']) ) {echo $_POST['email'];} ?>"><br>
			<button type="submit" name="submit">Отправить</button>		
		</form>
	<?php } ?>
</body>
</html>