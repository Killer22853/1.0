<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="form">
		<h1>Вход<br>по email</h1>
		<form action="elogin.php" method="POST">
			<div class="input-form">
				<input type="email" name="email" placeholder="email" value="<?php echo @$data['email']; ?>"><br/>
			</div>

			<div class="input-form">
				<input type="password" name="password"  placeholder="Пароль"value="<?php echo @$data['password']; ?>"><br/>
			</div>

			<div class="input-form">
				<input type="submit" value="Войти" name="do_elogin">
			</div>
		
	<?php 
	require 'db.php';

	$data = $_POST;
	if ( isset($data['do_elogin']) )
	{
		$user = R::findOne('users', 'email = ?', array($data['email']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				echo '<script>
				window.location = "index.php"
				</script>';
			}else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким email не найден!';
		}
		
		if ( ! empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;" align="center"><h3>' .array_shift($errors). '</h3></div>';
		}

	}

?>

		</form>		
	</div>
</body>
</html>