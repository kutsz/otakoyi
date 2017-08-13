<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */

class AdminController extends AdminBase {

	private function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}

	public function actionForm() {

		require_once ROOT . '/views/admin/admin_form.php';
		return true;
	}

	/**
	 * Action для страницы "Вход на сайт"
	 */
	public function actionLogin() {
		// Переменные для формы
		$name = false;
		$password = false;

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$name = $_POST['name'];
			$password = $_POST['password'];

			// Флаг ошибок
			$errors = false;

			// Проверяем существует ли пользователь
			// $adminId = Admin::checkAdminData($name, $password);
			$adminId = Admin::checkAdminHash($name, $password);

			if ($adminId == false) {
				// Если данные неправильные - показываем ошибку
				$errors[] = 'Неправильные данные для входа     ';
			} else {
				// Если данные правильные, запоминаем пользователя (сессия)
				Admin::auth($adminId);

				// Перенаправляем пользователя в закрытую часть - кабинет
				header("Location: /cabinet");
			}
		}

		// Подключаем вид
		require_once ROOT . '/views/admin/admin_form.php';
		return true;
	}

	public function actionCabinet() {

		require_once ROOT . '/views/admin/cabinet.php';
		return true;
	}

	/**
	 * Action для стартовой страницы "Панель администратора"
	 */
	// public function actionIndex() {
	// 	// Проверка доступа
	// 	self::checkAdmin();

	// 	// Подключаем вид
	// 	require_once ROOT . '/views/admin/index.php';
	// 	return true;
	// }

	public function actionSeek() {

		$search = isset($_POST['search']) ? $this->input($_POST['search']) : '';

		if (isset($_POST['submitSearch'])) {
			if (empty($search) || (mb_strlen($search, 'UTF8') < 4)) {
				exit("<p>Поисковый запрос не введен , либо он менее 4-х символов.</p>");
			}
			//$search = $this->input($search);
		} else {
			exit("<p>Вы обратились к файлу без необходимых параметров</p>");
		}

		$date = array();
		$date = Data::searchData($search);

		require_once ROOT . '/views/notes/search.php';

		return true;

	}

}