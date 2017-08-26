
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
			<input  value="<?php echo $data['user']['name']; ?>" type="text" name="title" >

			Email
			<input value="<?php echo $data['user']['email']; ?>" type="text" name="meta_d" >

  			<input type="hidden" name ="userid" value="<?php echo $data['user']['id']; ?>"><br><br>

			<?php foreach ($data['comments'] as $comment): ?>

				Date
				<input value="<?php echo $comment['dateComment']; ?>" type="date" name="meta_k">

				Ip
				<input value="<?php echo $comment['ip']; ?>" type="text" name="date" >

				Browser
				<textarea name = "description" >
					<?php echo $comment['browser']; ?> </textarea>

				Text
				<textarea  name = "text" >
					<?php echo $comment['textComment']; ?> </textarea>

				<input type="hidden" name ="commentid[]" value="<?php echo $comment['id']; ?>"><br><br>

			<?php endforeach;?>

			<br><input type="submit" name="submitChanges" id="submit" value="Сохранить изменения">

		</form>

	<?php else: ?>
		<h1> no data's came </h1>

	<?php endif;?>

	<br><a href = 'cabinet'>Back to cabinet</a>

</body>
</html>
