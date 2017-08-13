<?php

class User {

	const SHOW_BY_DEFAULT = 5;

	public static function addUser($name, $email) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'INSERT INTO users (name, email) '
			. 'VALUES (:name, :email)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function addComment($id_user, $date, $ip, $browser, $text) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'INSERT INTO comments (id_user, dateComment, ip, browser, textComment) '
			. 'VALUES (:id_user, :date, :ip, :browser, :text)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id_user', $id_user, PDO::PARAM_STR);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':ip', $ip, PDO::PARAM_STR);
		$result->bindParam(':browser', $browser, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function edit($id, $name, $password) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = "UPDATE user
            SET name = :name, password = :password
            WHERE id = :id";

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 * Проверяет email
	 *
	 */
	public static function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	/**
	 * Проверяет не занят ли email другим пользователем
	 */
	public static function checkEmailExists($email) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

		// Получение результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();

		if ($result->fetchColumn()) {
			return true;
		}

		return false;
	}

	/**
	 * Возвращает пользователя с указанным email
	 */

	public static function getUserByEmail($email) {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'SELECT * FROM users WHERE email = :email';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);

		// Указываем, что хотим получить данные в виде массива
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		return $result->fetch();
	}

	public static function getUserComments($page = 1) {

		$limit = self::SHOW_BY_DEFAULT;
		// Смещение (для запроса)
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		// Соединение с БД
		$db = Db::getConnection();

		//select * from users inner join comments on users.id = comments.id_user order by comments.dateComment desc limit 5;

		// Текст запроса к БД
		// $sql = 'SELECT * FROM users INNER JOIN  comments ON users.id = comments.id_user'
		// 	. 'ORDER BY comments.dateComment DESC LIMIT :limit OFFSET :offset'; //:limit OFFSET :offset

		$sql = 'SELECT * FROM users INNER JOIN  comments ON users.id = comments.id_user ORDER BY comments.dateComment ASC LIMIT :limitt OFFSET :offset';
		//$sql = 'SELECT * FROM users';
		// Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':limitt', $limit, PDO::PARAM_INT);
		$result->bindParam(':offset', $offset, PDO::PARAM_INT);

		//$result->setFetchMode(PDO::FETCH_ASSOC);
		// Выполнение коменды
		$result->execute();

		// Получение и возврат результатов
		$i = 0;
		$user = [];
		while ($row = $result->fetch()) {
			$user[$i]['name'] = $row['name'];
			$user[$i]['email'] = $row['email'];
			$user[$i]['dateComment'] = $row['dateComment'];
			$user[$i]['ip'] = $row['ip'];
			$user[$i]['browser'] = $row['browser'];
			$user[$i]['textComment'] = $row['textComment'];

			$i++;
		}
		return $user;
	}

	public static function getTotalUsers() {
		// Соединение с БД
		$db = Db::getConnection();

		// Текст запроса к БД
		$sql = 'SELECT count(id) AS count FROM comments';

		// Используется подготовленный запрос
		$result = $db->prepare($sql);

		// Выполнение коменды
		$result->execute();

		// Возвращаем значение count - количество
		$row = $result->fetch();
		return $row['count'];
	}

	public static function UserCommentAdd($name, $email, $date, $ip, $browser, $text) {
		// Соединение с БД
		$db = Db::getConnection();

		$db->beginTransaction();

		try {
//------------------

			$sql = 'INSERT INTO users (name, email) '
				. 'VALUES (:name, :email)';

			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->execute();

//----------------------

			// Текст запроса к БД
			$sql = 'SELECT * FROM users WHERE email = :email';

			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':email', $email, PDO::PARAM_STR);

			// Указываем, что хотим получить данные в виде массива
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();

			$user = $result->fetch();
//---------------------------------
			$id_user = $user['id'];

			// Текст запроса к БД
			$sql = 'INSERT INTO comments (id_user, dateComment, ip, browser, textComment) '
				. 'VALUES (:id_user, :date, :ip, :browser, :text)';

			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':id_user', $id_user, PDO::PARAM_STR);
			$result->bindParam(':date', $date, PDO::PARAM_STR);
			$result->bindParam(':ip', $ip, PDO::PARAM_STR);
			$result->bindParam(':browser', $browser, PDO::PARAM_STR);
			$result->bindParam(':text', $text, PDO::PARAM_STR);
			$result->execute();
//----------------------------------------

			$db->commit();

		} catch (Exception $e) {

			$db->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}

	}

}
