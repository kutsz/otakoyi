
<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>

</head>
<body>
	<h2>Edit</h2>

	<?php if (!empty($data) && is_array($data)): ?>
		<?php //var_dump($data);?>

		<form action='update' method='POST'>

			Name
			<input  value="<?php echo $data['user']['name']; ?>" type="text" name="userName" >

			Email
			<input value="<?php echo $data['user']['email']; ?>" type="text" name="userEmail" >

  			<input type="hidden" name ="userid" value="<?php echo $data['user']['id']; ?>"><br><br>

			<?php foreach ($data['comments'] as $comment): ?>

				Date
				<input type="date" name="dateCom[]" value="<?php echo $comment['dateComment']; ?>">

				Ip
				<input type="text" name="ip[]" value="<?php echo $comment['ip']; ?>">

				Browser
				<textarea name = "browser[]">
					<?php echo $comment['browser']; ?> </textarea>

				Text
				<textarea  name = "textComment[]">
					<?php echo $comment['textComment']; ?> </textarea>

				<input type="hidden" name ="commentid[]" value="<?php echo $comment['id']; ?>"><br><br>

			<?php endforeach;?>

			<br><input type="submit" name="submitChanges"  value="Сохранить изменения">

		</form>

	<?php else: ?>
		<h1> no data's came </h1>

	<?php endif;?>

	<br><a href = 'cabinet'>Back to cabinet</a>

</body>
</html>
