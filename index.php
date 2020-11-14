<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>Сделать рассылку</title>
</head>
<body>
	<h1>Интернет-магазин вещей Элвиса</h1>
	<p>Самый лучший интернет-магазин вещей Элвиса Пресли</p>
	<a href="index.php">Сделать рассылку</a>
	<a href="addemail.php">Добавить адреса</a>
	<a href="removeemail.php">Удалить адреса</a>
	<br>

	<?php

	if ( !empty($_POST['subject']) && !empty($_POST['elvismail']) ) {
		$subject = $_POST['subject'];
		$elvismail = $_POST['elvismail'];

		$dbh = mysqli_connect('localhost', 'root', '', 'elvis_store')
			or die('Ошибка соединения с MySQL-сервером');

		$query = "SELECT * FROM email_list";

		$result = mysqli_query($dbh, $query)
			or die('Ошибка выполнения запроса к базе данных');

		mysqli_close($dbh);

		echo '<br><br><b>Рассылка произведена по адресам:</b><br>';
		while ( $row = mysqli_fetch_array($result) ) {
			echo $row['first_name'] . ' ' . $row['last_name'] . ': ' . $row['email'] . '<br>';
		}
		echo '<b><br>Тема рассылки:</b> ' . $subject . '<br>';
		echo '<b>Текст рассылки:</b> ' . $elvismail;
	} else {
		if ( isset($_POST['submit']) ) {
			if ( empty($_POST['subject']) && empty($_POST['elvismail']) ) {
				echo '<br><br>Вы забыли ввести тему и текст письма.';
			} elseif ( empty($_POST['subject']) ) {
				echo '<br><br>Вы забыли ввести тему письма.';
			} elseif ( empty($_POST['elvismail']) ) {
				echo '<br><br>Вы забыли ввести текст письма.';
			}
		} ?>
		<h3>Рассылка</h3>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<label for="subject">Тема:</label><br>
			<input type="text" id="subject" name="subject" value="<?php if ( isset($_POST['subject']) ) {echo $_POST['subject'];} ?>"><br>
			<label for="elvismail">Текст:</label><br>
			<textarea id="elvismail" name="elvismail" rows="8" cols="60"><?php if ( isset($_POST['elvismail']) ) {echo $_POST['elvismail'];} ?></textarea><br>
			<button type="submit" name="submit">Разослать!</button>		
		</form>
	<?php } ?>	
</body>
</html>
