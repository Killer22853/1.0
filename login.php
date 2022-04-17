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
	<form action="login.php" method="POST">
		<h1>Вход</h1>
	<div class="input-form">
		<input type="text" name="login" placeholder="Логин" value="<?php echo @$data['login']; ?>"><br/>
	</div>
	<div class="input-form">
		<input type="password" placeholder="Пароль" name="password" value="<?php echo @$data['password']; ?>"><br/>
	</div>
		<div class="input-form">
			<input type="submit" value="Войти" name="do_login">
		</div>
		<div class="input-form">
		<a href="elogin.php" class="forget">Вход по email</a>
		</div>
		<div class="input-form">
		<a href="signup.php" class="forget">Зарегистрироваться</a>
		</div>
		<?php 
	require 'db.php';

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
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
			$errors[] = 'Пользователь с таким логином не найден!';
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