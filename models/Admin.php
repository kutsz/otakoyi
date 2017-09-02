<?php

class Admin {

	public static function checkAdminHash($name, $password) {

		$db = Db::getConnection();

		$sql = 'SELECT * FROM admin WHERE name = :name';

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_INT);
		$result->execute();

		$admin = $result->fetch();

		$valid = false;

		if (password_verify($password, $admin['password'])) {
			$valid = true;
		}

		if ($admin && $valid) {
			return $admin['id'];
		}
		return false;
	}

	public static function auth($adminId) {

		$_SESSION['admin'] = $adminId;
	}

	public static function checkLogged() {

		if (isset($_SESSION['admin'])) {
			return $_SESSION['admin'];
		}

		header("Location: /login");
	}

	public static function getUserById($id) {

		$db = Db::getConnection();

		$sql = 'SELECT * FROM admin WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);

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

	public static function updateUser($id, $name, $email) {

		$db = Db::getConnection();

		$statement = $db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
		$statement->execute([
			':id' => $id,
			':name' => $name,
			':email' => $email,
		]);

	}

	public static function updateComment(&$db, $id, $dateComment, $ip, $browser, $textComment) {

		//$db = Db::getConnection();

		$statement = $db->prepare('UPDATE comments
			                        SET
			                        dateComment = :dateComment,
			                        ip = :ip,
		                            browser = :browser,
		                            textComment = :textComment
		                            WHERE id = :id');
		$statement->execute([
			':id' => $id,
			':dateComment' => $dateComment,
			':ip' => $ip,
			':browser' => $browser,
			':textComment' => $textComment,
		]);

	}

	public static function update($iduser, $name, $email, array $idcmt, array $datecmt, array $ip, array $browser,
		array $textcmt) {

		$db = Db::getConnection();

		$db->beginTransaction();

		try {
			$statement = $db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
			$statement->execute([
				':id' => $iduser,
				':name' => $name,
				':email' => $email,
			]);

			foreach ($idcmt as $key => $id) {
				self::updateComment($db, $id, $datecmt[$key], $ip[$key], $browser[$key], $textcmt[$key]);
			}

			$db->commit();

		} catch (Exception $e) {

			$db->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}

	}

}