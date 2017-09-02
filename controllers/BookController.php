<?php

class BookController {

	const SUM = '3';

	private function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}

	public function actionAddcomment() {

		if (isset($_POST['submit'])) {

			$name = (isset($_POST['name'])) ? $this->input($_POST['name']) : '';
			$email = (isset($_POST['email'])) ? $this->input($_POST['email']) : '';
			$sum = (isset($_POST['sum'])) ? $this->input($_POST['sum']) : '';
			$text = (isset($_POST['text'])) ? $this->input($_POST['text']) : '';
			$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';
			$browser = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
			$date = date("Y-m-d");

			$errors = false;
			$is_user = false;
			$user = [];

			if (empty($name)) {
				$errors[] = 'Введите имя';
			}

			if (!User::checkEmail($email)) {
				$errors[] = 'Неправильный email';
			}

			if (User::checkEmailExists($email)) {

				$user = User::getUserByEmail($email);

				if ($user['name'] == $name) {
					$is_user = true;

				} else {

					$errors[] = 'Такой email уже используется. Или ошибка в имени. ';
				}
			}

			if (empty($text)) {
				$errors[] = 'Введите текст комментария';
			}

			if (empty($sum)) {
				$errors[] = 'Введите сумму с картинки';
			} elseif ($sum != self::SUM) {
				$errors[] = 'Сумма с картинки не правильна';

			}

			if ($errors == false) {

				if ($is_user) {
					User::addComment($user['id'], $date, $ip, $browser, $text);

				} else {

					User::UserCommentAdd($name, $email, $date, $ip, $browser, $text);

				}

			}

		}

		require_once ROOT . '/views/book/index.php';
		return true;
	}

	public function actionInfo($page = 1) {

		require_once ROOT . '/views/book/infoview.php';

	}

	public function actionJson($page = 1) {
		$users = [];

		$users = User::getUserComments($page);

		echo json_encode($users, true);

	}

	public function actionTotalcomments() {
		$total = User::getTotalUsers();

		echo $total;

	}

}
