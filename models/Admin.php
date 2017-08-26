<?php

class Admin {

	/**
	 * Регистрация пользователя

	 */
	public static function register($name, $password) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'INSERT INTO admin (name, password) '
			. 'VALUES (:name, :password)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 * Редактирование данных пользователя

	 */
	// public static function edit($id, $name, $password) {
	// 	// Соединение с БД
	// 	$db = Db::getConnection();

	// 	// Текст запроса к БД
	// 	$sql = "UPDATE admin
	//            SET name = :name, password = :password
	//            WHERE id = :id";

	// 	// Получение и возврат результатов. Используется подготовленный запрос
	// 	$result = $db->prepare($sql);
	// 	$result->bindParam(':id', $id, PDO::PARAM_INT);
	// 	$result->bindParam(':name', $name, PDO::PARAM_STR);
	// 	$result->bindParam(':password', $password, PDO::PARAM_STR);
	// 	return $result->execute();
	// }

	/**
	 * Проверяем существует ли пользователь с заданными $email и $password
	 */
	public static function checkAdminData($name, $password) {
		// Соединение с БД
		$db = Db::getConnection();
		// Текст запроса к БД
		$sql = 'SELECT * FROM admin WHERE name = :name AND password = :password';

		// Получение результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_INT);
		$result->bindParam(':password', $password, PDO::PARAM_INT);
		$result->execute();

		// Обращаемся к записи
		$admin = $result->fetch();

		if ($admin) {
			// Если запись существует, возвращаем id пользователя
			return $admin['id'];
		}
		return false;
	}

	public static function checkAdminHash($name, $password) {
		// Соединение с БД
		$db = Db::getConnection();
		// Текст запроса к БД
		$sql = 'SELECT * FROM admin WHERE name = :name';

		// Получение результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_INT);
		$result->execute();

		// Обращаемся к записи
		$admin = $result->fetch();

		$valid = false;

		if (password_verify($password, $admin['password'])) {
			$valid = true;
		}

		if ($admin && $valid) {
			// Если запись существует, возвращаем id пользователя
			return $admin['id'];
		}
		return false;
	}

	/**
	 * Запоминаем пользователя
	 * @param integer $userId <p>id пользователя</p>
	 */
	public static function auth($adminId) {
		// Записываем идентификатор пользователя в сессию
		$_SESSION['admin'] = $adminId;
	}

	/**
	 * Возвращает идентификатор пользователя, если он авторизирован.<br/>
	 * Иначе перенаправляет на страницу входа
	 * @return string <p>Идентификатор пользователя</p>
	 */
	public static function checkLogged() {
		// Если сессия есть, вернем идентификатор пользователя
		if (isset($_SESSION['admin'])) {
			return $_SESSION['admin'];
		}

		header("Location: /login");
	}

	// /**
	//  * Проверяет является ли пользователь гостем
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function isGuest() {
	// 	if (isset($_SESSION['user'])) {
	// 		return false;
	// 	}
	// 	return true;
	// }

	// /**
	//  * Проверяет имя: не меньше, чем 2 символа
	//  * @param string $name <p>Имя</p>
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function checkName($name) {
	// 	if (strlen($name) >= 2) {
	// 		return true;
	// 	}
	// 	return false;
	// }

	// /**
	//  * Проверяет телефон: не меньше, чем 10 символов
	//  * @param string $phone <p>Телефон</p>
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function checkPhone($phone) {
	// 	if (strlen($phone) >= 10) {
	// 		return true;
	// 	}
	// 	return false;
	// }

	// /**
	//  * Проверяет имя: не меньше, чем 6 символов
	//  * @param string $password <p>Пароль</p>
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function checkPassword($password) {
	// 	if (strlen($password) >= 6) {
	// 		return true;
	// 	}
	// 	return false;
	// }

	// /**
	//  * Проверяет email
	//  * @param string $email <p>E-mail</p>
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function checkEmail($email) {
	// 	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// 		return true;
	// 	}
	// 	return false;
	// }

	// /**
	//  * Проверяет не занят ли email другим пользователем
	//  * @param type $email <p>E-mail</p>
	//  * @return boolean <p>Результат выполнения метода</p>
	//  */
	// public static function checkEmailExists($email) {
	// 	// Соединение с БД
	// 	$db = Db::getConnection();

	// 	// Текст запроса к БД
	// 	$sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

	// 	// Получение результатов. Используется подготовленный запрос
	// 	$result = $db->prepare($sql);
	// 	$result->bindParam(':email', $email, PDO::PARAM_STR);
	// 	$result->execute();

	// 	if ($result->fetchColumn()) {
	// 		return true;
	// 	}

	// 	return false;
	// }

	/**
	 * Возвращает пользователя с указанным id
	 */
	public static function getUserById($id) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'SELECT * FROM admin WHERE id = :id';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);

		// Указываем, что хотим получить данные в виде массива
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		return $result->fetch();
	}

	public static function searchData($search) {

		$db = Db::getConnection();

		$statement = $db->prepare('SELECT id,name,email FROM users
		WHERE name LIKE :search');
		$statement->execute([':search' => "%{$search}%"]);

		$data_temp = [];
		$i = 0;
		while ($row = $statement->fetch()) {
			$data_temp[$i]['id'] = $row['id'];
			$data_temp[$i]['name'] = $row['name'];
			$data_temp[$i]['email'] = $row['email'];

			$i++;
		}

		return $data_temp;
	}

	public static function deleteUserById($id) {

		$db = Db::getConnection();

		$statement = $db->prepare('DELETE FROM users WHERE id = :id');

		return $statement->execute([':id' => $id]);

	}

	public static function Edit($id) {

		$db = Db::getConnection();

		$db->beginTransaction();

		try {
			$statement1 = $db->prepare('SELECT * FROM users WHERE id = :id');
			$statement1->execute([':id' => $id]);

			$statement2 = $db->prepare('SELECT * FROM comments WHERE id_user = :id');
			$statement2->execute([':id' => $id]);

			$db->commit();

			$user = [];

			while ($row = $statement1->fetch(PDO::FETCH_ASSOC)) {
				$user['id'] = $row['id'];
				$user['name'] = $row['name'];
				$user['email'] = $row['email'];

			}

			$comments = [];
			$i = 0;
			while ($row = $statement2->fetch(PDO::FETCH_ASSOC)) {
				$comments[$i]['id'] = $row['id'];
				$comments[$i]['dateComment'] = $row['dateComment'];
				$comments[$i]['ip'] = $row['ip'];
				$comments[$i]['browser'] = $row['browser'];
				$comments[$i]['textComment'] = $row['textComment'];

				$i++;
			}
			$data = [];
			$data['user'] = $user;
			$data['comments'] = $comments;

			return $data;

		} catch (Exception $e) {

			$db->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}

	}

	public static function update($id) {

		$db = Db::getConnection();

		//$statement = $db->prepare('DELETE FROM users WHERE id = :id');

		//return $statement->execute([':id' => $id]);

	}

}