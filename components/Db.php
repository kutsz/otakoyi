<?php

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Db {

	/**
	 * Устанавливает соединение с базой данных
	 *
	 */
	public static function getConnection() {

		try {
			// Получаем параметры подключения из файла
			$paramsPath = ROOT . '/config/db_params.php';
			$params = include $paramsPath;

			// Устанавливаем соединение
			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
			$db = new PDO($dsn, $params['user'], $params['password']);

			return $db;

		} catch (PDOException $e) {

			echo "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		// Получаем параметры подключения из файла---------------
		// $paramsPath = ROOT . '/config/db_params.php';
		// $params = include $paramsPath;

		// // Устанавливаем соединение
		// $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
		// $db = new PDO($dsn, $params['user'], $params['password']);

		// return $db;

		//-------------------
	}

}
