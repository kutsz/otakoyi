<?php

class User {

	const SHOW_BY_DEFAULT = 5;

	public static function addUser($name, $email) {
		$db = Db::getConnection();

		$sql = 'INSERT INTO users (name, email) '
			. 'VALUES (:name, :email)';

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function addComment($id_user, $date, $ip, $browser, $text) {
		$db = Db::getConnection();

		$sql = 'INSERT INTO comments (id_user, dateComment, ip, browser, textComment) '
			. 'VALUES (:id_user, :date, :ip, :browser, :text)';

		$result = $db->prepare($sql);
		$result->bindParam(':id_user', $id_user, PDO::PARAM_STR);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':ip', $ip, PDO::PARAM_STR);
		$result->bindParam(':browser', $browser, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function edit($id, $name, $password) {
		$db = Db::getConnection();

		$sql = "UPDATE user
            SET name = :name, password = :password
            WHERE id = :id";

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public static function checkEmailExists($email) {
		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();

		if ($result->fetchColumn()) {
			return true;
		}

		return false;
	}

	public static function getUserByEmail($email) {
		$db = Db::getConnection();

		$sql = 'SELECT * FROM users WHERE email = :email';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		return $result->fetch();
	}

	public static function getUserComments($page = 1) {

		$limit = self::SHOW_BY_DEFAULT;
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		$db = Db::getConnection();

		$sql = 'SELECT * FROM users INNER JOIN  comments ON users.id = comments.id_user ORDER BY comments.dateComment DESC LIMIT :limitt OFFSET :offset';
		$result = $db->prepare($sql);
		$result->bindParam(':limitt', $limit, PDO::PARAM_INT);
		$result->bindParam(':offset', $offset, PDO::PARAM_INT);

		//$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

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
		$db = Db::getConnection();

		$sql = 'SELECT count(id) AS count FROM comments';

		$result = $db->prepare($sql);

		$result->execute();

		$row = $result->fetch();
		return $row['count'];
	}

	public static function UserCommentAdd($name, $email, $date, $ip, $browser, $text) {

		$db = Db::getConnection();

		$db->beginTransaction();

		try {
//------------------

			$sql = 'INSERT INTO users (name, email) '
				. 'VALUES (:name, :email)';

			$result = $db->prepare($sql);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->execute();

//----------------------

			$sql = 'SELECT * FROM users WHERE email = :email';

			$result = $db->prepare($sql);
			$result->bindParam(':email', $email, PDO::PARAM_STR);

			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();

			$user = $result->fetch();
//---------------------------------
			$id_user = $user['id'];

			$sql = 'INSERT INTO comments (id_user, dateComment, ip, browser, textComment) '
				. 'VALUES (:id_user, :date, :ip, :browser, :text)';

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
