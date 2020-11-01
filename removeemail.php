<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Удаление из рассылки</title>
</head>
<body>
	<h1>Интернет-магазин</h1>
	<a href="index.php">Сделать рассылку</a>
	<a href="addemail.php">Добавить адреса</a>
	<a href="removeemail.php">Удалить адреса</a>
	<br>
	

	<?php

	$dbh = mysqli_connect('localhost', 'root', '', 'elvis_store')
		or die('Ошибка соединения с MySQL-сервером');

	if ( isset($_POST['submit']) ) {
		foreach ($_POST['todelete'] as $delete_id) {
			var_dump($_POST['todelete']); die;
			$query = "SELECT * FROM email_list WHERE id=$delete_id";
			$result = mysqli_query($dbh, $query)
				or die('Ошибка выполнения запроса к базе данных');;
			$row = mysqli_fetch_array($result);
			echo 'Покупатель ' . $row['first_name'] . ' ' . $row['last_name'] . ' с почтой ' . $row['email'] . ' и id = ' . $row['id'] . ' был удалён.<br>';

			$query = "DELETE FROM email_list WHERE id=$delete_id";
			mysqli_query($dbh, $query)
				or die('Ошибка запроса к базе данных');

		}

	} else {
		$query = "SELECT * FROM email_list";

		$result = mysqli_query($dbh, $query)
			or die('Ошибка выполнения запроса к базе данных');

		mysqli_close($dbh);

		?>
		<p>Выберите адреса для удаления:</p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<?php
			while ( $row = mysqli_fetch_array($result) ) {
					echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]">' . $row['first_name'] . ' ' . $row['last_name'] . ': ' . $row['email'] . '<br>';
			}
			?>

			<button type="submit" name="submit">Удалить</button>
		</form>
	<?php } ?>
	
</body>
</html>