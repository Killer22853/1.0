<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Регистрация</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form">
	<h1>Регистрация</h1>
		<form action="/signup.php" method="POST">
	<div class="input-form">
		<input type="text" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>"><br/>
	</div>

	<div class="input-form">
		<input type="email" name="email" placeholder="Введите email" value="<?php echo @$data['email']; ?>"><br/>
	</div>

	<div class="input-form">
		<input type="password" name="password" placeholder="Введите пароль" value="<?php echo @$data['password']; ?>"><br/>
	</div>

	<div class="input-form">
		<input type="password" name="password_2" placeholder="Подвердите пароль" value="<?php echo @$data['password_2']; ?>"><br/>
	</div>
	

	<div class="input-form">
			<input type="submit" value="Зарегистрироваться" name="do_signup">
		</div>
<?php 
	require 'db.php';

	$data = $_POST;

	

	//если кликнули на button
	if ( isset($data['do_signup']) )
	{
    // проверка формы на пустоту полей
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		//проверка на существование одинакового логина
		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    
    //проверка на существование одинакового email
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}

	
	

		


		if ( empty($errors) )
		{
			//ошибок нет, теперь регистрируем
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
			R::store($user);
			echo '<script>
				window.location = "login.php"
				</script>';
		}else
		{
			echo '<div id="errors" style="color:red;" align="center"><h3>' .array_shift($errors). '</h3></div>';
		}

	}

?>
</form>

</div>
</body>
</html>