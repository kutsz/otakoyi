<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>book of complaints</title>
</head>
<body>

	<h2>book of complaints</h2>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li>  <?php echo $error; ?></li>
			<?php endforeach;?>
		</ul>
	<?php endif;?>

	<form action="" method="POST">

		<p>
			Name<br>
			<input type="text" name="name" >
		</p>

		<p>
			E-mail <br>
			<input type="email" name="email" >
		</p>

		<p>
			Text <br>
			<textarea name="text" cols="30" rows="10" ></textarea>
		</p>
		<p>Введите сумму с картинки</p>

		<p>
			<img src = "/images/sum.jpg"><br>
			<input type="text" name="sum" >
		</p>

		<p>
			<input type="submit" name="submit" value="Submit">
		</p>

	</form>


	<a href="/info">Comments to look</a><br>

</body>

</html>

