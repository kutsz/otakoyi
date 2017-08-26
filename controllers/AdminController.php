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

		$flag = parent::checkAdmin();

		if ($flag) {

			if (isset($_POST['submitSearch'])) {

				$search = isset($_POST['search']) ? $this->input($_POST['search']) : null;

				if (!empty($search)) {
					$users = [];
					$users = Admin::searchData($search);
				} else {
					//$err = "<p>Вы обратились к файлу без необходимых параметров</p>";
				}

			}

			require_once ROOT . '/views/admin/cabinet.php';
			return true;
		}
	}

	public function actionDelete() {

		if (isset($_POST['submitDelete'])) {

			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$result = null;
				$result = Admin::deleteUserById($id);

				if ($result) {
					//require_once ROOT . '/views/admin/delete.php';

				}
			}

		}

		require_once ROOT . '/views/admin/delete.php';

		return true;

	}

	public function actionEdit() {

		if (isset($_POST['submitEdit'])) {

			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$data = Admin::Edit($id);
				//require_once ROOT . '/views/admin/edit.php';
			}

		}

		require_once ROOT . '/views/admin/edit.php';

		return true;

	}

	public function actionUpdate() {
		require_once ROOT . '/views/admin/update.php';
		return true;

	}

}