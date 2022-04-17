<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost:3306;dbname=test','root', 'root' ); 

if ( !R::testconnection() )
{
		exit ('<!DOCTYPE html>
				<html>
				<head>
    				<meta charset="utf-8">
					<title>Нет соединения</title>
				</head>
				<body>
	
					<h1 align="center">Нет соединения с базой данных</h1><br><br><br><h2 align="center">Дальнейшее функционирование невозможно</h2>
	
	
				</body>
				</html>
				');
}

session_start();