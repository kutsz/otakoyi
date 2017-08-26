

<!DOCTYPE html>
<html>
<head>
	<title>Cabinet</title>
	<link href="" rel="stylesheet" type="text/css">

</head>
<body>
	<h2>Cabinet</h2>

	<form action="" method="post">
		<input type="text" name="search" placeholder="search" /><br><br>
		<input type="submit" name="submitSearch"  value="submit" /><br>
	</form>




	<?php //if (isset($users) && is_array($users)): ?>
	<?php if (!empty($users) && is_array($users)): ?>
		<form action="" method="post">
			<?php foreach ($users as $user): ?>

				<p>
					<input type='radio' name="id" value="<?php echo $user['id']; ?>">
					<?php echo $user['name'] . ' - ' . $user['email']; ?>
				</p>

			<?php endforeach;?>

      <p><button formaction="delete" name="submitDelete">Delete</button></p>

      <p><button formaction="edit" name="submitEdit">Edit</button></p>

		</form>
	<?php endif;?>

	<?php //echo isset($success) ? 'delete' : 'not delete'; ?>

</body>
</html>

