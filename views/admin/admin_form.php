<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link href="" rel="stylesheet" type="text/css">

</head>
<body>
	<div>
	<h2>Вход для Администратора</h2>
		<form action="/login" method="post">
			<input type="text" name="name" placeholder="login" /><br><br>
			<input type="password" name="password" placeholder="password" /><br><br>
			<input type="submit" name="submit"  value="enter" />
		</form>
	</div>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li>  <?php echo $error; ?></li>
			<?php endforeach;?>
		</ul>
	<?php endif;?>
</body>
</html>