<?php

class AdminController extends AdminBase {

	private function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}

	public function actionLogin() {

		$name = false;
		$password = false;

		if (isset($_POST['submit'])) {

			$name = $_POST['name'];
			$password = $_POST['password'];

			$errors = false;

			$adminId = Admin::checkAdminHash($name, $password);

			if ($adminId == false) {

				$errors[] = 'Неправильные данные для входа     ';
			} else {

				Admin::auth($adminId);

				header("Location: /cabinet");
			}
		}

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
			}

		}

		require_once ROOT . '/views/admin/edit.php';

		return true;

	}

	public function actionUpdate() {

		if (isset($_POST['submitChanges'])) {

			if (!empty($_POST['commentid']) && !empty($_POST['userid'])) {

				$userid = $_POST['userid'];
				$userName = $_POST['userName'];
				$userEmail = $_POST['userEmail'];

				$commentid = $_POST['commentid'];
				$dateComment = $_POST['dateCom'];
				$ip = $_POST['ip'];
				$browser = $_POST['browser'];
				$textComment = $_POST['textComment'];

				Admin::update($userid, $userName, $userEmail, $commentid, $dateComment, $ip, $browser, $textComment);

			}

		}
		require_once ROOT . '/views/admin/update.php';
		return true;

	}

}